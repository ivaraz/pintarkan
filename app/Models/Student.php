<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = ['user_id', 'name', 'npm'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function submissions() {
        return $this->hasMany(Submission::class);
    }
}
