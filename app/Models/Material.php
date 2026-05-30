<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['course_id', 'title', 'files', 'content'];

    protected $casts = [
        'files' => 'array',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
