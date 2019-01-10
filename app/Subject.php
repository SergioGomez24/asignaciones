<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function byCampus($id) {    
        return Subject::where('campus_id', $id)->get();
    }
}
