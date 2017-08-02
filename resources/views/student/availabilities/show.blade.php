@extends('layouts.main')


@section('content')

<div class="col-md-12">
    <div class="userdetailblack">
        Hello, {{ Auth::user()->name }}
        <a class="logoutp" href="#" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>

<div class="col-md-12">
<div class="maincontent">
<h4 class="">Please select following options to confirm the appointment</h4>

<form action="{{ route('student.appointments.book') }}" id="availability-form">

<div class="table">
    <div class="mainrow">
        <div class="cell darker">Tutor Name</div>
        <div class="cell darker">Date</div>
        <div class="cell darker">Day</div>
        <div class="cell darker">Time</div>
        <div class="cell darker">Length</div>
        <div class="cell darker">Location</div>
    </div>

    <div class="mainrow">
        <div class="cell ligther">{{ $availability->tutor->name or '-' }}</div>
        <div class="cell ligther">{{ $availability->date }}</div>
        <div class="cell ligther">{{ $availability->day }}</div>
        <div class="cell ligther">{{ $availability->time_start }}</div>
        <div class="cell ligther">{{ $availability->length }}</div>
        <div class="cell ligther">{{ $availability->tutor->location or '-' }}</div>
        
    </div>
 
</div>

    
<div class="col-md-12 reason_important form-group">
<label for="reason">Please select a reason for this appointment</label>
</div>
<div class="col-md-12">

    @foreach(\App\Appointment::REASON as $key => $value)
    <div class="col-md-8">
        <input type="radio" name="reason" value="{{ $key }}" class="try"> 
       {{ $value }}
        </div>            
    @endforeach
</div>




<div class="col-md-12 reason_important form-group">
<label for="level">Please select the level of important</label>
</div>
<div class="col-md-12">

    @foreach(\App\Appointment::Level as $key => $value)
    <div class="col-md-8">
        <input type="radio" name="level" value="{{ $key }}" class="try"> 
       {{ $value }}
        </div>            
    @endforeach
</div>

<!-- <div class="form-group">
<label for="level">Please select the level of important</label>
<div>
    @foreach(\App\Appointment::Level as $key => $value)
        <label>
            <input type="radio" name="level" value="{{ $key }}"> {{ $value }}
        </label>
    @endforeach
</div>
</div> -->

{{ csrf_field() }}

<input type="hidden" name="id" value="{{ $availability->id }}">

<button class="btn btn-block mainbutton" id="confirm">Confirm</button>

</div>


@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $("#confirm").click(function (e) {
            e.preventDefault();
            $.ajax({
                url: $("#availability-form").attr('action'),
                type: "POST",
                data: $("#availability-form").serialize(),
                dataType: 'json'
            }).done(function (data) {
                if (data.status == 1) {
                    swal({
                        title: "",
                        text: data.message,
                        timer: 2000,
                        type: "success",
                        showConfirmButton: false
                    }, function () {
                        window.location.href = '{{ route('student.appointments.index') }}'
                    });
                } else {
                    swal('', data.message, 'warning');
                }
            }).fail(function () {
                swal('', 'Server Errors', 'error');
            })
        });
    </script>
@endsection