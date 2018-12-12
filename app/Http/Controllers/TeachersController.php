<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Category;
use App\Area;
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

        $cat_id = $profesor->category_id;
        $categoria = Category::findOrFail($cat_id);

        $a_id = $profesor->area_id;
        $area = Area::findOrFail($a_id);

    	return view('teachers.show')->with('profesor',$profesor)
                                    ->with('categoria',$categoria)
                                    ->with('area',$area);
    }

    public function getCreate() 
    {
        $arrayCategorias = Category::all();
        $arrayAreas = Area::all();

    	return view('teachers.create')->with('arrayCategorias',$arrayCategorias)
                                      ->with('arrayAreas',$arrayAreas);
    }

    public function postCreate(Request $request) 
    {
        $t = new Teacher;
        $t->name = $request->input('name');
        $t->dni = $request->input('dni');
        $t->category_id = $request->input('category_id');
        $t->area_id = $request->input('area_id');
        $t->cInitial = $request->input('cInitial');
        $t->dateCategory = $request->input('dateCategory');
        $t->dateUCA = $request->input('dateUCA');
        $t->save();
        Notification::success('El profesor se ha guardado exitosamente!');
        return redirect('/teachers');
    }

    public function getEdit($id) 
    {
        $profesor = Teacher::findOrFail($id);

        $cat_id = $profesor->category_id;
        $categoria = Category::findOrFail($cat_id);

        $a_id = $profesor->area_id;
        $area = Area::findOrFail($a_id);

        $arrayCategorias = Category::all();
        $arrayAreas = Area::all(); 
                
        return view('teachers.edit')->with('profesor',$profesor)
                                    ->with('categoria',$categoria)
                                    ->with('area',$area)
                                    ->with('arrayCategorias',$arrayCategorias)
                                    ->with('arrayAreas',$arrayAreas);
    }

    public function putEdit(Request $request, $id)
    {
        $t = Teacher::findOrFail($id);
        $t->name = $request->input('name');
        $t->dni = $request->input('dni');
        $t->category_id = $request->input('category_id');
        $t->area_id = $request->input('area_id');
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