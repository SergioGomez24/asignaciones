<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Teacher;
use App\Category;
use App\Area;
use App\User;
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

        $usuario = User::findOrFail($id);

        $cat_id = $profesor->category_id;
        $categoria = Category::findOrFail($cat_id);

        $a_id = $profesor->area_id;
        $area = Area::findOrFail($a_id);

    	return view('teachers.show')->with('profesor',$profesor)
                                    ->with('usuario',$usuario)
                                    ->with('categoria',$categoria)
                                    ->with('area',$area);
    }

    public function getTeacher(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $info = Teacher::find($id);

            return response()->json($info);
        }
    }

    public function getUser(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $info = User::find($id);

            return response()->json($info);
        }
    }

    public function getTeacherName(Request $request) {
        if($request->ajax()){
            $name = $request->name;

            $info = Teacher::where('name', $name)
                            ->get();

            foreach ($info as $key => $i) {
                $id = $i->id;
            }

            return response()->json(['id' => $id]);
        }
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
        $u = new User;
        $u->name = $request->input('name');
        $u->email = $request->input('email');
        $u->password = $request->input('password');
        $u->role = $request->input('role');
        $u->save();

        $t = new Teacher;
        $t->name = $request->input('name');
        $t->dni = $request->input('dni');
        $t->user_id = $u->id;
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

        $usuario = User::findOrFail($id);

        $cat_id = $profesor->category_id;
        $categoria = Category::findOrFail($cat_id);

        $a_id = $profesor->area_id;
        $area = Area::findOrFail($a_id);

        $arrayCategorias = Category::all();
        $arrayAreas = Area::all(); 
                
        return view('teachers.edit')->with('profesor',$profesor)
                                    ->with('usuario',$usuario)
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

        $u = User::findOrFail($id);
        $u->name = $request->input('name');
        $u->email = $request->input('email');
        $u->role = $request->input('role');
        $u->save();

        Notification::success('El profesor ha sido modificado exitosamente!');
        return redirect('/teachers');
    }

    public function deleteTeacher(Request $request, $id)
    {
        $t = Teacher::findOrFail($id);
        $t->delete();

        $u = User::findOrFail($id);
        $u->delete();
        
        Notification::success('El profesor fue eliminado exitosamente!');
        return redirect('/teachers');
    }

}