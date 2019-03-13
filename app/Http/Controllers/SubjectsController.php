<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Certification;
use App\Area;
use App\Campus;
use App\Center;
use App\Coursesubject;
use App\Durationsubject;
use App\Typesubject;
use App\Teacher;
use Notification;

class SubjectsController extends Controller
{
    public function getIndex() 
    {
    	$arrayAsignaturas = Subject::all();

    	return view('subjects.index', ['arrayAsignaturas' => $arrayAsignaturas]);
    }

    public function getShow($id) 
    {
    	$asignatura = Subject::findOrFail($id);

        $cer_id = $asignatura->certification_id;
        $certification = Certification::findOrFail($cer_id);

        $a_id = $asignatura->area_id;
        $area = Area::findOrFail($a_id);

        $ca_id = $asignatura->campus_id;
        $campus = Campus::findOrFail($ca_id);

        $cen_id = $asignatura->center_id;
        $center = Center::findOrFail($cen_id);

        $dur_id = $asignatura->duration_id;
        $duration = Durationsubject::findOrFail($dur_id);

        $imp_id = $asignatura->imparted_id;
        $imparted = Coursesubject::findOrFail($imp_id);

        $type_id = $asignatura->typeSubject_id;
        $typeSubject = Typesubject::findOrFail($type_id);

    	return view('subjects.show')->with('asignatura',$asignatura)
                                    ->with('certification',$certification)
                                    ->with('area',$area)
                                    ->with('campus',$campus)
                                    ->with('center',$center)
                                    ->with('duration',$duration)
                                    ->with('imparted',$imparted)
                                    ->with('typeSubject',$typeSubject);
    }

    public function getCreate() 
    {
        $arrayTitulaciones = Certification::all();
        $arrayAreas = Area::all();
        $arrayCampus = Campus::all();
        $arrayCentros = Center::all();
        $arrayCursoAsignaturas = Coursesubject::all();
        $arrayDuracionAsignaturas = Durationsubject::all();
        $arrayTipoAsignaturas = Typesubject::all();
        $arrayProfesores = Teacher::all();

    	return view('subjects.create')->with('arrayTitulaciones',$arrayTitulaciones)
                                      ->with('arrayAreas',$arrayAreas)
                                      ->with('arrayCampus',$arrayCampus)
                                      ->with('arrayCentros',$arrayCentros)
                                      ->with('arrayCursoAsignaturas',$arrayCursoAsignaturas)
                                      ->with('arrayDuracionAsignaturas',$arrayDuracionAsignaturas)
                                      ->with('arrayProfesores', $arrayProfesores)
                                      ->with('arrayTipoAsignaturas',$arrayTipoAsignaturas);
    }

    public function postCreate(Request $request) 
    {
        $a = new Subject;
        $a->name = $request->input('name');
        $a->code = $request->input('code');
        $a->certification_id = $request->input('certification_id');
        $a->area_id = $request->input('area_id');
        $a->campus_id = $request->input('campus_id');
        $a->center_id = $request->input('center_id');
        $a->cTheory = $request->input('cTheory');
        $a->cSeminar = $request->input('cSeminar');
        $a->cPractice = $request->input('cPractice');
        $a->duration_id = $request->input('duration_id');
        $a->imparted_id = $request->input('imparted_id');
        $a->typeSubject_id = $request->input('typeSubject_id');
        $a->coordinator = $request->input('coordinator');
        $a->save();
        Notification::success('La asignatura se ha guardado exitosamente!');
        return redirect('/subjects');
    }

    public function getEdit($id) 
    {
		$asignatura = Subject::findOrFail($id);

        $cer_id = $asignatura->certification_id;
        $certification = Certification::findOrFail($cer_id);

        $a_id = $asignatura->area_id;
        $area = Area::findOrFail($a_id);

        $ca_id = $asignatura->campus_id;
        $campus = Campus::findOrFail($ca_id);

        $cen_id = $asignatura->center_id;
        $center = Center::findOrFail($cen_id);

        $dur_id = $asignatura->duration_id;
        $duration = Durationsubject::findOrFail($dur_id);

        $imp_id = $asignatura->imparted_id;
        $imparted = Coursesubject::findOrFail($imp_id);

        $type_id = $asignatura->typeSubject_id;
        $typeSubject = Typesubject::findOrFail($type_id);
 
        $arrayTitulaciones = Certification::all();
        $arrayAreas = Area::all();
        $arrayCampus = Campus::all();
        $arrayCentros = Center::all();
        $arrayDuracionAsignaturas = Durationsubject::all();
        $arrayCursoAsignaturas = Coursesubject::all();
        $arrayTipoAsignaturas = Typesubject::all();
        $arrayProfesores = Teacher::all();
        
		    	
     	return view('subjects.edit')->with('asignatura',$asignatura)
                                    ->with('arrayTitulaciones',$arrayTitulaciones)
                                    ->with('arrayAreas',$arrayAreas)
                                    ->with('arrayCampus',$arrayCampus)
                                    ->with('arrayCentros',$arrayCentros)
                                    ->with('arrayDuracionAsignaturas',$arrayDuracionAsignaturas)
                                    ->with('arrayCursoAsignaturas',$arrayCursoAsignaturas)
                                    ->with('arrayTipoAsignaturas',$arrayTipoAsignaturas)
                                    ->with('certification',$certification)
                                    ->with('area',$area)
                                    ->with('campus',$campus)
                                    ->with('center',$center)
                                    ->with('duration',$duration)
                                    ->with('imparted',$imparted)
                                    ->with('typeSubject',$typeSubject)
                                    ->with('arrayProfesores',$arrayProfesores);
    }

    public function putEdit(Request $request, $id)
    {
        $a = Subject::findOrFail($id);
        $a->name = $request->input('name');
        $a->code = $request->input('code');
        $a->certification_id = $request->input('certification_id');
        $a->area_id = $request->input('area_id');
        $a->campus_id = $request->input('campus_id');
        $a->center_id = $request->input('center_id');
        $a->cTheory = $request->input('cTheory');
        $a->cSeminar = $request->input('cSeminar');
        $a->cPractice = $request->input('cPractice');
        $a->duration_id = $request->input('duration_id');
        $a->imparted_id = $request->input('imparted_id');
        $a->typeSubject_id = $request->input('typeSubject_id');
        $a->coordinator = $request->input('coordinator');
        $a->save();
        Notification::success('La asignatura ha sido modificada exitosamente!');
        return redirect('/subjects');
    }

    public function deleteSubject(Request $request, $id)
    {
        $a = Subject::findOrFail($id);
        $a->delete();
        Notification::success('La asignatura fue eliminada exitosamente!');
        return redirect('/subjects');
    }

}