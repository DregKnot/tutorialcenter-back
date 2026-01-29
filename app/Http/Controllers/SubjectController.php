<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Admin: View all subjects (including inactive)
     */
    public function index()
    {
        $subjects = Subject::latest()->get();

        return response()->json([
            'subjects' => $subjects,
        ]);
    }

    /**
     * Create new subject (Admin)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'banner'      => 'required|image|mimes:jpg,jpeg,png|max:2048',

            'courses'     => 'required|array|min:1',
            'courses.*'   => 'exists:courses,id',

            'departments'   => 'required|array|min:1',
            'departments.*' => 'string',

            'assignees'   => 'required|array|min:1',
            'assignees.*' => 'exists:staffs,id',

            'status'      => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            // Upload banner
            $bannerPath = $request->file('banner')
                ->store('subject_banners', 'public');

            $subject = Subject::create([
                'name'        => $request->name,
                'description' => $request->description,
                'banner'      => $bannerPath,
                'courses'     => $request->courses,
                'departments' => $request->departments,
                'assignees'   => $request->assignees,
                'status'      => $request->status,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Subject created successfully.',
                'subject' => $subject,
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create subject.',
                'error'   => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Update subject (Admin)
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json([
                'message' => 'Subject not found.',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'banner'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'courses'     => 'nullable|array|min:1',
            'courses.*'   => 'exists:courses,id',

            'departments'   => 'nullable|array|min:1',
            'departments.*' => 'string',

            'assignees'   => 'nullable|array|min:1',
            'assignees.*' => 'exists:staffs,id',

            'status'      => 'nullable|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();

        try {
            $data = $validator->validated();

            // Handle banner update
            if ($request->hasFile('banner')) {
                $data['banner'] = $request->file('banner')
                    ->store('subject_banners', 'public');
            }

            $subject->update($data);

            DB::commit();

            return response()->json([
                'message' => 'Subject updated successfully.',
                'subject' => $subject->fresh(),
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to update subject.',
                'error'   => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Soft delete subject (Admin)
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);

        if (!$subject) {
            return response()->json([
                'message' => 'Subject not found.',
            ], 404);
        }

        $subject->delete();

        return response()->json([
            'message' => 'Subject deleted successfully.',
        ]);
    }

    /**
     * Restore soft-deleted subject (Admin)
     */
    public function restore($id)
    {
        $subject = Subject::onlyTrashed()->find($id);

        if (!$subject) {
            return response()->json([
                'message' => 'Subject not found or not deleted.',
            ], 404);
        }

        $subject->restore();

        return response()->json([
            'message' => 'Subject restored successfully.',
            'subject' => $subject,
        ]);
    }
}
