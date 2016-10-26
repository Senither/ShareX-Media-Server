@extends('master')

@section('page-title', 'Create New User')

@section('content')
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
                <div class="panel-heading"> <strong>Account Settings</strong>
                    <span class="text-light">Your personal account settings</span>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <form action="{{ action('UserAdminController@store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="The users username">
                            </div>

                            <div class="form-group">
                                <label for="group">Group</label>
                                <select name="group" class="form-control">
                                    <option selected disabled>-- Select Group --</option>
                                    @foreach(App\Group::all() AS $group)
                                        @if(Auth::user()->hasPermission('user.create.group.'.$group->id))
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary form-control" value="Create new User">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop