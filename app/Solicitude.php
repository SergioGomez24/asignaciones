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

    public function scopeTeacherId($query, $teacher_id){

    	if($teacher_id)
    		return $query->where('teacher_id', '=', $teacher_id);
    }
}
