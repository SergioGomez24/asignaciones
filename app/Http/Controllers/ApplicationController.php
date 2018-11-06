<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Application;
use App\Subject;
use Notification;

class ApplicationController extends Controller
{
	public function getIndex() 
    {
    	$arraySolicitudes = Application::all();

    	return view('application.index', ['arraySolicitudes' => $arraySolicitudes]);
    }

    public function getCreate() 
    {
    	$course = Course::all()->last();
    	$arrayAsignaturas = Subject::all();

		return view('application.create')->with('course',$course)
										 ->with('arrayAsignaturas',$arrayAsignaturas);
    }
}
