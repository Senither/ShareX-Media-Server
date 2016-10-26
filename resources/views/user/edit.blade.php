@extends('master')

@section('page-title', 'Edit '.$user->username)

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
        <!-- User Settings -->
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Edit Account</strong>
                    <span class="text-light">Your personal account settings</span>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        @if(Auth::user()->canEditUsers())
                        <form action="{{ action('UserAdminController@update', [$user->username]) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_userid" value="{{ $user->id }}">
                            <input type="hidden" name="_usercd" value="{{ $user->created_at }}">
                            
                            @if(Auth::user()->hasPermission('user.edit.username'))
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" value="{{ $user->username }}" class="form-control" placeholder="The users username" required>
                            </div>
                            @endif

                            @if(Auth::user()->hasPermission('user.edit.group'))
                            <div class="form-group">
                                <label for="group">Group</label>
                                <select name="group" class="form-control" required>
                                    @foreach(App\Group::all() AS $group)
                                        @if(Auth::user()->hasPermission('user.create.group.'.$group->id))
                                            <option value="{{ $group->id }}"{{ $user->group->id == $group->id ? ' selected' : null }}>{{ $group->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            @if(Auth::user()->hasPermission('user.edit.password'))
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="The users new password">
                            </div>

                            <div class="form-group">
                                <label for="">Password Again</label>
                                <input type="password" name="password_again" class="form-control" placeholder="The users new password again">
                            </div>
                            @endif

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary form-control" value="Save User">
                            </div>

                            <a href="{{ action('AdminController@index') }}" class="btn btn-info form-control">Return to the Control Panel</a>
                        </form>
                        @else
                        <p class="text-center">You do not have permission to edit any values for this user.</p>
                        <a href="{{ action('AdminController@index') }}" class="btn btn-info form-control">Return to the Control Panel</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop