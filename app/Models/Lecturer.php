<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'title',
        'room',
        'departments',
        'image',
        'image_type',
        'image_size',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'departments' => 'array',
        ];
    }

    /**
     * Get the full image path
     */
    public function getImagePathAttribute(): string
    {
        if ($this->image) {
            return asset("images/lecturers/{$this->image}.{$this->image_type}");
        }
        return asset('images/lecturers/placeholder.jpg');
    }

    /**
     * Get departments as comma-separated string
     */
    public function getDepartmentsStringAttribute(): string
    {
        return implode(', ', $this->departments ?? []);
    }
}
