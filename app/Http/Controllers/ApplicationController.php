<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Application;
use Notification;

class ApplicationController extends Controller
{
	public function getIndex() 
    {
    	$arraySolicitudes = Request::all();

    	return view('application.index', ['arraySolicitudes' => $arraySolicitudes]);
    }

    public function getCreate() 
    {
    	$course = Course::all()->last();
		return view('application.create')->with('course',$course);
    }
}
