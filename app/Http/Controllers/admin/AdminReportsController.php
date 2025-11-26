<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventReport;
use App\Models\EventReportImage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminReportsController extends Controller
{
    public function index(Request $request)
    {
        $this->data['reports'] = EventReport::with('get_event_image', 'get_event.get_task')->get();
        return view('admin.admin_reports_index')->with($this->data);
    }

    public function crearteReport(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get_event_date) {
                $get_event = Event::where('id', $request->eventId)->first();
                return response()->json([
                    'success' => true,
                    'event' => $get_event
                ]);
            }
        }
        $adminId = Auth::guard('admin')->id();
        $this->data['event'] = Event::where('created_by' , $adminId)->get();

        return view('admin.create_admin_report')->with($this->data);
    }

    public function saveReport(Request $request)
    {
        try {
            $rules = [
                'event_id'  => 'required',
                'proof.*'    => 'required|mimes:jpg,jpeg,png',
                'male_count'   => 'required|numeric',
                'female_count'   => 'required|numeric',
                'outcome_results' => 'required',
                'feedback_summary' => 'required',
                'certificates' => 'required',
                'attendance_in' => 'required',
                'attendance_out' => 'required',
            ];
            $request->validate($rules);

            if (!empty($request->report_id)) {
                $report = EventReport::findOrFail($request->report_id);
                $message = "Report Updated Successfully";
            } else {
                $report = new EventReport();
                $message = "Report Created Successfully";
            }

            // SINGLE FILE UPLOADS
            $cer_path = $request->hasFile('certificates')
                ? $request->certificates->storeAs(
                    'report_certificate',
                    time() . '_' . uniqid() . '.' . $request->certificates->extension(),
                    'public'
                )
                : $report->certificates;

            $attendance_in_path = $request->hasFile('attendance_in')
                ? $request->attendance_in->storeAs(
                    'report_attendance_in',
                    time() . '_' . uniqid() . '.' . $request->attendance_in->extension(),
                    'public'
                )
                : $report->attendance_in;

            $attendance_out_path = $request->hasFile('attendance_out')
                ? $request->attendance_out->storeAs(
                    'report_attendance_out',
                    time() . '_' . uniqid() . '.' . $request->attendance_out->extension(),
                    'public'
                )
                : $report->attendance_out;
           $exist_report = EventReport::where('event_id', $request->event_id)->exists();
           if($exist_report){
                return response()->json([
                    'success' => false,
                    'message' => 'This event report already exists!'
                ], 500);
           }
            // SAVE MAIN REPORT
            $report->event_id = $request->event_id;
            $report->created_by = Auth::guard('admin')->id();
            $report->male_count = $request->male_count;
            $report->female_count = $request->female_count;
            $report->outcomes = $request->outcome_results;
            $report->feedback_summary = $request->feedback_summary;
            $report->certificates = $cer_path;
            $report->attendance_in = $attendance_in_path;
            $report->attendance_out = $attendance_out_path;
            $report->save();

            // DELETE REMOVED IMAGES
            if (!empty($request->removed_images)) {
                $ids = json_decode($request->removed_images);
                foreach ($ids as $id) {
                    $img = EventReportImage::find($id);
                    if ($img) {
                        Storage::disk('public')->delete($img->file_path);
                        $img->delete();
                    }
                }
            }

            // MULTIPLE PROOF IMAGES
            if ($request->hasFile('proof')) {
                foreach ($request->proof as $file) {
                    $imageName = time() . '_' . uniqid() . '.' . $file->extension();
                    $path = $file->storeAs('report_images', $imageName, 'public');
                    $exists = EventReportImage::where(['report_id' => $report->id, 'file_name' => $imageName, 'file_path' => $path])->first();
                    if(!$exists){
                        $reportimage = new EventReportImage();
                        $reportimage->report_id = $report->id;
                        $reportimage->file_name = $imageName;
                        $reportimage->file_path = $path;
                        $reportimage->file_type = $file->getClientOriginalExtension();
                        $reportimage->save();
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function viewPdf($id)
    {
        $report = EventReport::with(['get_event.get_task', 'get_event_image', 'creator'])->findOrFail($id);
        $pdf = Pdf::loadView('report.pdf.report_template', compact('report'))
            ->setPaper('a4', 'portrait');
        return $pdf->stream("event_report_{$report->id}.pdf");
    }

    public function downloadPdf($id)
    {
        $report = EventReport::with(['get_event.get_task', 'get_event_image', 'creator'])->findOrFail($id);
        $pdf = Pdf::loadView('report.pdf.report_template', compact('report'))
            ->setPaper('a4', 'portrait');
        return $pdf->download("event_report_{$report->id}.pdf");
    }
}
