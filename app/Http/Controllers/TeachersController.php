<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Notification;

class TeachersController extends Controller
{

    public function getIndex() 
    {
    	$arrayProfesores = Teacher::all();

    	return view('teachers.index', ['arrayProfesores' => $arrayProfesores]);
    }

    public function getShow($id) 
    {
    	$profesor = Teacher::findOrFail($id);

    	return view('teachers.show', ['profesor' => $profesor]);
    }

    public function getCreate() 
    {
    	return view('teachers.create');
    }

     public function getEdit($id) 
     {
		$profesor = Teacher::findOrFail($id); 
		    	
     	return view('teachers.edit', ['profesor' => $profesor]);
     }

     public function postCreate(Request $request) 
     {
        $t = new Teacher;
        $t->name = $request->input('name');
        $t->dni = $request->input('dni');
        $t->category = $request->input('category');
        $t->area = $request->input('area');
        $t->cInitial = $request->input('cInitial');
        $t->dateCategory = $request->input('dateCategory');
        $t->dateUCA = $request->input('dateUCA');
        $t->save();
        Notification::success('El profesor se ha guardado exitosamente!');
        return redirect('/teachers');
    }

    public function putEdit(Request $request, $id)
    {
        $t = Teacher::findOrFail($id);
        $t->name = $request->input('name');
        $t->dni = $request->input('dni');
        $t->category = $request->input('category');
        $t->area = $request->input('area');
        $t->cInitial = $request->input('cInitial');
        $t->dateCategory = $request->input('dateCategory');
        $t->dateUCA = $request->input('dateUCA');
        $t->save();
        Notification::success('El profesor ha sido modificado exitosamente!');
        return redirect('/teachers/show/'.$id);
    }

    public function deleteTeacher(Request $request, $id)
    {
        $t = Teacher::findOrFail($id);
        $t->delete();
        Notification::success('El profesor fue eliminado exitosamente!');
        return redirect('/teachers');
    }

}