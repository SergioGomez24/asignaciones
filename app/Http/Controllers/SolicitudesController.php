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
            ->simplePaginate(7);

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
                                          ->with('dirPermission', $dirPermission)
                                          ->with('profPermission', $profPermission)
                                          ->with('coorPermission', $coorPermission);
    }

    /* Funciones para solicitudes Director */
    public function getCourseDirector() 
    {
        $arrayElecciones = Election::select('course')
                            ->distinct()
                            ->where('state', true)
                            ->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

        return view('solicitudes.director.course', compact('arrayElecciones', 'cont'));
    }

    public function getDirectorIndex($course, Request $request) {

        $usuario = Auth()->user()->id;
        $arrayAsignaturas = Subject::all();
        $arrayProfesores = Teacher::all();
        $subj_id = $request->get('subject_id');
        $teacher_id = $request->get('teacher_id');

        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->join('teachers', 'teachers.id', '=', 'solicitudes.teacher_id')
            ->select('subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->subjectid($subj_id)
            ->teacherid($teacher_id)
            ->orderBy('subjects.name')
            ->simplePaginate(7);

        $eleccionProfesor = Election::where('teacher_id', '=', $usuario)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $eleccion) {
            $dirPermission = $eleccion->dirPermission;
            $profPermission = $eleccion->profPermission;
            $coorPermission = $eleccion->coorPermission;
        }

        return view('solicitudes.director.index')->with('arraySolicitudes', $arraySolicitudes)
                                          ->with('arrayAsignaturas', $arrayAsignaturas)
                                          ->with('arrayProfesores', $arrayProfesores)
                                          ->with('subj_id', $subj_id)
                                          ->with('teacher_id', $teacher_id)
                                          ->with('course', $course)
                                          ->with('dirPermission', $dirPermission)
                                          ->with('profPermission', $profPermission)
                                          ->with('coorPermission', $coorPermission);

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
            $subject_id = $request->id;
            $course = $request->course;
            $totalT = 0;
            $totalP = 0;
            $totalS = 0;

            $solicitudes = Solicitude::where('subject_id', '=', $subject_id)
                                ->where('course', '=', $course)
                                ->get();

            foreach ($solicitudes as $key => $s) {
                $totalT += $s->cTheory;
                $totalP += $s->cPractice;
                $totalS += $s->cSeminar;
            }

            
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

        /*

        foreach ($array as $key => $s) {
            foreach ($arrayAsignaturas as $key => $a) {
                if($s->subject_id == $a->id){
                   // $arrayAsignaturas->pull($a->id);
                } 
            }
        }*/
        

        foreach ($eleccionProfesor as $eleccion) {
            $cAvailable = $eleccion->cAvailable;
            $profPermission = $eleccion->profPermission;
        }

        if($cAvailable == 0 || $profPermission == 0){
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

    public function getEdit($id) 
    {
        $solicitud = Solicitude::findOrFail($id);
        $course = $solicitud->course;
                
        return view('solicitudes.edit')->with('solicitud', $solicitud)
                                       ->with('course', $course);
    }

    public function putEdit(Request $request, $id)
    {
        $role = Auth()->user()->role;

        $cTnew = $request->input('cTheory');
        $cPnew = $request->input('cPractice');
        $cSnew = $request->input('cSeminar');

        if ($cTnew == "") {
            $cTnew = 0;
        }

        if ($cPnew == "") {
            $cPnew = 0;
        }

        if ($cSnew == "") {
            $cSnew = 0;
        }

        $a = Solicitude::findOrFail($id);
        $c = $a->course;

        $eleccion = Election::where('teacher_id', $a->teacher_id)
                            ->where('course', $c)
                            ->get();

        if ($a->cTheory < $cTnew) {
            $diferencia = $cTnew - $a->cTheory;
            foreach ($eleccion as $p) {
                $p->cAvailable = $p->cAvailable - $diferencia;
                $p->save();
            }
        } elseif($a->cTheory > $cTnew){
            $diferencia = $a->cTheory - $cTnew;
            foreach ($eleccion as $p) {
                $p->cAvailable = $p->cAvailable + $diferencia;
                $p->save();
            }
        }

        if ($a->cPractice < $cPnew) {
            $diferencia = $cPnew - $a->cPractice;
            foreach ($eleccion as $p) {
                $p->cAvailable = $p->cAvailable - $diferencia;
                $p->save();
            }
        }elseif($a->cPractice > $cPnew){
            $diferencia = $a->cPractice - $cPnew;
            foreach ($eleccion as $p) {
                $p->cAvailable = $p->cAvailable + $diferencia;
                $p->save();
            }
        }

        if ($a->cSeminar < $cSnew) {
            $diferencia = $cSnew - $a->cSeminar;
            foreach ($eleccion as $p) {
                $p->cAvailable = $p->cAvailable - $diferencia;
                $p->save();
            }
        }elseif($a->cSeminar > $cSnew){
            $diferencia = $a->cSeminar - $cSnew;
            foreach ($eleccion as $p) {
                $p->cAvailable = $p->cAvailable + $diferencia;
                $p->save();
            }
        }

        if ($cTnew == 0) {
            $cTnew = null;
        }

        if ($cPnew == 0) {
            $cPnew = null;
        }

        if ($cSnew == 0) {
            $cSnew = null;
        }

        $a->cTheory = $cTnew;
        $a->cSeminar = $cSnew;
        $a->cPractice = $cPnew;
        $a->save();
        Notification::success('La solicitud ha sido modificada exitosamente!');

        if ($role == "Profesor") {
            return redirect('/solicitudes/teacher/index/'. $c);
        }else{
            return redirect('/solicitudes/director/index/'. $c);
        }    
    }

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
        return redirect('/');

    }

    public function editPermissionCoor(Request $request, $course)
    {
        $usuario = Auth()->user()->id;
        $coorPermission = true;

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

        if($coorPermission == true) {
            foreach ($elecciones as $key => $c) {
                $c->dirPermission = true;
                $c->save();
            }
        }

        Notification::success('Las solicitudes fue enviadas exitosamente!');
        return redirect('/');
    }

    public function editPermissionDir(Request $request, $course)
    {
        $usuario = Auth()->user()->id;

        $eleccion = Election::where('teacher_id', $usuario)
                             ->where('course', $course)
                             ->get();

        foreach ($eleccion as $p) {
            $p->dirPermission = false;
            $p->save();
        }

        $elecciones = Election::where('course', $course)
                              ->get();

        foreach($elecciones as $eleccion) {
            $eleccion->elecPermission = true;
            $eleccion->state = false;
            $eleccion->save();
        }

        Notification::success('Las solicitudes fue enviadas exitosamente!');
        return redirect('/');
    }
}