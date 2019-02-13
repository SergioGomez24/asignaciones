<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Course;
use App\Application;
use App\Subject;
use App\Campus;
use App\Certification;
use App\Area;
use App\Center;
use App\Coursesubject;
use App\Durationsubject;
use App\Typesubject;
use Notification;

class ApplicationsController extends Controller
{
	public function getIndex() 
    {
    	$arraySolicitudes = Application::all();

    	return view('applications.index', ['arraySolicitudes' => $arraySolicitudes]);
    }

    public function getShow($id)
    {
        $solicitud = Application::findOrFail($id);

        return view('applications.show', ['solicitud' => $solicitud]);
    }

    public function getCreate() 
    {
    	$courseObj = Course::all()->last();
        $course = $courseObj->course;
    	$arrayAsignaturas = Subject::all();
        $arrayCampus = Campus::all();
        $arrayTitulaciones = Certification::all();
        $arrayCursoAsignaturas = Coursesubject::all();

		return view('applications.create')->with('course',$course)
										  ->with('arrayAsignaturas',$arrayAsignaturas)
                                          ->with('arrayCampus',$arrayCampus)
                                          ->with('arrayTitulaciones',$arrayTitulaciones)
                                          ->with('arrayCursoAsignaturas',$arrayCursoAsignaturas);
    }

    public function getSubjects() {
        $cert_id = Input::get('certification_id');
        $camp_id = Input::get('campus_id');
        $imparted_id = Input::get('imparted_id');

        if ($camp_id == "" && $imparted_id == "") {
            $subjects = Subject::where('certification_id', '=', $cert_id)->get();

        } elseif ($cert_id == "" && $imparted_id == "") {
            $subjects = Subject::where('campus_id', '=', $camp_id)->get();

        } elseif ($cert_id == "" && $camp_id == "") {
            $subjects = Subject::where('imparted_id', '=', $imparted_id)->get();

        } elseif ($cert_id == "") {
            $subjects = Subject::where('campus_id', '=', $camp_id)
                                ->where('imparted_id', '=', $imparted_id)->get();

        } elseif ($camp_id == "") {
            $subjects = Subject::where('certification_id', '=', $cert_id)
                                ->where('imparted_id', '=', $imparted_id)->get();

        } elseif ($imparted_id == "") {
            $subjects = Subject::where('campus_id', '=', $camp_id)
                                ->where('certification_id', '=', $cert_id)->get();

        } else {
                $subjects = Subject::where('campus_id', '=', $camp_id)
                                    ->where('certification_id', '=', $cert_id)
                                    ->where('imparted_id', '=', $imparted_id)->get();
        }
        return response()->json($subjects);
    }

    public function getSubject() {
        $subject_id = Input::get('id');

        $subject = Subject::where('id', '=', $subject_id)->get();

        return response()->json($subject);
    }

    public function getCertification() {
        $certification_id = Input::get('id');

        $certification = Certification::where('id', '=', $certification_id)->get();

        return response()->json($certification);
    }

    public function getArea() {
        $area_id = Input::get('id');

        $area = Area::where('id', '=', $area_id)->get();

        return response()->json($area);
    }

    public function getCampus() {
        $campus_id = Input::get('id');

        $campus = Campus::where('id', '=', $campus_id)->get();

        return response()->json($campus);
    }

    public function getCenter() {
        $center_id = Input::get('id');

        $center = Center::where('id', '=', $center_id)->get();

        return response()->json($center);
    }

    public function getDuration() {
        $duration_id = Input::get('id');

        $duration = Durationsubject::where('id', '=', $duration_id)->get();

        return response()->json($duration);
    }

    public function getImparted() {
        $imparted_id = Input::get('id');

        $imparted = Coursesubject::where('id', '=', $imparted_id)->get();

        return response()->json($imparted);
    }

    public function getTypeSubject() {
        $typeSubject_id = Input::get('id');

        $typeSubject = Typesubject::where('id', '=', $typeSubject_id)->get();

        return response()->json($typeSubject);
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
        return redirect('/applications/create');
    }
}