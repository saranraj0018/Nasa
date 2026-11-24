<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLog;
use App\Models\Batch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BatchController extends Controller
{
    public function index()
    {
        $this->data['batches'] = Batch::orderByDesc('name')->paginate(10);

        return view('admin.batch_list')->with($this->data);
    }

    public function createBatch(Request $request)
    {
        $this->data['edit_batch'] = null;
        if ($request->batch_id) {
            $this->data['edit_batch'] = Batch::findOrFail(decrypt($request->batch_id));
        }

        return view('admin.create_batch')->with($this->data);
    }

    public function saveBatch(Request $request)
    {
        $request->merge(['batch_name' => trim((string) $request->batch_name)]);

        $request->validate([
            'batch_id'   => 'nullable|exists:batches,id',
            'batch_name' => [
                'bail',
                'required',
                'regex:/^\d{4}-\d{4}$/',
                Rule::unique('batches', 'name')->ignore($request->batch_id),
                function ($attribute, $value, $fail) {
                    [$start, $end] = array_map('intval', explode('-', $value));
                    if ($end <= $start) {
                        $fail('Batch end year must be greater than start year.');
                    } elseif (($end - $start) > 10) {
                        $fail('Batch range is invalid.');
                    }
                },
            ],
            'is_active'  => 'required|in:0,1',
        ], [
            'batch_name.regex'  => 'Batch must be in the format YYYY-YYYY (e.g. 2025-2029).',
            'batch_name.unique' => 'This batch already exists.',
        ]);

        try {
            $batch = $request->batch_id ? Batch::findOrFail($request->batch_id) : new Batch();
            $isUpdate = $batch->exists;

            $batch->name = $request->batch_name;
            $batch->is_active = (bool) $request->is_active;
            $batch->save();

            ActivityLog::add(
                $batch->name . ($isUpdate ? ' - Batch Updated' : ' - New Batch Created'),
                auth('admin')->user()
            );

            return response()->json([
                'success' => true,
                'message' => $isUpdate ? 'Batch Updated successfully' : 'Batch saved successfully',
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save Batch',
            ], 500);
        }
    }
}
