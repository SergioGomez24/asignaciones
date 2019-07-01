<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Typesubject;
use Notification;

class TypesSubjectsController extends Controller
{
    public function getIndex() 
    {
    	$arrayTiposAsignatura = Typesubject::all();

    	return view('settings.typesSubjects.index', ['arrayTiposAsignatura' => $arrayTiposAsignatura]);
    }

    public function getTypeSubject(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $info = Typesubject::find($id);
            
            return response()->json($info);
        }
    }

	public function getCreate() 
    {
    	return view('settings.typesSubjects.create');
    }

    public function postCreate(Request $request) 
    {
        $a = new Typesubject;
        $a->name = $request->input('name');
        $a->save();

        Notification::success('El tipo asignatura se ha guardado exitosamente!');
        return redirect('/settings/typesSubjects');
    }

    public function getEdit($id) 
    {
		$tipoAsignatura = Typesubject::findOrFail($id); 
		    	
     	return view('settings.typesSubjects.edit', ['tipoAsignatura' => $tipoAsignatura]);
    }

    public function putEdit(Request $request, $id)
    {
        $a = Typsubject::findOrFail($id);
        $a->name = $request->input('name');
        $a->save();

        Notification::success('El tipo asignatura ha sido modificado exitosamente!');
        return redirect('/settings/typesSubjects');
    }

    public function deleteTypeSubject(Request $request, $id)
    {
        $a = Typesubject::findOrFail($id);
        $a->delete();
        
        Notification::success('El tipo asignatura fue eliminado exitosamente!');
        return redirect('/settings/typesSubjects');
    }
}
