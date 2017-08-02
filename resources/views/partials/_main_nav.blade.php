<?php

$currentRouteName = Route::currentRouteName();
$type = request()->query('type', '');
?>
<style type="text/css">
@font-face {
    font-family: big_noodle_titling;
    src: url('{{ asset('big_noodle_titling.ttf') }}');
}
</style>

<div>
<div id="myNav" class="overlay">


  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>


  <div class="overlay-content">

  <h1 class="menutitle">Notes</h1>
  <p class="menup">if you are failed attendant appointment THREE times, you can’t book an appointment within one month time. </p>

    <a href="{{ route('student.home') }}"
           class=" {{ in_array($currentRouteName,['student.availabilities','student.home']) ? 'active':'' }}">
           
           Book Appointment
    </a>
    <a href="{{ route('student.appointments.index',['type'=>'upcoming']) }}" class="{{ $type == 'upcoming' ? 'active':'' }}">
        Upcoming Appointment
    </a>

    <a href="{{ route('student.appointments.index',['type'=>'past']) }}" class="{{ $type == 'past' ? 'active':'' }}">Past
            Appointment </a>
    <a href="{{ route('student.appointments.index',['type'=>'cancel']) }}" class="{{ $type == 'cancel' ? 'active':'' }}">Cancel Appointment</a>
  </div>
</div>

<span style="cursor:pointer" onclick="openNav()"> 
<img src="{{ asset('css//images/menu.png')}}" alt="logo" class="menulogo">
</span>

<!-- <div class="userdetail">
<img src="{{ asset('css//images/homelogo.png')}}" alt="logo" class="menulogo">
</div> -->
<ul class="nav navbar-nav navbar-right">
        
        
        <li><a href="{{ route('student.home') }}"><img src="{{ asset('css//images/homelogo.png')}}" alt="logo" class="menulogo"></a></li>

</ul>

<ul class="nav navbar-nav navbar-right userdetailblack">
        
        <li>Hello, {{ Auth::user()->name }}</li>
        <li>
            <a class="logoutpblack" href="#" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </li> 
        

</ul>



</div>