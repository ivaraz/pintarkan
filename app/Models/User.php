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

    public function getDashboardRouteAttribute()
    {
        return match (true) {
            $this->hasRole('admin') => route('admin.dashboard'),
            $this->hasRole('dosen') => route('dosen.dashboard'),
            default => route('mahasiswa.dashboard'),
        };
    }
}
