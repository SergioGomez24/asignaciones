<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Course;
use App\Application;
use App\Subject;
use App\Campus;
use App\Certification;
use App\Teacher;
use App\Coursesubject;
use App\Priority;
use Notification;

class ApplicationsController extends Controller
{
	public function getIndex() 
    {
    	$arrayCursos = Course::all();

    	return view('applications.index', ['arrayCursos' => $arrayCursos]);
    }

    public function getCoordinatorIndex() 
    {
        $arrayCursos = Course::all();

        return view('applications.coordinator.index', ['arrayCursos' => $arrayCursos]);
    }

    public function getCourseIndex($course, Request $request)
    {
        $usuario = Auth()->user()->name;
        $arrayAsignaturas = Subject::all();
        $arrayProfesores = Teacher::all();
        $subj_id = $request->get('subject_id');
        $teacher = $request->get('teacher');

        $arraySolicitudes = Application::join('subjects','subjects.id', '=', 'applications.subject_id')
            ->select('subjects.name', 'applications.teacher', 'applications.cTheory', 'applications.cPractice', 'applications.cSeminar', 'applications.id')
            ->where('course', '=', $course)
            ->subjectid($subj_id)
            ->teacher($teacher)
            ->paginate();

        $arraySolicitudesProf = Application::join('subjects','subjects.id', '=', 'applications.subject_id')
            ->select('subjects.name', 'applications.teacher', 'applications.cTheory', 'applications.cPractice', 'applications.cSeminar', 'applications.id')
            ->where('course', '=', $course)
            ->where('applications.teacher', '=', $usuario)
            ->subjectid($subj_id)
            ->teacher($teacher)
            ->paginate();

        return view('applications.course')->with('arraySolicitudes', $arraySolicitudes)
                                          ->with('arraySolicitudesProf', $arraySolicitudesProf)
                                          ->with('arrayAsignaturas', $arrayAsignaturas)
                                          ->with('arrayProfesores', $arrayProfesores)
                                          ->with('subj_id', $subj_id)
                                          ->with('teacher', $teacher)
                                          ->with('course', $course);

    }

    public function getCoordinatorCourse($course, Request $request)
    {
        $usuario = Auth()->user()->name;
        $arrayAsignaturas = Subject::all();
        $arrayProfesores = Teacher::all();
        $subj_id = $request->get('subject_id');
        $teacher = $request->get('teacher');

        $arraySolicitudesCoor = Application::join('subjects','subjects.id', '=', 'applications.subject_id')
            ->select('subjects.name', 'applications.teacher', 'applications.cTheory', 'applications.cPractice', 'applications.cSeminar', 'applications.id')
            ->where('course', '=', $course)
            ->where('subjects.coordinator', '=', $usuario)
            ->where('applications.teacher', '!=', $usuario)
            ->subjectid($subj_id)
            ->teacher($teacher)
            ->paginate();

        return view('applications.coordinator.course')->with('arraySolicitudesCoor', $arraySolicitudesCoor)
                                                      ->with('arrayAsignaturas', $arrayAsignaturas)
                                                      ->with('arrayProfesores', $arrayProfesores)
                                                      ->with('subj_id', $subj_id)
                                                      ->with('teacher', $teacher)
                                                      ->with('course', $course);

    }

    public function getApplication() {
        $subject_id = Input::get('subject_id');
        $teacher = Input::get('teacher');
        $course = Input::get('course');

        $application = Application::where('subject_id', '=', $subject_id)
                                    ->where('teacher', '=', $teacher)
                                    ->where('course', '=', $course)->get();

        return response()->json($application);
    }

    public function getCreate() 
    {
        $courseObj = Course::all()->last();
        $course = $courseObj->course;
        $teacher = Auth()->user()->name;
        $arrayAsignaturas = Subject::all();
        $arrayCampus = Campus::all();
        $arrayTitulaciones = Certification::all();
        $arrayCursoAsignaturas = Coursesubject::all();
        $prioridadProfesor = Priority::where('teacher', '=', $teacher)
                                     ->where('course', '=', $course)
                                     ->get();

        foreach ($prioridadProfesor as $prioridad) {
            $cAvailable = $prioridad->cAvailable;
        }

        return view('applications.create')->with('course',$course)
                                          ->with('arrayAsignaturas',$arrayAsignaturas)
                                          ->with('arrayCampus',$arrayCampus)
                                          ->with('arrayTitulaciones',$arrayTitulaciones)
                                          ->with('cAvailable', $cAvailable)
                                          ->with('arrayCursoAsignaturas',$arrayCursoAsignaturas);
    }

    public function postCreate(Request $request) 
    {
        $course = Course::all()->last();

        $a = new Application;
        $a->subject_id = $request->input('subject');
        $a->teacher = Auth()->user()->name;
        $a->course = $course->course;
        $a->cTheory = $request->input('cTheory');
        $a->cPractice = $request->input('cPractice');
        $a->cSeminar = $request->input('cSeminar');
        $a->save();
        Notification::success('La solicitud se ha guardado exitosamente!');

        $prioridad = Priority::where('teacher', $a->teacher)
                             ->where('course', $a->course)
                             ->get();

        foreach ($prioridad as $p) {
            $p->cAvailable = $p->cAvailable - $a->cTheory - $a->cPractice - $a->cSeminar;
            $p->save();
        }


        return redirect('/applications/create');
    }

    public function getEdit($id) 
    {
        $application = Application::findOrFail($id);
        $course = $application->course;
                
        return view('applications.edit')->with('application', $application)
                                        ->with('course', $course);
    }

    public function getCoordinatorEdit($id) 
    {
        $application = Application::findOrFail($id);
        $course = $application->course;
                
        return view('applications.coordinator.edit')->with('application', $application)
                                                    ->with('course', $course);
    }

    public function putEdit(Request $request, $id)
    {
        $a = Application::findOrFail($id);
        $c = $a->course;
        $a->cTheory = $request->input('cTheory');
        $a->cSeminar = $request->input('cSeminar');
        $a->cPractice = $request->input('cPractice');
        $a->save();
        Notification::success('La solicitud ha sido modificada exitosamente!');
        return redirect('/applications/course/'. $c);
    }

    public function putCoordinatorEdit(Request $request, $id)
    {
        $a = Application::findOrFail($id);
        $c = $a->course;
        $a->cTheory = $request->input('cTheory');
        $a->cSeminar = $request->input('cSeminar');
        $a->cPractice = $request->input('cPractice');
        $a->save();
        Notification::success('La solicitud ha sido modificada exitosamente!');
        return redirect('/applications/coordinator/course/'. $c);
    }

    public function deleteApplication(Request $request, $id)
    {
        $a = Application::findOrFail($id);
        $c = $a->course;
        $a->delete();
        Notification::success('La solicitud fue eliminada exitosamente!');
        return redirect('/applications/course/'. $c);
    }
}