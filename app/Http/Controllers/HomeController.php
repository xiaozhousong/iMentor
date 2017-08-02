<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Availability;
use App\Tutor;

use Illuminate\Support\Facades\Input;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $tutors = Tutor::all();
        return view('home', ['tutors' =>$tutors]);
    }
    public function selectTutor(Request $request, $tutorId)
    {
        // dd($request->all());

        // $tutorId = Input::get('selectTutor');
        
        // $tutorId = $request->selectTutor;


        $tutor = Tutor::find($tutorId);
        
        $availabilities = $tutor->availabilities;
        
        return view('selectTutor',['tutor' => $tutor], ['availabilities' => $availabilities]);

      
    }

    
}
