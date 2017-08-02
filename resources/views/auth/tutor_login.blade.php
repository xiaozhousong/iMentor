@extends('layouts.login')

@section('content')
<div class="container container-table">
            <div class="row vertical-center-row">
                <div class="text-center homeelementlogo">
                    <img src="{{ asset('css//images/logo.png')}}" alt="logo" class="logo">
                </div>
                <div class="homeelement text-center">
                
                    
                    <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
                    

                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <h3 class="loginp">Tutor Login</h3>
                        </div>
                        <div class="col-md-2"></div>
                        
                    </div>
                </div>
                
                <div class="homeelement">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('tutor.login.submit') }}">
                            {{ csrf_field() }}
                    
                    <div class="row {{ $errors->has('email') ? ' has-error' : '' }}">
                    

                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <input placeholder="User Name" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-2"></div>
                        
                    </div>
                </div>
                

                
                <div class="homeelement">
                    <div class="row">
                    
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif

                        </div>
                        <div class="col-md-2"></div>
                        
                    </div>
                </div>

               
 
                   
            
                <div class="homeelement checkbox">
                    <div class="row">
                    
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                                <p class="loginp">Remember Me </p>
                                <a class="loginp" href="{{ route('password.request') }}">
                                Forgot Your Password?
                                </a>
                                
                            </label>

                        </div>
                        <div class="col-md-2"></div>
                        
                    </div>
                </div>

                

                <div class="homeelement">
                    <div class="row">
                    
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-block loginbtn">
                                Login
                            </button>

                        </div>
                        <div class="col-md-2"></div>
                        
                    </div>
                </div>


              

                    



                </form>

            </div>
        </div>
@endsection
