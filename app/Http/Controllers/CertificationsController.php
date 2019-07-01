<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Certification;
use Notification;

class CertificationsController extends Controller
{
	public function getIndex() 
    {
    	$arrayTitulaciones = Certification::all();

    	return view('settings.certifications.index', ['arrayTitulaciones' => $arrayTitulaciones]);
    }

    public function getCertification(Request $request) {
        if($request->ajax()) {
            $id = $request->id;
            $info = Certification::find($id);
            
            return response()->json($info);
        }
    }

	public function getCreate() 
    {
    	return view('settings.certifications.create');
    }

    public function postCreate(Request $request) 
    {
        $c = new Certification;
        $c->name = $request->input('name');
        $c->save();

        Notification::success('La titulacion se ha guardado exitosamente!');
        return redirect('/settings/certifications');
    }

    public function getEdit($id) 
    {
		$titulacion = Certification::findOrFail($id); 
		    	
     	return view('settings.certifications.edit', ['titulacion' => $titulacion]);
    }

    public function putEdit(Request $request, $id)
    {
        $c = Certification::findOrFail($id);
        $c->name = $request->input('name');
        $c->save();

        Notification::success('La titulacion ha sido modificada exitosamente!');
        return redirect('/settings/certifications');
    }

    public function deleteCertification(Request $request, $id)
    {
        $c = Certification::findOrFail($id);
        $c->delete();
        
        Notification::success('La titulacion fue eliminada exitosamente!');
        return redirect('/settings/certifications');
    }

}