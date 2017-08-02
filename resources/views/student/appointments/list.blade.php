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

        @if($type == 'upcoming')
                    
    <div class="successful">
    <h4 class="pagestitle">Upcoming Appointment</h4>
    <h6 class="pagestitlesub">Success Appointments</h6>
        
        <!-- <div><h3>Success Appointments</h3></div> -->
        
            <div class="table">
                <div class="mainrow">
                <div class="cell darker">Tutor Name</div>
                <div class="cell darker">Date</div>
                <div class="cell darker">Day</div>
                <div class="cell darker">Time</div>
                <div class="cell darker">Length</div>
                <div class="cell darker">Location</div>
                
            </div>
            @forelse($successful as $appointment)
            <div class="mainrow">
                <div class="cell ligther">{{ $appointment->tutor->name or '-' }}</div>
                <div class="cell ligther">{{ $appointment->date }}</div>
                <div class="cell ligther">{{ $appointment->day }}</div>
                <div class="cell ligther">{{ $appointment->time_start }}</div>
                <div class="cell ligther">{{ $appointment->length }}</div>
                <div class="cell ligther">{{ $appointment->tutor->location or '-' }}</div>
                
            </div>
            @empty
            @endforelse
        </div>
          
    </div>

    <div class="successful">
        
        <h6 class="pagestitlesub">Pending Appointments</h6>
        
            <div class="table">
                <div class="mainrow">
                <div class="cell darker">Tutor Name</div>
                <div class="cell darker">Date</div>
                <div class="cell darker">Day</div>
                <div class="cell darker">Time</div>
                <div class="cell darker">Length</div>
                <div class="cell darker">Location</div>
                
            </div>
            @forelse($pending as $appointment)
            <div class="mainrow">
                <div class="cell ligther">{{ $pending->tutor->name or '-' }}</div>
                <div class="cell ligther">{{ $pending->date }}</div>
                <div class="cell ligther">{{ $pending->day }}</div>
                <div class="cell ligther">{{ $pending->time_start }}</div>
                <div class="cell ligther">{{ $pending->length }}</div>
                <div class="cell ligther">{{ $pending->tutor->location or '-' }}</div>
                
            </div>
            @empty
            @endforelse
        </div>
          
    </div>

@endif

@if($type == 'past')
                    
    <div class="past">
        <h4 class="pagestitle">Past Appointments</h4>
      
            <div class="table">
                <div class="mainrow">
                <div class="cell darker">Tutor Name</div>
                <div class="cell darker">Date</div>
                <div class="cell darker">Day</div>
                <div class="cell darker">Time</div>
                <div class="cell darker">Length</div>
                <div class="cell darker">Location</div>
                
            </div>
            @forelse($past as $appointment)
            <div class="mainrow">
                <div class="cell ligther">{{ $appointment->tutor->name or '-' }}</div>
                <div class="cell ligther">{{ $appointment->date }}</div>
                <div class="cell ligther">{{ $appointment->day }}</div>
                <div class="cell ligther">{{ $appointment->time_start }}</div>
                <div class="cell ligther">{{ $appointment->length }}</div>
                <div class="cell ligther">{{ $appointment->tutor->location or '-' }}</div>
                
            </div>
            @empty
            @endforelse
        </div>
          
    </div>

@endif
    
    @if($type == 'cancel')

    <h4 class="pagestitle">Cancel Appointment</h4>
    <form action="{{ route('student.appointments.cancel') }}" id="cancel-form">
    {{ csrf_field() }}
   

    <div class="table">
        <div class="mainrow">
            <div class="cell darker">Tutor Name</div>
            <div class="cell darker">Date</div>
            <div class="cell darker">Day</div>
            <div class="cell darker">Time</div>
            <div class="cell darker">Length</div>
            <div class="cell darker">Location</div>
            <div class="cell darker centertable">
            </div>
        </div>
        @forelse($cancel as $appointment)
        <div class="mainrow">
            <div class="cell ligther">{{ $appointment->tutor->name or '-' }}</div>
            <div class="cell ligther">{{ $appointment->date }}</div>
            <div class="cell ligther">{{ $appointment->day }}</div>
            <div class="cell ligther">{{ $appointment->time_start }}</div>
            <div class="cell ligther">{{ $appointment->length }}</div>
            <div class="cell ligther">{{ $appointment->tutor->location or '-' }}</div>
            <div class="cell ligther centertable"><input type="radio" name="id" value="{{ $appointment->id }}"></div>

        </div>
        @empty
        @endforelse
    </div>

    

    @if(count($cancel))
        <button class="btn btn-block mainbutton" id="cancel">cancel</button>
    @endif
    </form>
    @endif

</div>


    
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        $("#cancel").click(function (e) {
            e.preventDefault();
            var selected = $('input:radio[name="id"]:checked').val();
            if (!selected) {
                swal('', 'Please chekect one appointment', 'warning');
                return false;
            }

            $.ajax({
                url: $("#cancel-form").attr('action'),
                type: "POST",
                data: $("#cancel-form").serialize(),
                dataType: 'json'
            }).done(function (data) {
                if (data.status == 1) {
                    swal({
                        title: "",
                        text: data.message,
                        timer: 2000,
                        type: "success",
                        showConfirmButton: false
                    },function () {
                        window.location.reload()
                    });
                }
            }).fail(function () {
                swal('', 'Server Errors', 'error');
            })
        })
    </script>
@endsection

