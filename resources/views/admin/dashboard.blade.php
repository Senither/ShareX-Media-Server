@extends('master')

@section('page-title', 'Dashboard')

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

    <!-- User Upload Token -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong>Image Upload Token</strong>
                    <span class="text-light">
                        - This token is used to verify you when you upload images to the media server.
                    </span>
                </div>
                <div class="panel-body">
                    <div class="input-group">
                        <input type="password" class="token form-control" value="{{ Auth::user()->token }}" disabled>
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-primary btn-display-token">Display Token</button>
                            <a href="{{ action('UserController@updateToken') }}" class="btn btn-danger">Regenerate Token</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ User Upload Token -->

    <div class="row">
        <!-- User Settings -->
        <div class="col-md-{{ Auth::user()->hasPermission('settings.see') ? '6' : '12' }}">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong>Account Settings</strong>
                    <span class="text-light">Your personal account settings</span>
                </div>
                <div class="panel-body">
                    <form action="{{ action('UserController@update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_form" value="user">

                        <div class="form-group">
                            <label for="">Current Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Your current password">
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="new_password" class="form-control" placeholder="Your new password">
                        </div>

                        <div class="form-group">
                            <label for="password_again">New Password Again</label>
                            <input type="password" name="new_password_again" class="form-control" placeholder="Your new password again">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary form-control" value="Save user settings">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ User Settings -->

        @if(Auth::user()->hasPermission('settings.see'))
        <!-- Site Settings -->
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Site Settings</strong>
                    <span class="text-light">The sites global settings</span>
                </div>
                <div class="panel-body">
                    <form action="{{ action('AdminController@update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_form" value="site">

                        <div class="form-group">
                            <label for="">Site Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $settings->name }}" placeholder="The site name">
                        </div>

                        <div class="form-group">
                            <label for="">Images Per Page</label>
                            <input type="number" name="per_page" min="1" class="form-control" value="{{ $settings->per_page }}" placeholder="Images to display per page">
                        </div>
                        
                        <label for="">Images Live Time (Days, Hours &amp; Minutes)</label>
                        <div class="form-group form-inline">
                            <input type="number" name="live_day" min="0" class="form-control" value="{{ $settings->live_day }}" placeholder="Live time in days">
                            <input type="number" name="live_hour" min="0" class="form-control" value="{{ $settings->live_hour }}" placeholder="Live time in hours">
                            <input type="number" name="live_minute" min="0" class="form-control" value="{{ $settings->live_minute }}" placeholder="Live time in minutes">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary form-control" value="Save site settings">
                        </div>                    
                    </form>
                </div>
            </div>
        </div>
        <!--/ Site Settings -->
        @endif
    </div>

    @if(Auth::user()->hasPermission('user.management.see'))
    <!-- User Management -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>User Management</strong>
                    
                    <span class="text-light">
                        - <a href="{{ action('UserAdminController@create') }}" class="btn btn-primary btn-sm">Create new user</a>
                    </span>
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Group</th>
                                <th>Options</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($users AS $index => $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + ($index + 1) }}</td>
                                <td>{{ $user->username }}</td>
                                <td><span class="label" style="background-color: #{{ $user->group->color }}">{{ $user->group->name }}</span></td>
                                <td>
                                    @if(Auth::user()->hasPermission('user.edit.group.'.$user->group->id))
                                        <a href="{{ action('UserAdminController@edit', [$user->username]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @else
                                        <a href="#" class="btn btn-primary btn-sm" title="You can't edit this user" disabled>Edit</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Group</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ User Management -->
    @endif
@stop