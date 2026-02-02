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
        'job_type',
        'description',
        'preferred_rate',
        'availability',
        'skills_offered',
        'status',
        'admin_response',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'preferred_rate' => 'integer',
        ];
    }

    /**
     * Get the user that owns the job request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}