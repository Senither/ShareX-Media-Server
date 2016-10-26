@extends('master')

@section('page-title', 'Admin login')

@section('content')
    <div class="signin-wrapper">
        <form action="{{ action('UserController@login') }}" method="post" name="signin">
            {{ csrf_field() }}

            <h3>Welcome Back! Please Sign In</h3>
            <hr class="colorgraph">

            @if(! $errors->isEmpty())
                <div class="alert alert-danger" role="alert">
                    <p>
                        {!! $errors->first() !!}
                    </p>
                </div>
            @endif

            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus />
            <input type="password" class="form-control" name="password" placeholder="Password" required/>

            <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>

            <p><a href="{{ action('HomeController') }}">Return to the website</a></p>
        </form>
    </div>
@stop