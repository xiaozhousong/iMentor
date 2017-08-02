

<!DOCTYPE html>
<html lang="en">

@include('partials._head')

<body class="full2">

    @include('partials._nav')
    
    <div class="container">

	

   
    

    @yield('content')
</div>

@include('partials._js')

@yield('scripts')



</body>
</html>