<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class SubjectsController extends Controller
{

    public function getIndex() {
    	$arrayAsignaturas = Subject::all();

    	return view('subjects.index', ['arrayAsignaturas' => $arrayAsignaturas]);
    }

    public function getShow($id) {
    	$asignatura = Subject::findOrFail($id);

    	return view('subjects.show', ['asignatura' => $asignatura]);
    }

    public function getCreate() {
    	return view('subjects.create');
    }

     public function getEdit($id) {
		$asignatura = Subject::findOrFail($id); 
		    	
     	return view('subjects.edit', ['asignatura' => $asignatura]);
     }

}
