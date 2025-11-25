<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Faculty;
use App\Models\TaskImage;
use App\Models\TaskImages;
use App\Models\Tasks;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignTasksController extends Controller
{
   public function index()
   {
    $this->data['tasks'] = Tasks::with('get_admin', 'get_task_images')->get();
    return view('super_admin.assign_task_index')->with($this->data);
   }

   public function createAssignTasks(Request $request)
   {
     $this->data['admins'] = Admin::where('role_id',2)->get();
        if ($request->task_id) {
            $taskId = decrypt($request->task_id);
            $this->data['edit_task'] = Tasks::with('get_task_images')->where('id', $taskId)->first();
        }
    return view('super_admin.create_assign_task')->with($this->data);
   }

    public function saveTasks(Request $request)
    {
        try {
            // ---------- VALIDATION ----------
            $rules = [
                'admin_id'      => 'required',
                'task_title'    => 'required|string',
                'description'   => 'required|string',
                'priority'      => 'required',
                'deadline_date' => 'required|date',
            ];
            // Multiple proof images validation
            if ($request->hasFile('proof')) {
                $rules['proof.*'] = 'image|mimes:jpeg,png,jpg|max:4096';
            }
            $request->validate($rules);
            // ---------- CREATE OR UPDATE ----------
            if (!empty($request->task_id)) {
                $tasks = Tasks::findOrFail($request->task_id);
                $message = "Task Updated Successfully";
            } else {
                $tasks = new Tasks();
                $message = "Task Created Successfully";
            }

            // ---------- SAVE BASIC DETAILS ----------
            $tasks->admin_id      = $request->admin_id;
            $tasks->title         = $request->task_title;
            $tasks->description   = $request->description;
            $tasks->priority      = $request->priority;
            $tasks->deadline_date = $request->deadline_date;
            $tasks->save();

            // ---------- MULTIPLE IMAGE UPLOAD ----------
            if(isset($request->removed_images) && !empty($request->removed_images)){
                $ids = json_decode($request->removed_images);
                foreach ($ids as $id) {
                    $img = TaskImage::find($id);
                    if ($img) {
                         Storage::disk('public')->delete($img->file_path);
                        $img->delete();
                    }
                }
            }

            if ($request->hasFile('proof')) {
                foreach ($request->file('proof') as $file) {
                    $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalName();
                    $path = $file->storeAs('task_images', $imageName, 'public');
                    $exists = TaskImage::where(['task_id' => $tasks->id, 'file_name' => $imageName, 'file_path' => $path])->first();
                    if(!$exists){
                        $taskimage = new TaskImage();
                        $taskimage->task_id =  $tasks->id;
                        $taskimage->file_name = $imageName;
                        $taskimage->file_path = $path;
                        $taskimage->file_type = $file->getClientOriginalExtension();
                        $taskimage->save();
                    }
                }
            }
            // ---------- SUCCESS RESPONSE ----------
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
