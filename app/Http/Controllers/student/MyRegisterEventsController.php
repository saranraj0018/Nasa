<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\StudentEventRegistration;
use App\Models\StudentUploadProof;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyRegisterEventsController extends Controller
{
    public function index(Request $request)
    {
        $student = session()->get('student');
        $this->data['registeredEvents'] = StudentEventRegistration::with('event')->where('student_id', $student->id)
            ->get();
        $this->data['completedEvents'] = StudentEventRegistration::with('event')->where('student_id', $student->id)
            ->get();
        $this->data['activeCount'] = StudentEventRegistration::where('student_id', $student->id)
            ->where('status', 1)
            ->count();

        $this->data['attendedCount'] = StudentEventRegistration::where('student_id', $student->id)
            ->where('status', 2)
            ->count();
        $events = Event::get();
        $myuploads = StudentUploadProof::select('student_id', 'event_id')
            ->where('student_id', $student->id)
            ->groupBy('student_id', 'event_id')
            ->get();
        $activecount = StudentEventRegistration::where('student_id', $student->id)->count();
        $this->data['pending_uploads'] =  $activecount - count($myuploads);
        return view('student.my_register_event')->with($this->data);
    }

    public function uploadProof(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required',
            'event_id'   => 'required',
            'proof'      => 'required',
        ]);
        try {
            foreach ($request->file('proof') as $file) {
                $fileName = $file->getClientOriginalName();
                $filePath = $file->storeAs('student_upload_proof', $fileName, 'public');
                $exists = StudentUploadProof::where(['student_id' => $validated['student_id'], 'event_id' => $validated['event_id'], 'file_name' =>  $fileName, 'file_path' => $filePath])->first();
                if(!$exists){
                $upload = new StudentUploadProof();
                $upload->student_id = $validated['student_id'];
                $upload->event_id   = $validated['event_id'] ?? null;
                $upload->file_name  = $fileName; // Original filename
                $upload->file_path  = $filePath;         // Public path
                $upload->file_type  = $file->getClientOriginalExtension();
                $upload->save();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Proof uploaded successfully!',
                'data' => $upload
            ]);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
