@extends('layouts.select')

@section('content')



<div class="userdetail">
Hello, {{ Auth::user()->name }}
<a class="logoutn" href="#" href="{{ route('logout') }}"
onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

</div>

<div class="row hun">
    

   
    <form role="form" id="go-from" action="{{ route('student.availabilities') }}">
    <p>Please select a tutor would like to book with</p>
    
    <div class="col-md-11">
      <select class="form-control tutorselect" name="tutor_id" id="tutor">
        <option value="0">Select a tutor</option>
        @forelse($tutors as $tutor)
            <option value="{{ $tutor->id }}">{{ $tutor->name }}</option>
        @empty
        @endforelse
      </select>

    </div>
    <div class="col-md-1">
        <span class=""><button class="btn btn-block tutorgo" id="go" type="button" tabindex="-1">GO</button></span>
    </div>
</div>

@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        $("#go").click(function () {
            var selectedVal = $("#tutor").val();
            if (selectedVal == 0 || selectedVal == undefined) {
                swal("", "Please select a tutor.", "warning");
            } else {
                $("#go-from").submit();
            }
        })
    </script>

@endsection