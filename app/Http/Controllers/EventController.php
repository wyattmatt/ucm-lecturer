<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('modifier')->orderBy('start_date', 'desc')->get();
        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('image');
        $data['modified_by'] = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Remove special chars, convert to lowercase with underscores
            $imageName = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $request->title));
            $imageName = preg_replace('/\s+/', '_', trim($imageName));
            $extension = $image->getClientOriginalExtension();
            $fullFilename = $imageName . '.' . $extension;

            $image->move(public_path('images/events'), $fullFilename);

            $data['image'] = $fullFilename;
        }

        $event = Event::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => new EventResource($event)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($event->load('modifier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('image');
        $data['modified_by'] = Auth::id();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Remove special chars, convert to lowercase with underscores
            $imageName = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $request->title));
            $imageName = preg_replace('/\s+/', '_', trim($imageName));
            $extension = $image->getClientOriginalExtension();
            $fullFilename = $imageName . '.' . $extension;

            // Delete old image if it exists and name has changed
            if ($event->image) {
                $oldImagePath = public_path('images/events/' . $event->image);
                // Only delete if the new filename is different from old one
                if (file_exists($oldImagePath) && $event->image !== $fullFilename) {
                    try {
                        @unlink($oldImagePath);
                    } catch (\Exception $e) {
                        File::delete($oldImagePath);
                    }
                }
            }

            $image->move(public_path('images/events'), $fullFilename);

            $data['image'] = $fullFilename;
        }

        $event->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => new EventResource($event)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Delete image
        if ($event->image) {
            $imagePath = public_path('images/events/' . $event->image);
            if (file_exists($imagePath)) {
                try {
                    @unlink($imagePath);
                } catch (\Exception $e) {
                    // If unlink fails, try using File facade
                    File::delete($imagePath);
                }
            }
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully'
        ]);
    }
}
