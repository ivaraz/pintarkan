<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['lecturer_id', 'title', 'description'];

    public function lecturer() {
        return $this->belongsTo(Lecturer::class);
    }

    public function material() {
        return $this->hasMany(Material::class);
    }

    public function assignment() {
        return $this->hasMany(Assignment::class);
    }

    public function enrollment() {
        return $this->hasMany(Enrollment::class);
    }
}
