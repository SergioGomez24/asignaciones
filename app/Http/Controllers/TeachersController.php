<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Notification;

class SubjectsController extends Controller
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
        $a = new Subject;
        $a->name = $request->input('name');
        $a->code = $request->input('code');
        $a->certification = $request->input('certification');
        $a->area = $request->input('area');
        $a->campus = $request->input('campus');
        $a->center = $request->input('center');
        $a->cTheory = $request->input('cTheory');
        $a->cSeminar = $request->input('cSeminar');
        $a->cPractice = $request->input('cPractice');
        $a->duration = $request->input('duration');
        $a->imparted = $request->input('imparted');
        $a->typeSubject = $request->input('typeSubject');
        $a->save();
        Notification::success('El profesor se ha guardado exitosamente!');
        return redirect('/teachers');
    }

    public function putEdit(Request $request, $id)
    {
        $a = Subject::findOrFail($id);
        $a->name = $request->input('name');
        $a->code = $request->input('code');
        $a->certification = $request->input('certification');
        $a->area = $request->input('area');
        $a->campus = $request->input('campus');
        $a->center = $request->input('center');
        $a->cTheory = $request->input('cTheory');
        $a->cSeminar = $request->input('cSeminar');
        $a->cPractice = $request->input('cPractice');
        $a->duration = $request->input('duration');
        $a->imparted = $request->input('imparted');
        $a->typeSubject = $request->input('typeSubject');
        $a->save();
        Notification::success('La asignatura ha sido modificado exitosamente!');
        return redirect('/subjects/show/'.$id);
    }

    public function deleteTeacher(Request $request, $id)
    {
        $t = Teacher::findOrFail($id);
        $t->delete();
        Notification::success('El profesor fue eliminado exitosamente!');
        return redirect('/teachers');
    }

}