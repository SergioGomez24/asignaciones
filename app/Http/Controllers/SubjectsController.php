<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectsController extends Controller
{
	private $arrayAsignaturas = array(
		array(
			'code' => '1234',
			'name' => 'Programacion', 
			'coordinador' => 'Francis Ford'
		),
		array(
			'code' => '567',
			'name' => 'Algebra', 
			'coordinador' => 'Francis Ford'
		)
	);

    public function getIndex() {
    	return view('subjects.index', $this->$arrayAsignaturas);
    }

    public function getShow($id) {
    	return view('subjects.show', $this->$arrayAsignaturas[id]);
    }

    public function getCreate() {
    	return view('subjects.create');
    }

     public function getEdit($id) {
     	return view('subjects.edit', $this->$arrayAsignaturas[id]);
     }

}
