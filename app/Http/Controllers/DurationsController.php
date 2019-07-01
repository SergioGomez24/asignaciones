<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Durationsubject;
use Notification;

class DurationsController extends Controller
{
    public function getIndex() 
    {
    	$arrayDuraciones = Durationsubject::all();

    	return view('settings.duration.index', ['arrayDuraciones' => $arrayDuraciones]);
    }

    public function getDuration(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $info = Durationsubject::find($id);
            
            return response()->json($info);
        }
    }

	public function getCreate() 
    {
    	return view('settings.duration.create');
    }

    public function postCreate(Request $request) 
    {
        $a = new Durationsubject;
        $a->name = $request->input('name');
        $a->save();

        Notification::success('La duración se ha guardado exitosamente!');
        return redirect('/settings/duration');
    }

    public function getEdit($id) 
    {
		$duracion = Durationsubject::findOrFail($id); 
		    	
     	return view('settings.duration.edit', ['duracion' => $duracion]);
    }

    public function putEdit(Request $request, $id)
    {
        $a = Durationsubject::findOrFail($id);
        $a->name = $request->input('name');
        $a->save();

        Notification::success('La duración ha sido modificada exitosamente!');
        return redirect('/settings/duration');
    }

    public function deleteDuration(Request $request, $id)
    {
        $a = Durationsubject::findOrFail($id);
        $a->delete();
        
        Notification::success('La duración fue eliminada exitosamente!');
        return redirect('/settings/duration');
    }
}
