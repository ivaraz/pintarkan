<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['lecturer_id', 'title', 'description'];

    public function lecturers() {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    public function materials() {
        return $this->hasMany(Material::class);
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }
}
