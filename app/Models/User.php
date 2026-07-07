<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $fillable = ['email', 'password'];
    protected $hidden = ['password'];


    public function student() {
        return $this->hasOne(Student::class);
    }

    public function lecturer() {
        return $this->hasOne(Lecturer::class);
    }

    public function getNameAttribute()
    {
        if ($this->hasRole('admin')) {
            return 'Admin';
        }
        if ($this->relationLoaded('lecturer') && $this->lecturer) {
            return $this->lecturer->name;
        }
        if ($this->relationLoaded('student') && $this->student) {
            return $this->student->name;
        }
        // Fallbacks if relationship is not loaded (lazy load safely)
        if ($this->lecturer) {
            return $this->lecturer->name;
        }
        if ($this->student) {
            return $this->student->name;
        }
        return 'User';
    }

    public function getDashboardRouteAttribute()
    {
        return match (true) {
            $this->hasRole('admin') => route('admin.dashboard'),
            $this->hasRole('lecturer') => route('lecturer.dashboard'),
            default => route('student.dashboard'),
        };
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
