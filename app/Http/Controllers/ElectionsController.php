<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Course;
use App\Teacher;
use App\Election;
use App\Subject;
use App\Solicitude;

use Notification;

class ElectionsController extends Controller
{
    public function getIndex()
    {
        $arrayElecciones = Election::select('course')->distinct()->get();

        return view('elections.index',compact('arrayElecciones'));

    }

    public function getCourseIndex($course, Request $request)
    {
        $arrayAsignaturas = Subject::all();
        $arrayProfesores = Teacher::all();
        $subj_id = $request->get('subject_id');
        $teacher = $request->get('teacher');

        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->select('subjects.name', 'solicitudes.teacher', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->subjectid($subj_id)
            ->teacher($teacher)
            ->orderBy('subjects.name')
            ->get();

        $eleccionDir = Election::where('teacher', 'Jose Garcia')
                                    ->where('course', $course)
                                    ->get();

        foreach ($eleccionDir as $eleccion) {
            $elecPermission = $eleccion->elecPermission;
        }

        return view('elections.course')->with('arraySolicitudes', $arraySolicitudes)
                                        ->with('arrayAsignaturas', $arrayAsignaturas)
                                          ->with('arrayProfesores', $arrayProfesores)
                                          ->with('elecPermission', $elecPermission)
                                          ->with('course', $course);
    }

    public function getCreate() 
    {
    	$arrayCursos = Course::all();

    	return view('settings.elections.create', ['arrayCursos' => $arrayCursos]);
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
            $e->elecPermission = false;
			$e->save();
		}

		Notification::success('La elección se ha creado exitosamente!');
		return redirect('/settings/elections');
    }

    public function getElection() {

        $course = Input::get('course');

        $elección = Election::where('course', '=', $course)
                               ->get();

        return response()->json($elección);
    }

    public function getIndexSettings()
    {
        $arrayElecciones = Election::select('course')->distinct()->get();

        return view('settings.elections.index',compact('arrayElecciones'));

    }

      public function deleteElection(Request $request, $course)
    {
        $elecciones = Election::where('course', '=', $course)
                               ->get();

        foreach ($elecciones as $eleccion) {
            $eleccion->delete();
        }

        $solicitudes = Solicitude::where('course', '=', $course)
                               ->get();

        foreach($solicitudes as $solicitud) {
            $solicitud->delete();
        }

        Notification::success('La elección fue eliminada exitosamente!');
        return redirect('/settings/elections');
    }



}
