<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'category',
        'difficulty_level',
        'points_reward',
        'time_estimate',
        'total_slots',
        'available_slots',
        'status',
        'instructions',
        'requirements',
        'deadline',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'points_reward' => 'integer',
            'time_estimate' => 'integer',
            'total_slots' => 'integer',
            'available_slots' => 'integer',
            'deadline' => 'datetime',
        ];
    }

    /**
     * Get all task assignments for the task.
     */
    public function assignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }
}