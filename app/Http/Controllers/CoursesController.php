<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Notification;

class CoursesController extends Controller
{
    public function getIndex() 
    {
    	$arrayCursos = Course::all();

    	return view('settings.courses.index', ['arrayCursos' => $arrayCursos]);
    }

    public function getCourse(Request $request) {
        if($request->ajax()){
            $name = $request->name;
            $info = Course::where('name', $name)->get();
            
            return response()->json($info);
        }
    }

	public function getCreate() 
    {
    	return view('settings.courses.create');
    }

    public function postCreate(Request $request) 
     {
        $c = new Course;
        $c->name = $request->input('name');
        $c->save();
        Notification::success('El curso se ha guardado exitosamente!');
        return redirect('/settings/courses');
    }

    public function getEdit($id) 
    {
		$curso = Course::findOrFail($id); 
		    	
     	return view('settings.courses.edit', ['curso' => $curso]);
    }

    public function putEdit(Request $request, $id)
    {
        $c = Course::findOrFail($id);
        $c->name = $request->input('name');
        $c->save();
        Notification::success('El curso ha sido modificado exitosamente!');
        return redirect('/settings/courses');
    }

    public function deleteCourse(Request $request, $id)
    {
        $c = Course::findOrFail($id);
        $c->delete();
        Notification::success('El curso fue eliminado exitosamente!');
        return redirect('/settings/courses');
    }

}
