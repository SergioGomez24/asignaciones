<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Center;
use Notification;

class CentersController extends Controller
{
	public function getIndex() 
    {
    	$arrayCentros = Center::all();

    	return view('settings.centers.index', ['arrayCentros' => $arrayCentros]);
    }

	public function getCreate() 
    {
    	return view('settings.centers.create');
    }

    public function postCreate(Request $request) 
     {
        $c = new Center;
        $c->name = $request->input('name');
        $c->save();
        Notification::success('El centro se ha guardado exitosamente!');
        return redirect('/settings/centers');
    }

    public function getEdit($id) 
    {
		$centro = Center::findOrFail($id); 
		    	
     	return view('settings.centers.edit', ['centro' => $centro]);
    }

    public function putEdit(Request $request, $id)
    {
        $c = Center::findOrFail($id);
        $c->name = $request->input('name');
        $c->save();
        Notification::success('El centro ha sido modificado exitosamente!');
        return redirect('/settings/centers');
    }

    public function deleteCenter(Request $request, $id)
    {
        $c = Center::findOrFail($id);
        $c->delete();
        Notification::success('El centro fue eliminado exitosamente!');
        return redirect('/settings/centers');
    }

}