<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Course;
use App\Teacher;
use App\Election;
use App\Subject;
use App\Solicitude;
use \PDF;

use Notification;

class ElectionsController extends Controller
{
    public function getCourse()
    {
        $arrayElecciones = Election::select('course')->distinct()->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

        return view('elections.course',compact('arrayElecciones', 'cont'));

    }

    public function getIndex($course, Request $request)
    {
        $arrayAsignaturas = Subject::all();
        $arrayProfesores = Teacher::all();
        
        $arraySolicitudes = $this->getArraySolicitudes($course, $request);

        $eleccionDir = Election::where('teacher_id', '1')
                                    ->where('course', $course)
                                    ->get();

        foreach ($eleccionDir as $eleccion) {
            $elecPermission = $eleccion->elecPermission;
        }

        return view('elections.index')->with('arraySolicitudes', $arraySolicitudes)
                                        ->with('arrayAsignaturas', $arrayAsignaturas)
                                        ->with('arrayProfesores', $arrayProfesores)
                                        ->with('elecPermission', $elecPermission)
                                        ->with('course', $course);
    }

    public function elections($course) 
    {
        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->select('subjects.name', 'solicitudes.teacher_id', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->orderBy('solicitudes.teacher_id')
            ->get();

        foreach ($arraySolicitudes as $key => $solicitud) {
            if($solicitud->cTheory == 0){
                $solicitud->cTheory = "";
            }

            if($solicitud->cPractice == 0){
                $solicitud->cPractice = "";
            }

            if($solicitud->cSeminar == 0){
                $solicitud->cSeminar = "";
            }    
        }

        $date = date('d-m-Y');
        $course = "$course";
        $view =  \View::make('pdf.elections', compact('arraySolicitudes', 'date', 'course'))->render();
        $pdf = PDF::loadHTML($view);
        return $pdf->stream('elections');
    }


    public function getArraySolicitudes($course,Request $request) {

        $subj_id = $request->get('subject_id');
        $teacher_id = $request->get('teacher_id');

        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->select('subjects.name', 'solicitudes.teacher_id', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->subjectid($subj_id)
            ->teacherid($teacher_id)
            ->orderBy('subjects.name')
            ->get();

        foreach ($arraySolicitudes as $key => $solicitud) {
            if($solicitud->cTheory == 0){
                $solicitud->cTheory = "";
            }

            if($solicitud->cPractice == 0){
                $solicitud->cPractice = "";
            }

            if($solicitud->cSeminar == 0){
                $solicitud->cSeminar = "";
            }    
        }

        return $arraySolicitudes;
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
			$e->teacher_id = $profesor->id;
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
