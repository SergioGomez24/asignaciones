<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    public function scopeCertificationId($query, $certification_id){

    	if($certification_id)
    		return $query->where('certification_id', '=', $certification_id);
    }

    public function scopeCampusId($query, $campus_id){

    	if($campus_id)
    		return $query->where('campus_id', '=', $campus_id);
    }

    public function scopeImpartedId($query, $imparted_id){

    	if($imparted_id)
    		return $query->where('imparted_id', '=', $imparted_id);
    }
}
