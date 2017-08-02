<?php

namespace App\Http\Controllers\Student;

use App\Tutor;

class HomeController extends BaseController
{

    public function __construct()
    {

    }

    public function index()
    {
        $tutors = with(new Tutor())->select(['id', 'name'])->get();
        return view('student.home', compact('tutors'));
    }
}