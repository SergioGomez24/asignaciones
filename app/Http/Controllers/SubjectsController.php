<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use Notification;

class SubjectsController extends Controller
{

    public function getIndex() 
    {
    	$arrayAsignaturas = Subject::all();

    	return view('subjects.index', ['arrayAsignaturas' => $arrayAsignaturas]);
    }

    public function getShow($id) 
    {
    	$asignatura = Subject::findOrFail($id);

    	return view('subjects.show', ['asignatura' => $asignatura]);
    }

    public function getCreate() 
    {
    	return view('subjects.create');
    }

     public function getEdit($id) 
     {
		$asignatura = Subject::findOrFail($id); 
		    	
     	return view('subjects.edit', ['asignatura' => $asignatura]);
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
        $a->coordinator = $request->input('coordinator');
        $a->save();
        Notification::success('La asignatura se ha guardado exitosamente!');
        return redirect('/subjects');
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
        $a->coordinator = $request->input('coordinator');
        $a->save();
        Notification::success('La asignatura ha sido modificada exitosamente!');
        return redirect('/subjects/show/'.$id);
    }

    public function deleteSubject(Request $request, $id)
    {
        $a = Subject::findOrFail($id);
        $a->delete();
        Notification::success('La asignatura fue eliminada exitosamente!');
        return redirect('/subjects');
    }

}