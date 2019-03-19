<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    protected $table = 'solicitudes';

    public function scopeSubjectId($query, $subject_id){

    	if($subject_id)
    		return $query->where('subject_id', '=', $subject_id);
    }

    public function scopeTeacher($query, $teacher){

    	if($teacher)
    		return $query->where('teacher', '=', $teacher);
    }
}
