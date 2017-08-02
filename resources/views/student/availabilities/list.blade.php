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
    <h4 class="">Please select an appiontment slot</h4>

    <div class="table">
        <div class="mainrow">
            <div class="cell darker">Tutor Name</div>
            <div class="cell darker">Date</div>
            <div class="cell darker">Day</div>
            <div class="cell darker">Time</div>
            <div class="cell darker">Length</div>
            <div class="cell darker">Location</div>
            <div class="cell darker centertable"><a href="javascript:;" onclick="openFilter()" class="btn filter_button">Filter</a>
            </div>
        </div>
        @forelse($availabilities as $availability)
        <div class="mainrow">
            <div class="cell ligther">{{ $availability->tutor->name or '-' }}</div>
            <div class="cell ligther">{{ $availability->date }}</div>
            <div class="cell ligther">{{ $availability->day }}</div>
            <div class="cell ligther">{{ $availability->time_start }}</div>
            <div class="cell ligther">{{ $availability->length }}</div>
            <div class="cell ligther">{{ $availability->tutor->location or '-' }}</div>
            <div class="cell ligther centertable"><input type="radio" name="id" value="{{ $availability->id }}"></div>
        </div>
        @empty
        @endforelse
    </div>

    {{ $availabilities->appends($query)->links() }}

    @if(count($availabilities))
        <button class="btn btn-block mainbutton" id="select">Select</button>
    @endif

</div>

<div id="filter-box" class="overlay">
    <a href="javascript:void(0)" class="closebtn" onclick="closeFilter()">&times;</a>
    
    <div class="overlay-content">


            
                    <h1 class="menutitle">Notes</h1>
                    <p class="menup">if you are failed attendant appointment THREE times, you can’t book an appointment within one month time. </p>
                    
                    <form method="GET">
                    
                        <div class="form-group">
                            <p for="date" class="filtertitle">date from</p>
                            <input type="text" name="date_from" class="form-control" id="date-from" data-date-format="yyyy-mm-dd" placeholder="From">
                        </div>
                        
                        <div class="form-group">
                            <p for="date" class="filtertitle">date to</p>
                            <input type="text" name="date_to" class="form-control" id="date-to" placeholder="To" data-date-format="yyyy-mm-dd">
                        </div>
                        
                        <div class="form-group">
                        <p for="date" class="filtertitle">Time Length</p>
                            @foreach(\App\Availability::LENGTH as $item)
                                <p class="menup">
                                    <input type="radio" class="menup" name="length" value="{{ $item }}"> {{ $item }}
                                </p>
                            @endforeach
                        </div>
                        <input type="hidden" name="tutor_id" value="{{ array_get($query,'tutor_id',0) }}">

                        <button type="submit" class="btn btn-block filterbutton">
                                        Search
                                    </button>

                        
                       

                    </form>

                </div>
            </div>
        </div>


    </div>
</div>


@endsection

@section('scripts')
    @parent
    <script src="http://cdn.bootcss.com/bootstrap-slider/9.7.3/bootstrap-slider.min.js"></script>
    <script src="http://cdn.bootcss.com/smalot-bootstrap-datetimepicker/2.4.4/js/bootstrap-datetimepicker.min.js"></script>
    <link href="http://cdn.bootcss.com/bootstrap-slider/9.7.3/css/bootstrap-slider.min.css" rel="stylesheet" type="text/css">
    <link href="http://cdn.bootcss.com/smalot-bootstrap-datetimepicker/2.4.4/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        $("#select").click(function (e) {
            e.preventDefault();
            var selected = $('input:radio[name="id"]:checked').val();
            if (!selected) {
                swal('', 'Please chekect one appointment', 'warning');
                return false;
            }

            window.location.href = '/availabilities/' + selected
        });

        function openFilter() {
            document.getElementById("filter-box").style.width = "100%";
        }

        function closeFilter() {
            document.getElementById("filter-box").style.width = "0%";
        }

        $("#time-range").slider({});

        $('#date-from,#date-to').datetimepicker({
            format: 'yyyy-mm-dd',
            startView: 2,
            minView: 2
        });
    </script>
@endsection
