<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Course;
use App\Solicitude;
use App\Subject;
use App\Campus;
use App\Certification;
use App\Teacher;
use App\Coursesubject;
use App\Election;
use Notification;

class SolicitudesController extends Controller
{
    /* Funciones para solicitudes Profesor */
	public function getCourseTeacher() 
    {
    	$arrayElecciones = Election::select('course')
                            ->distinct()
                            ->where('state', true)
                            ->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

    	return view('solicitudes.teacher.course', compact('arrayElecciones', 'cont'));
    }

    public function getTeacherIndex($course, Request $request)
    {
        $usuario = Auth()->user()->id;
        $subj_id = $request->get('subject_id');
        $teacher_id = $request->get('teacher_id');
        $contCréditosProf = 0;
        $filter = 0;

        $arrayAsignaturasTeacher = Subject::join('solicitudes', 'solicitudes.subject_id', '=', 'subjects.id')
                ->select('subjects.id','subjects.name')
                ->distinct()
                ->where('solicitudes.teacher_id', '=', $usuario)
                ->where('solicitudes.course', $course)
                ->orderBy('subjects.name')
                ->get();

        $arraySolicitudesProf = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->join('teachers', 'teachers.id', '=', 'solicitudes.teacher_id')
            ->select('subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->where('solicitudes.teacher_id', '=', $usuario)
            ->subjectid($subj_id)
            ->teacherid($teacher_id)
            ->orderBy('subjects.name')
            ->simplePaginate(8);

        foreach ($arraySolicitudesProf as $key => $solicitud) {
            $contCréditosProf = $contCréditosProf + $solicitud->cTheory + $solicitud->cPractice + $solicitud->cSeminar;

            if ($solicitud->cTheory == 0) {
                $solicitud->cTheory = "";
            }

            if ($solicitud->cPractice == 0) {
                $solicitud->cPractice = "";
            }

            if ($solicitud->cSeminar == 0) {
                $solicitud->cSeminar = "";
            }
        }

        if ($subj_id) {
            $filter++;
        }

        if ($teacher_id) {
            $filter++;
        }

        $teacher = Teacher::select('teachers.cInitial')
                            ->where('teachers.id', $usuario)
                            ->get();

        foreach ($teacher as $key => $t) {
            $cInitial = $t->cInitial;
        }

        $eleccionProfesor = Election::where('teacher_id', '=', $usuario)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $eleccion) {
            $dirPermission = $eleccion->dirPermission;
            $profPermission = $eleccion->profPermission;
            $coorPermission = $eleccion->coorPermission;
        }


        return view('solicitudes.teacher.index')->with('arraySolicitudesProf', $arraySolicitudesProf)
                                          ->with('arrayAsignaturasTeacher', $arrayAsignaturasTeacher)
                                          ->with('subj_id', $subj_id)
                                          ->with('teacher_id', $teacher_id)
                                          ->with('cInitial', $cInitial)
                                          ->with('contCréditosProf', $contCréditosProf)
                                          ->with('course', $course)
                                          ->with('filter', $filter)
                                          ->with('dirPermission', $dirPermission)
                                          ->with('profPermission', $profPermission)
                                          ->with('coorPermission', $coorPermission);
    }

    /* Funciones para solicitudes Director */
    public function getCourseDirector() 
    {
        $arrayElecciones = Election::select('course')
                            ->distinct()
                            ->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

        return view('solicitudes.director.course', compact('arrayElecciones', 'cont'));
    }

    public function getTeacherList($course) {

        $arrayProfesores = Teacher::join('elections', 'elections.teacher_id', '=', 'teachers.id')
            ->select('teachers.id', 'teachers.name', 'teachers.cInitial', 'elections.cAvailable')
            ->where('teachers.id', '!=', '1')
            ->where('elections.course', $course)
            ->orderBy('teachers.name')
            ->simplePaginate(8);

        return view('solicitudes.director.teacher', compact('arrayProfesores', 'course'));
    }

    public function getDirectorIndex($course, $teacher_id, Request $request) {

        $usuario = Auth()->user()->id;
        $subj_id = $request->get('subject_id');
        $filter = 0;

        $arrayAsignaturasProfesores = Subject::join('solicitudes', 'solicitudes.subject_id', '=', 'subjects.id')
                ->select('subjects.id','subjects.name')
                ->distinct()
                ->where('solicitudes.course', $course)
                ->where('solicitudes.teacher_id', $teacher_id)
                ->orderBy('subjects.name')
                ->get();

        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->join('teachers', 'teachers.id', '=', 'solicitudes.teacher_id')
            ->select('subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->where('solicitudes.teacher_id', $teacher_id)
            ->subjectid($subj_id)
            ->orderBy('subjects.name')
            ->simplePaginate(8);

        if ($subj_id) {
            $filter++;
        }

        $eleccionProfesor = Election::where('teacher_id', '=', $usuario)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $eleccion) {
            $dirPermission = $eleccion->dirPermission;
            $profPermission = $eleccion->profPermission;
            $coorPermission = $eleccion->coorPermission;
            $state = $eleccion->state;
        }

        return view('solicitudes.director.index')->with('arraySolicitudes', $arraySolicitudes)
                                          ->with('arrayAsignaturasProfesores', $arrayAsignaturasProfesores)
                                          ->with('subj_id', $subj_id)
                                          ->with('course', $course)
                                          ->with('filter', $filter)
                                          ->with('dirPermission', $dirPermission)
                                          ->with('profPermission', $profPermission)
                                          ->with('coorPermission', $coorPermission)
                                          ->with('state', $state);

    }

    public function getSolicitude() {
        $subject_id = Input::get('subject_id');
        $teacher_id = Input::get('teacher_id');
        $course = Input::get('course');

        $solicitud = Solicitude::where('subject_id', '=', $subject_id)
                                ->where('teacher_id', '=', $teacher_id)
                                ->where('course', '=', $course)
                                ->get();

        return response()->json($solicitud);
    }

    public function getSolicitudes(Request $request) {

        if($request->ajax()){
            $subject_id = $request->subject_id;
            $course = $request->course;
            $id = $request->id;
            $totalT = 0;
            $totalP = 0;
            $totalS = 0;

            $solicitudes = Solicitude::where('subject_id', '=', $subject_id)
                                ->where('id', '!=', $id)
                                ->where('course', '=', $course)
                                ->get();

            foreach ($solicitudes as $key => $s) {
                $totalT += $s->cTheory;
                $totalP += $s->cPractice;
                $totalS += $s->cSeminar;
            }

            $subject = Subject::findOrFail($subject_id);

            $totalT = $subject->cTheory - $totalT;
            $totalP = $subject->cPractice - $totalP;
            $totalS = $subject->cSeminar - $totalS;

            
            return response()->json(['totalT' => $totalT, 'totalP' => $totalP, 'totalS' => $totalS ]);
        }
    }

    /* Funciones para crear solicitudes */
    public function getCourse() 
    {
        $arrayElecciones = Election::select('course')->distinct()
                                    ->where('state', true)
                                    ->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

        return view('solicitudes.course',compact('arrayElecciones', 'cont'));
    }

    public function getCreate($course) 
    {
        $usuario = Auth()->user()->id;
        $arrayCampus = Campus::all();
        $arrayTitulaciones = Certification::all();
        $arrayCursoAsignaturas = Coursesubject::all();
        $eleccionProfesor = Election::where('teacher_id', '=', $usuario)
                                    ->where('course', '=', $course)
                                    ->get();

        $arraySolicitudesElegidas = Solicitude::select('solicitudes.subject_id')
                                    ->where('teacher_id', '=', $usuario)
                                    ->where('course', '=', $course)
                                    ->get();

        $arrayAsignaturas = Subject::whereNotIn('id', $arraySolicitudesElegidas)
                            ->orderBy('name')
                            ->get();
        

        foreach ($eleccionProfesor as $eleccion) {
            $cAvailable = $eleccion->cAvailable;
            $profPermission = $eleccion->profPermission;
        }

        if($profPermission == 0){
            return view('home');
        }else{

        return view('solicitudes.create')->with('course',$course)
                                          ->with('arrayAsignaturas',$arrayAsignaturas)
                                          ->with('arrayCampus',$arrayCampus)
                                          ->with('arrayTitulaciones',$arrayTitulaciones)
                                          ->with('cAvailable', $cAvailable)
                                          ->with('arrayCursoAsignaturas',$arrayCursoAsignaturas);
        }
    }

    public function postCreate($course, Request $request) 
    {
        $usuario = Auth()->user()->id;

        $a = new Solicitude;
        $a->subject_id = $request->input('subject');
        $a->teacher_id = $usuario;
        $a->course = $course;
        $a->cTheory = $request->input('cTheory');
        $a->cPractice = $request->input('cPractice');
        $a->cSeminar = $request->input('cSeminar');
        $a->save();
        Notification::success('La solicitud se ha guardado exitosamente!');

        $eleccion = Election::where('teacher_id', $a->teacher_id)
                             ->where('course', $a->course)
                             ->get();

        foreach ($eleccion as $p) {
            $p->cAvailable = $p->cAvailable - $a->cTheory - $a->cPractice - $a->cSeminar;
            $p->save();
        }

        return redirect('/solicitudes/create/'.$course);
    }

    /* Funciones para editar solicitudes Profesor */
    public function getTeacherEdit($id) 
    {
        $solicitud = Solicitude::findOrFail($id);
        $course = $solicitud->course;
                
        return view('solicitudes.teacher.edit')->with('solicitud', $solicitud)
                                               ->with('course', $course);
    }

    public function putTeacherEdit(Request $request, $id)
    {
        $cTnew = $request->input('cTheory');
        $cPnew = $request->input('cPractice');
        $cSnew = $request->input('cSeminar');
        $cAvailable = $request->input('cds');

        if ($cTnew == "") {
            $cTnew = null;
        }

        if ($cPnew == "") {
            $cPnew = null;
        }

        if ($cSnew == "") {
            $cSnew = null;
        }

        $a = Solicitude::findOrFail($id);
        $c = $a->course;

        $eleccion = Election::where('teacher_id', $a->teacher_id)
                            ->where('course', $c)
                            ->get();

        foreach ($eleccion as $p) {
            $p->cAvailable = $cAvailable;
            $p->save();
        }

        $a->cTheory = $cTnew;
        $a->cSeminar = $cSnew;
        $a->cPractice = $cPnew;
        $a->save();
        Notification::success('La solicitud ha sido modificada exitosamente!');

        return redirect('/solicitudes/teacher/index/'. $c);  
    }

    /* Funciones para editar solicitudes Director */
    public function getDirectorEdit($id) 
    {
        $solicitud = Solicitude::findOrFail($id);
        $course = $solicitud->course;
                
        return view('solicitudes.director.edit')->with('solicitud', $solicitud)
                                               ->with('course', $course);
    }

    public function putDirectorEdit(Request $request, $id)
    {
        $cTnew = $request->input('cTheory');
        $cPnew = $request->input('cPractice');
        $cSnew = $request->input('cSeminar');
        $cAvailable = $request->input('cds');

        if ($cTnew == "") {
            $cTnew = null;
        }

        if ($cPnew == "") {
            $cPnew = null;
        }

        if ($cSnew == "") {
            $cSnew = null;
        }

        $a = Solicitude::findOrFail($id);
        $c = $a->course;

        $eleccion = Election::where('teacher_id', $a->teacher_id)
                            ->where('course', $c)
                            ->get();

        foreach ($eleccion as $p) {
            $p->cAvailable = $cAvailable;
            $p->save();
        }

        $a->cTheory = $cTnew;
        $a->cSeminar = $cSnew;
        $a->cPractice = $cPnew;
        $a->save();
        Notification::success('La solicitud ha sido modificada exitosamente!');

        return redirect('/solicitudes/director/index/'. $c);  
    }

    /* Eliminar solicitud */
    public function deleteSolicitude(Request $request, $id)
    {
        $a = Solicitude::findOrFail($id);
        $c = $a->course;
        $a->delete();

        $role = Auth()->user()->role;

        $eleccion = Election::where('teacher_id', $a->teacher_id)
                             ->where('course', $c)
                             ->get();

        foreach ($eleccion as $p) {
            $p->cAvailable = $p->cAvailable + $a->cTheory + $a->cPractice + $a->cSeminar;
            $p->save();
        }

        Notification::success('La solicitud fue eliminada exitosamente!');

        if ($role == "Profesor") {
            return redirect('/solicitudes/teacher/index/'. $c);
        }else{
            return redirect('/solicitudes/director/index/'. $c);
        }
    }

    public function editPermissionProf(Request $request, $course)
    {
        $usuario = Auth()->user()->id;
        $coorPermission = true;

        $eleccionDir = Election::where('teacher_id', '1')
                             ->where('course', $course)
                             ->get();

        foreach ($eleccionDir as $d){
            $d->profPermission = false;
            $d->save();
        }


        $eleccion = Election::where('teacher_id', $usuario)
                             ->where('course', $course)
                             ->get();

        foreach ($eleccion as $p) {
            $p->profPermission = false;
            $p->save();
        }

        $elecciones = Election::where('course', $course)
                                ->get();

        foreach ($elecciones as $key => $c) {
            if($c->profPermission == true)
                $coorPermission = false;
        }

        if($coorPermission == true) {
            foreach ($elecciones as $key => $c) {
                $c->coorPermission = true;
                $c->save();
            }
        }

        Notification::success('Las solicitudes fue enviadas exitosamente!');
        return redirect('home');

    }

    public function editPermissionCoor(Request $request, $course)
    {
        $usuario = Auth()->user()->id;
        $coorPermission = true;
        $profPermission = false;

        $eleccionDir = Election::where('teacher_id', '1')
                             ->where('course', $course)
                             ->get();

        foreach ($eleccionDir as $d){
            $d->coorPermission = false;
            $d->save();
        }


        $eleccion = Election::where('teacher_id', $usuario)
                             ->where('course', $course)
                             ->get();

        foreach ($eleccion as $p) {
            $p->coorPermission = false;
            $p->save();
        }

        $elecciones = Election::where('course', $course)
                                ->get();

        foreach ($elecciones as $key => $c) {
            if($c->coorPermission == true)
                $coorPermission = false;
        }

        $eleccionesProf = Election::where('course', $course)
                                ->where('teacher_id', '!=', '1')
                                ->get();

        if($coorPermission == true) {
            foreach ($eleccionesProf as $key => $p) {
                if($p->cAvailable - 2 > 0){
                    $p->profPermission = true;
                    $p->save();
                    $profPermission = true;
                }
            }

            if($profPermission == false){
                foreach ($eleccionDir as $key => $c) {
                    $c->dirPermission = true;
                    $c->save();
                }
            }
        }

        Notification::success('Las solicitudes fue enviadas exitosamente!');
        return redirect('home');
    }

    public function editPermissionDir(Request $request, $course)
    {

        $elecciones = Election::where('course', $course)
                              ->get();

        foreach($elecciones as $eleccion) {
            $eleccion->elecPermission = true;
            $eleccion->state = false;
            $eleccion->save();
        }

        Notification::success('Las solicitudes se cerraron exitosamente!');
        return redirect('home');
    }

    public function openElection(Request $request, $course)
    {
        $elecciones = Election::where('course', $course)
                              ->get();

        foreach($elecciones as $eleccion) {
            $eleccion->elecPermission = false;
            $eleccion->state = true;
            $eleccion->save();
        }

        Notification::success('Las solicitudes se abrieron exitosamente!');
        return redirect('/solicitudes/director/index/'. $course);
    }
}