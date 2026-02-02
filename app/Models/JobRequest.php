<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'task_id',
        'evaluation_answers',
        'unique_number',
        'status',
        'completion_status',
        'completion_notes',
        'completion_proof_path',
        'number_assigned_at',
        'approved_at',
        'rejected_at',
        'completed_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'evaluation_answers' => 'array',
            'number_assigned_at' => 'datetime',
            'approved_at'        => 'datetime',
            'rejected_at'        => 'datetime',
            'completed_at'       => 'datetime',
        ];
    }

    /**
     * Get the user that owns the job request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Status helpers (optional but useful)
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}