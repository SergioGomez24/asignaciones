<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    public function scopeSubjectId($query, $subject_id){

    	if($subject_id)
    		return $query->where('subject_id', '=', $subject_id);
    }

    public function scopeTeacher($query, $teacher){

    	if($teacher)
    		return $query->where('teacher', '=', $teacher);
    }
}
