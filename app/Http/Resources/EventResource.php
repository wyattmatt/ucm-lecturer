<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'image_url' => $this->image ? asset('images/events/' . $this->image) : null,
            'description' => $this->description,
            'start_date' => $this->start_date->format('Y-m-d'),
            'start_time' => $this->start_time,
            'end_date' => $this->end_date->format('Y-m-d'),
            'end_time' => $this->end_time,
            'modified_by' => $this->modifier ? [
                'id' => $this->modifier->id,
                'name' => $this->modifier->name,
                'email' => $this->modifier->email,
            ] : null,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
