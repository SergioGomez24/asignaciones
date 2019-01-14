<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campus;
use Notification;

class CampusController extends Controller
{

	public function getIndex() 
    {
    	$arrayCampus = Campus::all();

    	return view('settings.campus.index', ['arrayCampus' => $arrayCampus]);
    }

    public function getShow($id) 
    {
    	$campus = Campus::findOrFail($id);

    	return view('settings.campus.show', ['campus' => $campus]);
    }

	public function getCreate() 
    {
    	return view('settings.campus.create');
    }

    public function postCreate(Request $request) 
     {
        $c = new Campus;
        $c->name = $request->input('name');
        $c->save();
        Notification::success('El campus se ha guardado exitosamente!');
        return redirect('/settings/campus');
    }

    public function getEdit($id) 
    {
		$campus = Campus::findOrFail($id); 
		    	
     	return view('settings.campus.edit', ['campus' => $campus]);
    }

    public function putEdit(Request $request, $id)
    {
        $c = Campus::findOrFail($id);
        $c->name = $request->input('name');
        $c->save();
        Notification::success('El campus ha sido modificado exitosamente!');
        return redirect('/settings/campus/show/'.$id);
    }

    public function deleteCampus(Request $request, $id)
    {
        $c = Campus::findOrFail($id);
        $c->delete();
        Notification::success('El campus fue eliminado exitosamente!');
        return redirect('/settings/campus');
    }

}