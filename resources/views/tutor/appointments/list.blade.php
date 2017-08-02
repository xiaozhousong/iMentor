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
    <div class="container">

        <div class="row">

            <div class="col-md-12">
            <h4 class="pagestitle">Booked appointments</h4>

                

                <div class="booked">
                    
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Length</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Reason</th>
                            <th>Level</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($appointments->appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->user->name or '-' }}</td>
                                <td>{{ $appointment->availability->date or  '-' }} {{$appointment->availability->day or ''}}</td>
                                <td>{{ $appointment->availability->time_start or '-' }}</td>
                                <td>{{ $appointment->availability->length or '-' }}</td>
                                <td>{{ $appointments->location or '-' }}</td>
                                <?php $status = array_flip(\App\Appointment::STATUS); ?>
                                <td>{{ isset($status[$appointment->status]) ? strtoupper($status[$appointment->status]) : '-'}}</td>
                                <td>{{ isset($appointment->reason) ? \App\Appointment::REASON[$appointment->reason] : '-'}}</td>
                                <td>{{ isset($appointment->level) ? \App\Appointment::Level[$appointment->level] : '-'}}</td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection

