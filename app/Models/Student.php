<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tutor;

class Student extends Model
{
    use HasFactory;
    public function tutor(){
        return $this->belongsTo('App\Models\Tutor');
    }
}
