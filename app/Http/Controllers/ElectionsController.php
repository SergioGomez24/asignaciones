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
        $arrayElecciones = Election::select('course')
                                    ->distinct()
                                    ->where('state', 0)
                                    ->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

        return view('elections.course',compact('arrayElecciones', 'cont'));

    }

    public function getIndex($course, Request $request)
    {
        $subj_id = $request->get('subject_id');
        $teacher_id = $request->get('teacher_id');
        $filter = 0;

        $arrayAsignaturas = Subject::join('solicitudes', 'solicitudes.subject_id', '=', 'subjects.id')
            ->select('subjects.id', 'subjects.name')
            ->distinct()
            ->where('solicitudes.course', $course)
            ->orderBy('subjects.name')
            ->get();

        $arrayProfesores = Teacher::join('solicitudes', 'solicitudes.teacher_id', '=', 'teachers.id')
            ->select('teachers.id', 'teachers.name')
            ->distinct()
            ->where('solicitudes.course', $course)
            ->orderBy('teachers.name')
            ->get();

        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->join('teachers', 'teachers.id', '=', 'solicitudes.teacher_id')
            ->select('subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->subjectid($subj_id)
            ->teacherid($teacher_id)
            ->orderBy('teachers.name')
            ->get();

        if ($subj_id) {
            $filter++;
        }

        if ($teacher_id) {
            $filter++;
        }

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
                                        ->with('filter', $filter)
                                        ->with('course', $course);
    }

    /* obtener la eleccion final en pdf */
    public function elections($course) 
    {
        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->join('teachers', 'teachers.id', '=', 'solicitudes.teacher_id')
            ->select('subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->orderBy('teachers.name')
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

    /* obtener la eleccion de un curso */
    public function getElection() {

        $course = Input::get('course');

        $elección = Election::where('course', '=', $course)
                               ->get();

        return response()->json($elección);
    }

    /* obtener la elección de un Profesor */
    public function getElectionProf(Request $request) {

        if($request->ajax()){
            $id = $request->id;
            $course = $request->course;
            $cAvailable = 0;

            $eleccionProfesor = Election::where('course', '=', $course)
                             ->where('teacher_id', '=', $id)
                             ->get();

            foreach ($eleccionProfesor as $eleccion) {
                $cAvailable = $eleccion->cAvailable;
            }

            return response()->json(['cAvailable' => $cAvailable]);
        }
    }

    /* obtener las diferentes elecciones creadas */
    public function getIndexSettings()
    {
        $arrayElecciones = Election::select('course', 'threshold', 'state')->distinct()->get();

        return view('settings.elections.index',compact('arrayElecciones'));

    }

    /* Funciones para crear una elección */
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
            $e->state = true;
            $e->threshold = $request->input('threshold');
            $e->save();
        }

        //Notification::success('La elección se ha creado exitosamente!');
        return redirect('/settings/elections');
    }

    /* Funciones para editar una elección */
    public function getEdit($course) 
    {
        $eleccion = Election::select('course', 'threshold', 'state')
                            ->distinct()
                            ->where('course', '=', $course)
                            ->get();

        foreach ($eleccion as $e) {
            $threshold = $e->threshold;
            $state = $e->state;
        } 
                
        return view('settings.elections.edit', compact('course', 'threshold', 'state'));
    }

    public function putEdit(Request $request, $course)
    {
        $elecciones = Election::where('course', '=', $course)
                            ->get();

        foreach ($elecciones as $e) {
            $e->course = $request->input('course');
            $e->threshold = $request->input('threshold');
            $e->state = $request->input('state');
            $e->save();
        }

        Notification::success('La elección ha sido modificada exitosamente!');
        return redirect('/settings/elections');
    }

    /* eliminar una eleccion */
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
