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
            ->select('subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id', 'solicitudes.state')
            ->where('course', '=', $course)
            ->where('solicitudes.teacher_id', '=', $usuario)
            ->subjectid($subj_id)
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
            $profPermission = $eleccion->profPermission;
        }


        return view('solicitudes.teacher.index')->with('arraySolicitudesProf', $arraySolicitudesProf)
                                          ->with('arrayAsignaturasTeacher', $arrayAsignaturasTeacher)
                                          ->with('subj_id', $subj_id)
                                          ->with('cInitial', $cInitial)
                                          ->with('contCréditosProf', $contCréditosProf)
                                          ->with('course', $course)
                                          ->with('filter', $filter)
                                          ->with('profPermission', $profPermission);
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

        $usuario = Auth()->user()->id;

        $arrayProfesores = Teacher::join('elections', 'elections.teacher_id', '=', 'teachers.id')
            ->select('teachers.id', 'teachers.name', 'teachers.cInitial', 'elections.cAvailable')
            ->where('teachers.id', '!=', '1')
            ->where('elections.course', $course)
            ->orderBy('teachers.name')
            ->simplePaginate(8);

        $eleccionProfesor = Election::where('teacher_id', '=', $usuario)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $eleccion) {
            $dirPermission = $eleccion->dirPermission;
            $state = $eleccion->state;
        }

        return view('solicitudes.director.teacher', compact('arrayProfesores', 'course', 'dirPermission', 'state'));
    }

    public function getDirectorIndex($course, $teacher_id, Request $request) {

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
            ->select('subjects.id AS subject_id', 'subjects.name AS asig', 'teachers.name AS prof', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar', 'solicitudes.id')
            ->where('course', '=', $course)
            ->where('solicitudes.teacher_id', $teacher_id)
            ->subjectid($subj_id)
            ->orderBy('subjects.name')
            ->simplePaginate(8);

        $teacher = Teacher::findOrFail($teacher_id);
        $cInitial = $teacher->cInitial;

        $eleccionProfesor = Election::where('teacher_id', '=', $teacher_id)
                             ->where('course', '=', $course)
                             ->get();

        foreach ($eleccionProfesor as $key => $p) {
            $cAvailable = $p->cAvailable;
        }

        $contCréditosProf = $cInitial - $cAvailable;

        if ($subj_id) {
            $filter++;
        }

        return view('solicitudes.director.index')->with('arraySolicitudes', $arraySolicitudes)
                                          ->with('arrayAsignaturasProfesores', $arrayAsignaturasProfesores)
                                          ->with('subj_id', $subj_id)
                                          ->with('teacher_id', $teacher_id)
                                          ->with('course', $course)
                                          ->with('cInitial', $cInitial)
                                          ->with('contCréditosProf', $contCréditosProf)
                                          ->with('filter', $filter);

    }

    /* Crear una solicitud desde el director */
    public function getDirectorCreate($course, $teacher_id) 
    {

        $eleccionProfesor = Election::where('teacher_id', '=', $teacher_id)
                                    ->where('course', '=', $course)
                                    ->get();

        $arraySolicitudesElegidas = Solicitude::select('solicitudes.subject_id')
                                    ->where('teacher_id', '=', $teacher_id)
                                    ->where('course', '=', $course)
                                    ->get();

        $arrayAsignaturas = Subject::whereNotIn('id', $arraySolicitudesElegidas)
                            ->orderBy('name')
                            ->get();

        $teacher = Teacher::findOrFail($teacher_id);
        $name = $teacher->name;

        foreach ($eleccionProfesor as $eleccion) {
            $cAvailable = $eleccion->cAvailable;
        }

        return view('solicitudes.director.create')->with('course',$course)
                                          ->with('teacher_id',$teacher_id)
                                          ->with('name',$name)
                                          ->with('arrayAsignaturas',$arrayAsignaturas)
                                          ->with('cAvailable', $cAvailable);
    }

    public function postDirectorCreate($course, $teacher_id, Request $request) 
    {

        $a = new Solicitude;
        $a->subject_id = $request->input('subject');
        $a->teacher_id = $teacher_id;
        $a->course = $course;
        $a->cTheory = $request->input('cTheory');
        $a->cPractice = $request->input('cPractice');
        $a->cSeminar = $request->input('cSeminar');
        $a->state = true;
        $a->save();

        Notification::success('La solicitud se ha guardado exitosamente!');

        $eleccion = Election::where('teacher_id', $a->teacher_id)
                             ->where('course', $a->course)
                             ->get();

        foreach ($eleccion as $p) {
            $p->cAvailable = $p->cAvailable - $a->cTheory - $a->cPractice - $a->cSeminar;
            $p->save();
        }

        return redirect("/solicitudes/director/index/{$course}/{$teacher_id}");
    }

    /* Obtener una solicitud especifica */
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

    /* Obtener las solicitudes sin contar la del profesor seleccionado */
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

    /* Obtener las solicitudes de una asignatura */
    public function getSolicitudesSubject(Request $request) {

        if($request->ajax()){
            $subject_id = $request->subject_id;
            $course = $request->course;
            $totalT = 0;
            $totalP = 0;
            $totalS = 0;
            $total = 0;

            $solicitudes = Solicitude::where('subject_id', '=', $subject_id)
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

            $total = $totalT+$totalP+$totalS;
            
            return response()->json(['total' => $total, 'totalT' => $totalT, 'totalP' => $totalP, 'totalS' => $totalS]);
        }
    }

    /* Funciones para crear solicitudes */
    public function getCreate($course, Request $request) 
    {
        $usuario = Auth()->user()->id;
        $arrayCampus = Campus::all();
        $arrayTitulaciones = Certification::all();
        $arrayCursoAsignaturas = Coursesubject::all();
        $cert_id = $request->get('certification');
        $camp_id = $request->get('campus');
        $impart_id = $request->get('imparted');
        $filter = 0;

        $eleccionProfesor = Election::where('teacher_id', '=', $usuario)
                                    ->where('course', '=', $course)
                                    ->get();

        $arraySolicitudesElegidas = Solicitude::select('solicitudes.subject_id')
                                    ->where('teacher_id', '=', $usuario)
                                    ->where('course', '=', $course)
                                    ->get();

        $arrayAsignaturas = Subject::whereNotIn('id', $arraySolicitudesElegidas)
                            ->certificationid($cert_id)
                            ->campusid($camp_id)
                            ->impartedid($impart_id)
                            ->orderBy('name')
                            ->get();

        if ($cert_id) {
            $filter++;
        }

        if ($camp_id) {
            $filter++;
        }

        if ($impart_id) {
            $filter++;
        }
        

        foreach ($eleccionProfesor as $eleccion) {
            $cAvailable = $eleccion->cAvailable;
            $profPermission = $eleccion->profPermission;
        }

        return view('solicitudes.create')->with('course',$course)
                                          ->with('arrayAsignaturas',$arrayAsignaturas)
                                          ->with('arrayCampus',$arrayCampus)
                                          ->with('arrayTitulaciones',$arrayTitulaciones)
                                          ->with('cAvailable', $cAvailable)
                                          ->with('filter', $filter)
                                          ->with('arrayCursoAsignaturas',$arrayCursoAsignaturas);
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
        $a->state = true;
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
        $teacher_id = $solicitud->teacher_id;
                
        return view('solicitudes.director.edit')->with('solicitud', $solicitud)
                                                ->with('teacher_id', $teacher_id)
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

        return redirect("/solicitudes/director/index/{$c}/{$a->teacher_id}");  
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
            return redirect("/solicitudes/director/index/{$c}/{$a->teacher_id}");
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
                $cont = 0;

                $arrayAsignaturasCoor = Subject::join('solicitudes', 'solicitudes.subject_id', '=', 'subjects.id')
                ->select('subjects.id','subjects.name')
                ->distinct()
                ->where('subjects.coordinator_id', '=', $c->teacher_id)
                ->where('solicitudes.state', true)
                ->where('solicitudes.course', $course)
                ->orderBy('subjects.name')
                ->get();

                foreach ($arrayAsignaturasCoor as $a) {
                    $cont = $cont + 1;
                }

                if ($cont > 0) {
                    $c->coorPermission = true;
                    $c->save();
                }
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
                if($p->cAvailable - $p->threshold > 0){
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

        $arrayAsignaturasCoor = Subject::join('solicitudes', 'solicitudes.subject_id', '=', 'subjects.id')
                ->select('subjects.id','subjects.name', 'subjects.cTheory', 'subjects.cPractice', 'subjects.cSeminar')
                ->distinct()
                ->where('subjects.coordinator_id', '=', $usuario)
                ->where('solicitudes.state', true)
                ->where('solicitudes.course', $course)
                ->orderBy('subjects.name')
                ->get();

        $arraySolicitudesCoor = Solicitude::join('subjects','subjects.id', '=', 'solicitudes.subject_id')
            ->select('subjects.name', 'solicitudes.cTheory', 'solicitudes.cPractice', 'solicitudes.cSeminar','solicitudes.state', 'solicitudes.id')
            ->where('course', '=', $course)
            ->where('subjects.coordinator_id', '=', $usuario)
            ->where('solicitudes.state', true)
            ->orderBy('subjects.name')
            ->get();

        foreach ($arrayAsignaturasCoor as $key => $asignatura) {
            $contT = 0;
            $contP = 0;
            $contS = 0;
            foreach ($arraySolicitudesCoor as $key => $solicitud) {
                if($asignatura->name == $solicitud->name){
                    if($solicitud->cTheory == null){
                        $solicitud->cTheory = 0;
                    }

                    if($solicitud->cPractice == null){
                        $solicitud->cPractice = 0;
                    }

                    if($solicitud->cSeminar == null){
                        $solicitud->cSeminar = 0;
                    }

                    $contT += $solicitud->cTheory;
                    $contP += $solicitud->cPractice;
                    $contS += $solicitud->cSeminar;
                }
            }

            if($asignatura->cTheory == $contT && $asignatura->cPractice == $contP && $asignatura->cSeminar == $contS) {
                foreach ($arraySolicitudesCoor as $key => $s) {
                    if($asignatura->name == $s->name){
                        $sol = Solicitude::findOrFail($s->id);
                        $sol->state = false;
                        $sol->save();
                    }
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
        return redirect('/solicitudes/director/teacher/'. $course);
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
        return redirect('/solicitudes/director/teacher/'. $course);
    }
}