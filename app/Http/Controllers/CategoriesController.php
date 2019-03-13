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

	public function getCreate() 
    {
    	return view('settings.categories.create');
    }

    public function postCreate(Request $request) 
     {
        $c = new Category;
        $c->name = $request->input('name');
        $c->rank = $request->input('rank');
        $c->save();
        Notification::success('La categoria se ha guardado exitosamente!');
        return redirect('/settings/categories');
    }

    public function getEdit($id) 
    {
		$categoria = Category::findOrFail($id); 
		    	
     	return view('settings.categories.edit', ['categoria' => $categoria]);
    }

    public function putEdit(Request $request, $id)
    {
        $c = Category::findOrFail($id);
        $c->name = $request->input('name');
        $c->rank = $request->input('rank');
        $c->save();
        Notification::success('La categoria ha sido modificada exitosamente!');
        return redirect('/settings/categories');
    }

    public function deleteCategory(Request $request, $id)
    {
        $c = Category::findOrFail($id);
        $c->delete();
        Notification::success('La categoria fue eliminada exitosamente!');
        return redirect('/settings/categories');
    }

}