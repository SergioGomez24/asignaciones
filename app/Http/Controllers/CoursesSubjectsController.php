<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursesubject;
use Notification;

class CoursesSubjectsController extends Controller
{
    public function getIndex() 
    {
    	$arrayCursosAsignatura = Coursesubject::all();

    	return view('settings.coursesSubjects.index', ['arrayCursosAsignatura' => $arrayCursosAsignatura]);
    }

    public function getImparted(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $info = Coursesubject::find($id);
            
            return response()->json($info);
        }
    }

	public function getCreate() 
    {
    	return view('settings.coursesSubjects.create');
    }

    public function postCreate(Request $request) 
    {
        $a = new Coursesubject;
        $a->name = $request->input('name');
        $a->save();
        
        Notification::success('El curso asignatura se ha guardado exitosamente!');
        return redirect('/settings/coursesSubjects');
    }

    public function getEdit($id) 
    {
		$cursoAsignatura = Coursesubject::findOrFail($id); 
		    	
     	return view('settings.coursesSubjects.edit', ['cursoAsignatura' => $cursoAsignatura]);
    }

    public function putEdit(Request $request, $id)
    {
        $a = Coursesubject::findOrFail($id);
        $a->name = $request->input('name');
        $a->save();

        Notification::success('El curso asignatura ha sido modificado exitosamente!');
        return redirect('/settings/coursesSubjects');
    }

    public function deleteCourseSubject(Request $request, $id)
    {
        $a = Coursesubject::findOrFail($id);
        $a->delete();

        Notification::success('El curso asignatura fue eliminado exitosamente!');
        return redirect('/settings/coursesSubjects');
    }
}
