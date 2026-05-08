<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['submission_id', 'score', 'note'];

    public function submission() {
        return $this->belongsTo(Submission::class);
    }
}
