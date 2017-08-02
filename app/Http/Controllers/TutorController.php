<?php

namespace App\Http\Controllers;

use App\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:tutor');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutor = \Auth::guard('tutor')->user();
        $appointments = Tutor::with(['appointments'=>function($query){
            $query->with(['user','availability']);
        }])->find($tutor->id);

        return view('tutor.appointments.list', compact('appointments'));
    }
}
