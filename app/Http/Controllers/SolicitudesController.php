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
	public function getIndex() 
    {
    	$arrayElecciones = Election::select('course')->distinct()->get();

    	return view('solicitudes.index', compact('arrayElecciones'));
    }

    public function getCourseIndex($course, Request $request)
    {
        $usuario = Auth()->user()->name;
        $arrayAsignaturas = Subject::all();
        $arrayProfesores = Teacher::all();
        $subj_id = $request->get('subject_id');
        $teacher = $request->get('teacher');
        $contCréditosProf = 0;

        $arraySolicitudes = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->select('subjects.name', 'solicitudes.teacher', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->subjectid($subj_id)
            ->teacher($teacher)
            ->orderBy('subjects.name')
            ->simplePaginate(7);

        $arraySolicitudesProf = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->select('subjects.name', 'solicitudes.teacher', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->where('solicitudes.teacher', '=', $usuario)
            ->subjectid($subj_id)
            ->teacher($teacher)
            ->orderBy('subjects.name')
            ->simplePaginate(7);

        foreach ($arraySolicitudesProf as $key => $solicitud) {
            $contCréditosProf = $contCréditosProf + $solicitud->cTheory + $solicitud->cPractice + $solicitud->cSeminar;
        }

        $eleccionProfesor = Election::where('teacher', '=', $usuario)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $eleccion) {
            $dirPermission = $eleccion->dirPermission;
            $profPermission = $eleccion->profPermission;
            $coorPermission = $eleccion->coorPermission;
        }


        return view('solicitudes.course')->with('arraySolicitudes', $arraySolicitudes)
                                          ->with('arraySolicitudesProf', $arraySolicitudesProf)
                                          ->with('arrayAsignaturas', $arrayAsignaturas)
                                          ->with('arrayProfesores', $arrayProfesores)
                                          ->with('subj_id', $subj_id)
                                          ->with('teacher', $teacher)
                                          ->with('contCréditosProf', $contCréditosProf)
                                          ->with('course', $course)
                                          ->with('dirPermission', $dirPermission)
                                          ->with('profPermission', $profPermission)
                                          ->with('coorPermission', $coorPermission);

    }

    public function getSolicitude() {
        $subject_id = Input::get('subject_id');
        $teacher = Input::get('teacher');
        $course = Input::get('course');

        $solicitud = Solicitude::where('subject_id', '=', $subject_id)
                                ->where('teacher', '=', $teacher)
                                ->where('course', '=', $course)
                                ->get();

        return response()->json($solicitud);
    }

    public function getCreateCourse() 
    {
        $arrayElecciones = Election::select('course')->distinct()->get();

        return view('solicitudes.election',compact('arrayElecciones'));
    }

    public function getCreate($course) 
    {
        $usuario = Auth()->user()->name;
        $arrayAsignaturas = Subject::all();
        $arrayCampus = Campus::all();
        $arrayTitulaciones = Certification::all();
        $arrayCursoAsignaturas = Coursesubject::all();
        $eleccionProfesor = Election::where('teacher', '=', $usuario)
                                    ->where('course', '=', $course)
                                    ->get();

        $array = Solicitude::where('teacher', '=', $usuario)
                            ->where('course', '=', $course)
                            ->get();

        foreach ($array as $key => $s) {
            foreach ($arrayAsignaturas as $key => $a) {
                if($s->subject_id == $a->id){
                    $arrayAsignaturas->pull($a->id);

                } 
            }
        }

        dd($arrayA);

        foreach ($eleccionProfesor as $eleccion) {
            $cAvailable = $eleccion->cAvailable;
        }

        if($cAvailable == 0){
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
        $usuario = Auth()->user()->name;

        $a = new Solicitude;
        $a->subject_id = $request->input('subject');
        $a->teacher = $usuario;
        $a->course = $course;
        $a->cTheory = $request->input('cTheory');
        $a->cPractice = $request->input('cPractice');
        $a->cSeminar = $request->input('cSeminar');
        $a->save();
        Notification::success('La solicitud se ha guardado exitosamente!');

        $eleccion = Election::where('teacher', $a->teacher)
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

        $eleccion = Election::where('teacher', $a->teacher)
                            ->where('course', $c)
                            ->get();

        if ($a->cTheory < $cTnew) {
            $diferencia = $cTnew - $a->cTheory;
            foreach ($eleccion as $p) {
                $p->cAvailable = $p->cAvailable - $diferencia;
                $p->save();
            }
        }elseif($a->cTheory > $cTnew){
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

        $a->cTheory = $cTnew;
        $a->cSeminar = $cSnew;
        $a->cPractice = $cPnew;
        $a->save();
        Notification::success('La solicitud ha sido modificada exitosamente!');
        return redirect('/solicitudes/course/'. $c);
    }

    public function deleteSolicitude(Request $request, $id)
    {
        $a = Solicitude::findOrFail($id);
        $c = $a->course;
        $a->delete();

        $eleccion = Election::where('teacher', $a->teacher)
                             ->where('course', $c)
                             ->get();

        foreach ($eleccion as $p) {
            $p->cAvailable = $p->cAvailable + $a->cTheory + $a->cPractice + $a->cSeminar;
            $p->save();
        }

        Notification::success('La solicitud fue eliminada exitosamente!');
        return redirect('/solicitudes/course/'. $c);
    }

    public function editPermissionProf(Request $request, $course)
    {
        $usuario = Auth()->user()->name;
        $coorPermission = true;

        $eleccionDir = Election::where('teacher', 'Jose Garcia')
                             ->where('course', $course)
                             ->get();

        foreach ($eleccionDir as $d){
            $d->profPermission = false;
            $d->save();
        }


        $eleccion = Election::where('teacher', $usuario)
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
        $usuario = Auth()->user()->name;
        $coorPermission = true;

        $eleccionDir = Election::where('teacher', 'Jose Garcia')
                             ->where('course', $course)
                             ->get();

        foreach ($eleccionDir as $d){
            $d->coorPermission = false;
            $d->save();
        }


        $eleccion = Election::where('teacher', $usuario)
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
        $usuario = Auth()->user()->name;

        $eleccion = Election::where('teacher', $usuario)
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
            $eleccion->save();
        }

        Notification::success('Las solicitudes fue enviadas exitosamente!');
        return redirect('/');
    }
}