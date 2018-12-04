<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Application;
use App\Subject;
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

		return view('applications.create')->with('course',$course)
										 ->with('arrayAsignaturas',$arrayAsignaturas);
    }

    /*public function postCreate(Request $request)
    {
        $course = Course::all()->last();
        $arrayAsignaturas = Subject::all();

        foreach ($request->all() as $req){
            foreach ($arrayAsignaturas as $asignatura) {
                $a = new Application;
                $a->subject = $asignatura->name;
                $a->teacher = Auth()->user()->name;
                $a->course = $course->course;
                $a->credT = $req['credT'];
                $a->credP = $req['credP'];
                $a->credS = $req['credS'];
                $a->save();
            }
        }

        Notification::success('La solicitud se ha guardado exitosamente!');
        return redirect('/applications');
    }
}*/

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