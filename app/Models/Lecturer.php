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
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'image_url',
        'image_path',
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
            return asset("images/lecturers/{$this->image}");
        }
        return asset('images/placeholder.png');
    }

    /**
     * Get the image URL (alias for image_path)
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image) {
            return asset("images/lecturers/{$this->image}");
        }
        return null;
    }

    /**
     * Get departments as comma-separated string
     */
    public function getDepartmentsStringAttribute(): string
    {
        return implode(', ', $this->departments ?? []);
    }
}
