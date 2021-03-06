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
    /* Obtener cursos disponibles para los coordinadores */
    public function getCourse() 
    {
        $arrayElecciones = Election::select('course')
                            ->distinct()
                            ->where('state', true)
                            ->where('coorPermission', 1)
                            ->get();
        $cont = 0;

        foreach ($arrayElecciones as $key => $e) {
            $cont = $cont + 1;
        }

        return view('solicitudes.coordinator.course', compact('arrayElecciones', 'cont'));
    }

    /* Mostrar la tabla de solicitudes para los coordinadores */
    public function getIndex($course, Request $request)
    {
        $usuario = Auth()->user()->id;
        $arrayProfesores = Teacher::all();
        $subject_id = $request->get('subject');
        $teacher_id = $request->get('teacher_id');

        $arrayAsignaturasCoor = Subject::join('solicitudes', 'solicitudes.subject_id', '=', 'subjects.id')
                ->select('subjects.id','subjects.name')
                ->distinct()
                ->where('subjects.coordinator_id', '=', $usuario)
                ->where('solicitudes.state', true)
                ->where('solicitudes.course', $course)
                ->orderBy('subjects.name')
                ->get();

        $arraySolicitudesCoor = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->join('teachers', 'teachers.id', '=', 'solicitudes.teacher_id')
            ->select('subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->subjectid($subject_id)
            ->teacherid($teacher_id)
            ->orderBy('teachers.name')
            ->simplePaginate(7);

        $eleccionProfesor = Election::where('teacher_id', '=', $usuario)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $eleccion) {
            $dirPermission = $eleccion->dirPermission;
            $profPermission = $eleccion->profPermission;
            $coorPermission = $eleccion->coorPermission;
        }

        return view('solicitudes.coordinator.index')->with('arraySolicitudesCoor', $arraySolicitudesCoor)
                                                ->with('arrayAsignaturasCoor', $arrayAsignaturasCoor)
                                                ->with('arrayProfesores', $arrayProfesores)
                                                ->with('teacher_id', $teacher_id)
                                                ->with('subject_id', $subject_id)
                                                ->with('course', $course)
                                                ->with('dirPermission', $dirPermission)
                                                ->with('profPermission', $profPermission)
                                                ->with('coorPermission', $coorPermission);
    }

    public function getCoordinator(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $info = Teacher::find($id);
            
            return response()->json($info);
        }
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
        $s = $a->subject_id;

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
        
        return redirect("/coordinators/index/{$c}?subject={$s}");
    }

    public function deleteSolicitudeCoor(Request $request, $id)
    {
        $a = Solicitude::findOrFail($id);
        $c = $a->course;
        $s = $a->subject_id;
        $a->delete();

        $eleccion = Election::where('teacher_id', $a->teacher_id)
                             ->where('course', $c)
                             ->get();

        foreach ($eleccion as $p) {
            $p->cAvailable = $p->cAvailable + $a->cTheory + $a->cPractice + $a->cSeminar;
            $p->save();
        }

        Notification::success('La solicitud fue eliminada exitosamente!');
        return redirect("/coordinators/index/{$c}?subject={$s}");
    }
}