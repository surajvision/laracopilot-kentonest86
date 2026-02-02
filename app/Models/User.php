<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'education',
        'occupation',
        'experience_years',
        'skills',
        'bio',
        'total_points',
        'profile_completed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'experience_years' => 'integer',
            'total_points' => 'integer',
            'profile_completed' => 'boolean',
        ];
    }

    /**
     * Get the application for the user.
     */
    public function application()
    {
        return $this->hasOne(Application::class);
    }

    /**
     * Get the KYC record for the user.
     */
    public function kyc()
    {
        return $this->hasOne(Kyc::class);
    }

    /**
     * Get all task assignments for the user.
     */
    public function taskAssignments()
    {
        return $this->hasMany(TaskAssignment::class);
    }

    /**
     * Get all job requests from the user.
     */
    public function jobRequests()
    {
        return $this->hasMany(JobRequest::class);
    }
}