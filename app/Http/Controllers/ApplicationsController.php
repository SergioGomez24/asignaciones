<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Application;
use App\Subject;
use Notification;

class ApplicationsController extends Controller
{
	public function getIndex() 
    {
    	$arraySolicitudes = Application::all();

    	return view('applications.index', ['arraySolicitudes' => $arraySolicitudes]);
    }

    public function getShow($id)
    {
        $solicitud = Application::findOrFail($id);

        return view('applications.show', ['solicitud' => $solicitud]);
    }

    public function getCreate() 
    {
    	$course = Course::all()->last();
    	$arrayAsignaturas = Subject::all();

		return view('applications.create')->with('course',$course)
										 ->with('arrayAsignaturas',$arrayAsignaturas);
    }

    public function postCreate(Request $request) 
     {
        $a = new Application;
        $a->name = $request->input('name');
        $a->code = $request->input('code');
        $a->certification = $request->input('certification');
        $a->area = $request->input('area');
        $a->campus = $request->input('campus');
        $a->center = $request->input('center');
        $a->cTheory = $request->input('cTheory');
        $a->save();
        Notification::success('La solicitud se ha guardado exitosamente!');
        return redirect('/applications');
    }
}


/*
public function guardar(Request $request)
{
   foreach ($request->all() as $req){
        $cronograma = new Cronograma();
        $cronograma->codPlanA = $req['codPlanf'];
        $cronograma->codEtp = $req['etapa'];
        $cronograma->fechaIni = $req['fechaIni'];
        $cronograma->fechaFin = $req['fechaFin'];
        $cronograma->dias_habiles = $req['dias_habiles'];
        $cronograma->save();
   }

    return redirect('auditoria/listar');
}
*/