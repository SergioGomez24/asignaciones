<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Notification;

class CategoriesController extends Controller
{
	public function getIndex() 
    {
    	$arrayCategorias = Category::all();

    	return view('settings.categories.index', ['arrayCategorias' => $arrayCategorias]);
    }

    public function getShow($id) 
    {
    	$categoria = Category::findOrFail($id);

    	return view('settings.categories.show', ['categoria' => $categoria]);
    }

	public function getCreate() 
    {
    	return view('settings.categories.create');
    }

    public function postCreate(Request $request) 
     {
        $c = new Category;
        $c->name = $request->input('name');
        $c->code = $request->input('rank');
        $c->save();
        Notification::success('La categoria se ha guardado exitosamente!');
        return redirect('/settings/categories');
    }

    public function getEdit($id) 
    {
		$asignatura = Subject::findOrFail($id); 
		    	
     	return view('subjects.edit', ['asignatura' => $asignatura]);
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

    public function deleteCategory(Request $request, $id)
    {
        $c = Category::findOrFail($id);
        $c->delete();
        Notification::success('La categoria fue eliminada exitosamente!');
        return redirect('/settings/categories');
    }

}