<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Programme;
use Exception;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    public function index()
    {
        $this->data['programmes'] = Programme::with('get_department')->paginate(10);
        return view('admin/programme_list')->with($this->data);
    }

    public function createProgramme(Request $request)
    {
        $this->data['department'] = Department::all();
        if ($request->programme_id) {
            $programmeId = decrypt($request->programme_id);
            $this->data['edit_programme'] = Programme::where('id', $programmeId)->first();
        }
        return view('admin/create_programme')->with($this->data);
    }

    public function saveProgramme(Request $request)
    {

        $rules = [
            'programme_name'   => 'required',
            'programme_code'   => 'required',
            'department_id'   => 'required',
            'graduate_type'   => 'required',
        ];

        $request->validate($rules);
        try {
            if (!empty($request['programme_id'])) {
                $message = 'Programme Updated successfully';
                $programme = Programme::find($request['programme_id']);
            } else {
                $programme = new Programme();
                $message = 'Programme saved successfully';
            }

            $programme->name  = $request['programme_name'];
            $programme->code = $request['programme_code'] ?? '';
            $programme->department_id = $request['department_id'] ?? '';
            $programme->graduate_type = $request['graduate_type'] ?? '';
            $programme->save();

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Programme',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
