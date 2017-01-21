@extends('master')

@section('page-title', 'Delete '.$user->username)

@section('content')
    @include('partial.flash')

    @if(! $errors->isEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
                <strong>Whoops!</strong>
                <ul>
                @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Delete Account</strong>
                    <span class="text-light">You're about to delete an account, are you sure you want to continue?</span>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="text-center">You're about to delete the account <strong style="color: #{{ $user->group->color  }}">{{ $user->username }}</strong></h3>
                        <p class="text-center">Deleting the user will also remove {{ $user->images->count() }} image(s) from the server.</p>

                        <br><h4 class="text-center">Are you sure you want to continue?</h4>
                        
                        <br>
                        <form action="{{ action('UserAdminController@destory', [$user->username]) }}" method="post">
                            {{ csrf_field() }}
                            
                            <center>
                                <a class="btn btn-primary" href="{{ action('AdminController@index') }}">Nevermind, go back to the Dashboard</a>
                                <input class="btn btn-danger" type="submit" value="Yup, delete {{ $user->username }}">
                            </center>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop