<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Course;
use App\Teacher;
use App\Election;

use Notification;

class ElectionsController extends Controller
{
    public function getCreate() 
    {
    	$arrayCursos = Course::all();

    	return view('elections.create', ['arrayCursos' => $arrayCursos]);
    }

    public function postCreate(Request $request) 
    {
    	$arrayProfesores = Teacher::all();

    	foreach ($arrayProfesores as $key => $profesor) {
			$e = new Election;
			$e->teacher = $profesor->name;
			$e->course = $request->input('course');
			$e->cAvailable = $profesor->cInitial;
            $e->dirPermission = false;
            $e->profPermission = true;
            $e->coorPermission = false;
			$e->save();
		}

		Notification::success('La elección se ha creado exitosamente!');
		return redirect('/');
    }

    public function getElection() {

        $course = Input::get('course');

        $elección = Election::where('course', '=', $course)
                               ->get();

        return response()->json($elección);
    }

}
