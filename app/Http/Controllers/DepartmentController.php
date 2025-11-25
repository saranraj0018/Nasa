<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Exception;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $this->data['departments'] = Department::paginate(10);
        return view('admin/department_list')->with($this->data);
    }

    public function createDepartment(Request $request)
    {
        if ($request->department_id) {
            $departmentId = decrypt($request->department_id);
            $this->data['edit_department'] = Department::where('id', $departmentId)->first();

        }
        return view('admin/create_department')->with($this->data);
    }

    public function saveDepartment(Request $request)
    {

        $rules = [
            'department_name'   => 'required',
            'department_code'   => 'required',
        ];

        $request->validate($rules);
        try {
            if (!empty($request['department_id'])) {
                $message = 'Department Updated successfully';
                $department = Department::find($request['department_id']);
            } else {
                $department = new Department();
                $message = 'Department saved successfully';
            }

            $department->name  = $request['department_name'];
            $department->code = $request['department_code'] ?? '';
            $department->save();

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save Department',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
