<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Course;
use App\Application;
use App\Subject;
use App\Campus;
use App\Certification;
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
    	$course = Course::all()->last();
    	$arrayAsignaturas = Subject::all();
        $arrayCampus = Campus::all();
        $arrayTitulaciones = Certification::all();

		return view('applications.create')->with('course',$course)
										  ->with('arrayAsignaturas',$arrayAsignaturas)
                                          ->with('arrayCampus',$arrayCampus)
                                          ->with('arrayTitulaciones',$arrayTitulaciones);
    }

    public function getSubjects() {
        $camp_id = Input::get('campus_id');
        $imparted_name = Input::get('imparted');
        console.log($camp_id);
        if($imparted_name == ""){
            $subjects = Subject::where('campus_id', '=', $camp_id)->get();
        } else {
            if($camp_id == "") {
                $subjects = Subject::where('imparted', '=', $imparted_name)->get();
            } else {
                $subjects = Subject::where('campus_id', '=', $camp_id)
                            ->where('imparted', '=', $imparted_name)->get();
            }
        }
        return response()->json($subjects);
    }

    public function postCreate(Request $request) 
     {
        $course = Course::all()->last();

        $a = new Application;
        $a->subject = $request->input('subject');
        $a->teacher = Auth()->user()->name;
        $a->course = $course->course;
        $a->credT = $request->input('credT');
        $a->credP = $request->input('credP');
        $a->credS = $request->input('credS');
        $a->save();
        Notification::success('La solicitud se ha guardado exitosamente!');
        return redirect('/applications/create');
    }
}