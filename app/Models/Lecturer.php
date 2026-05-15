<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = ['user_id', 'name', 'nidn'];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
