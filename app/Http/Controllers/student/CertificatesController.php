<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\StudentEventRegistration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificatesController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();
        $this->data['completedEvents'] = StudentEventRegistration::with('event', 'student')->where('student_id', $student->id)
            ->get();
        return view('student.certificates.index')->with($this->data);
    }

    public function downloadCertificate(Request $request)
    {
        $view = 'student.certificates.template';
        $event = $request->event_name ?? '';
        $student = $request->student_name ?? '';
        $event_date = $request->event_date ?? '';
        // $this->data['event'] = $event;
        // $this->data['student'] = $student;
        // $this->data['event_date'] = $event_date;
        $pdf = Pdf::loadView('student.certificates.template', [
            'event' =>  $event,
            'student' => $student,
            'event_date' => $event_date
         ]);
        $filename = 'certificate-' . $event . '-' . $student . '.pdf';
        //    return view('student.certificates.template')->with($this->data);
        return $pdf->download($filename);
    }
}
