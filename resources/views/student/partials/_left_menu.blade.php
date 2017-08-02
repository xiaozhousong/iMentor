<?php

$currentRouteName = Route::currentRouteName();
$type = request()->query('type', '');
?>
<style>
    .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover {
        z-index: -1;
    }
</style>
<div class="col-md-3">
    <p class="lead">Student Dashboard</p>
    <div class="list-group">
        <a href="{{ route('student.home') }}"
           class="list-group-item {{ in_array($currentRouteName,['student.availabilities','student.home']) ? 'active':'' }}">Book Appointment</a>
        <a href="{{ route('student.appointments.index',['type'=>'upcoming']) }}" class="list-group-item {{ $type == 'upcoming' ? 'active':'' }}">Upcoming
            Appointment</a>
        <a href="{{ route('student.appointments.index',['type'=>'past']) }}" class="list-group-item {{ $type == 'past' ? 'active':'' }}">Past
            Appointment </a>
        <a href="{{ route('student.appointments.index',['type'=>'cancel']) }}" class="list-group-item {{ $type == 'cancel' ? 'active':'' }}">Cancel Appointment</a>
        <a href="#" class="list-group-item">Guide</a>
    </div>
</div>