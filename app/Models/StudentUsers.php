<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class StudentUsers extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'student_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'mobile', 'password', 'auth_code', 'status', 'user_role', 'first_name', 'last_name', 'middle_name', 'address', 'zipcode', 'institution_id', 'other_institute', 'country', 'state', 'city', 'gender', 'grade_id', 'mobile_otp', 'email_otp'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
