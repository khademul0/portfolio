<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'gallery_images' => 'array',
        'start_date'     => 'date',
        'end_date'       => 'date',
    ];

    /**
     * Normalize tech_stack — stored as JSON array or comma-separated string.
     */
    public function getTechStackAttribute($value): array
    {
        if (is_array($value)) {
            return $value;
        }
        if (empty($value)) {
            return [];
        }
        // Try JSON first (e.g. ["Laravel","Vue"])
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
        // Fall back to comma-separated string
        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    protected static function booted()
    {
        static::saving(function ($project) {
            if (empty($project->slug)) {
                $project->slug = \Illuminate\Support\Str::slug($project->title);
            }
            // Ensure tech_stack is stored as JSON array, not comma string
            if (is_string($project->getAttributes()['tech_stack'] ?? null)) {
                $raw = $project->getAttributes()['tech_stack'];
                $decoded = json_decode($raw, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    // It's a comma-separated string — convert to JSON
                    $project->attributes['tech_stack'] = json_encode(
                        array_values(array_filter(array_map('trim', explode(',', $raw))))
                    );
                }
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
