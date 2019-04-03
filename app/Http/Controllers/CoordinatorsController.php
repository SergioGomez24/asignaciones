<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitude;
use App\Subject;
use App\Teacher;
use App\Election;
use Notification;

class CoordinatorsController extends Controller
{
    public function getCourse() 
    {
        $arrayElecciones = Election::select('course')->distinct()->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

        return view('solicitudes.coordinator.course', compact('arrayElecciones', 'cont'));
    }

    public function getIndex($course, Request $request)
    {
        $usuario = Auth()->user()->name;
        $arrayAsignaturas = Subject::all();
        $arrayProfesores = Teacher::all();
        $subj_id = $request->get('subject_id');
        $teacher = $request->get('teacher');

        $arraySolicitudesCoor = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->select('subjects.name', 'solicitudes.teacher', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->where('subjects.coordinator', '=', $usuario)
            ->subjectid($subj_id)
            ->teacher($teacher)
            ->orderBy('subjects.name')
            ->simplePaginate(7);

        $eleccionProfesor = Election::where('teacher', '=', $usuario)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $eleccion) {
            $dirPermission = $eleccion->dirPermission;
            $profPermission = $eleccion->profPermission;
            $coorPermission = $eleccion->coorPermission;
        }

        return view('solicitudes.coordinator.index')->with('arraySolicitudesCoor', $arraySolicitudesCoor)
                                                      ->with('arrayAsignaturas', $arrayAsignaturas)
                                                      ->with('arrayProfesores', $arrayProfesores)
                                                      ->with('subj_id', $subj_id)
                                                      ->with('teacher', $teacher)
                                                      ->with('course', $course)
                                                      ->with('dirPermission', $dirPermission)
                                                      ->with('profPermission', $profPermission)
                                                      ->with('coorPermission', $coorPermission);

    }

    public function getEdit($id) 
    {
        $solicitud = Solicitude::findOrFail($id);
        $course = $solicitud->course;
                
        return view('solicitudes.coordinator.edit')->with('solicitud', $solicitud)
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
        return redirect('/coordinators/course/'. $c);
    }

    public function deleteSolicitudeCoor(Request $request, $id)
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
        return redirect('/coordinators/course/'. $c);
    }
}
