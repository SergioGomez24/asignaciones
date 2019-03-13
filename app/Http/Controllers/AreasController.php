<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use Notification;

class AreasController extends Controller
{
	public function getIndex() 
    {
    	$arrayAreas = Area::all();

    	return view('settings.areas.index', ['arrayAreas' => $arrayAreas]);
    }

	public function getCreate() 
    {
    	return view('settings.areas.create');
    }

    public function postCreate(Request $request) 
     {
        $a = new Area;
        $a->name = $request->input('name');
        $a->save();
        Notification::success('La area se ha guardado exitosamente!');
        return redirect('/settings/areas');
    }

    public function getEdit($id) 
    {
		$area = Area::findOrFail($id); 
		    	
     	return view('settings.areas.edit', ['area' => $area]);
    }

    public function putEdit(Request $request, $id)
    {
        $a = Area::findOrFail($id);
        $a->name = $request->input('name');
        $a->save();
        Notification::success('La area ha sido modificada exitosamente!');
        return redirect('/settings/areas');
    }

    public function deleteArea(Request $request, $id)
    {
        $a = Area::findOrFail($id);
        $a->delete();
        Notification::success('La area fue eliminada exitosamente!');
        return redirect('/settings/areas');
    }

}