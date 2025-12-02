<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class LecturerController extends Controller
{
    /**
     * Display the lecturers page
     */
    public function index()
    {
        $lecturers = Lecturer::orderBy('name')->get();
        $events = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        return view('lecturers.index', compact('lecturers', 'events'));
    }

    /**
     * API: Get all lecturers
     */
    public function apiIndex()
    {
        $lecturers = Lecturer::orderBy('name')->get();
        return response()->json(['success' => true, 'data' => $lecturers]);
    }

    /**
     * API: Get both lecturers and events for polling
     */
    public function apiData()
    {
        $lecturers = Lecturer::orderBy('name')->get();
        $events = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'lecturers' => $lecturers,
                'events' => $events
            ]
        ]);
    }

    /**
     * Store a newly created lecturer
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'room' => 'nullable|string|max:50',
            'departments' => 'required|array',
            'departments.*' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Extract name before comma, remove special chars, convert to lowercase with underscores
            $baseName = explode(',', $request->name)[0];
            $imageName = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $baseName));
            $imageName = preg_replace('/\s+/', '_', trim($imageName));
            $extension = $image->getClientOriginalExtension();
            $fullFilename = $imageName . '.' . $extension;

            $image->move(public_path('images/lecturers'), $fullFilename);

            $data['image'] = $fullFilename;
        }

        $lecturer = Lecturer::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Lecturer created successfully',
            'data' => $lecturer
        ], 201);
    }

    /**
     * Display the specified lecturer
     */
    public function show(Lecturer $lecturer)
    {
        return response()->json(['success' => true, 'data' => $lecturer]);
    }

    /**
     * Update the specified lecturer
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        // Remove image from request if it's empty/invalid to prevent validation errors
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Remove image field if file is empty or invalid
            if (!$file->isValid() || $file->getSize() == 0) {
                $request->request->remove('image');
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'room' => 'nullable|string|max:50',
            'departments' => 'required|array',
            'departments.*' => 'string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('image');

        // Only process image if a valid file exists
        if ($request->hasFile('image') && $request->file('image')->isValid() && $request->file('image')->getSize() > 0) {
            $image = $request->file('image');
            // Extract name before comma, remove special chars, convert to lowercase with underscores
            $baseName = explode(',', $request->name)[0];
            $imageName = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $baseName));
            $imageName = preg_replace('/\s+/', '_', trim($imageName));
            $extension = $image->getClientOriginalExtension();
            $fullFilename = $imageName . '.' . $extension;

            // Delete old image if it exists and name has changed
            if ($lecturer->image) {
                $oldImagePath = public_path('images/lecturers/' . $lecturer->image);
                // Only delete if the new filename is different from old one
                if (file_exists($oldImagePath) && $lecturer->image !== $fullFilename) {
                    try {
                        @unlink($oldImagePath);
                    } catch (\Exception $e) {
                        File::delete($oldImagePath);
                    }
                }
            }

            $image->move(public_path('images/lecturers'), $fullFilename);

            $data['image'] = $fullFilename;
        }

        $lecturer->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Lecturer updated successfully',
            'data' => $lecturer
        ]);
    }

    /**
     * Remove the specified lecturer
     */
    public function destroy(Lecturer $lecturer)
    {
        // Delete image
        if ($lecturer->image) {
            $imagePath = public_path('images/lecturers/' . $lecturer->image);
            if (file_exists($imagePath)) {
                try {
                    @unlink($imagePath);
                } catch (\Exception $e) {
                    // If unlink fails, try using File facade
                    File::delete($imagePath);
                }
            }
        }

        $lecturer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lecturer deleted successfully'
        ]);
    }
}
