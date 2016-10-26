<!-- Desktop Header -->
<div class="row hidden-sm hidden-xs bottom-space">
    <div class="col-md-9">
        <h1 class="title">
            {{ $settings->name }}
            <small>@yield('page-title')</small>
        </h1>
    </div>

    <div class="col-md-3">
        <p class="text-right cp">
            @if(Auth::check())
                <div class="btn-group" style="float: right;">
                    <a href="{{ action('AdminController@index') }}" class="btn btn-primary">Dashboard</a>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ action('HomeController') }}">View Site</a></li>
                        <li><a href="{{ action('ImageAdminController@index') }}">
                            @if(Auth::user()->hasPermission('user.image.see'))
                                Manage Images
                            @else
                                Manage My Images
                            @endif
                        </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ action('UserController@destory') }}">Logout</a></li>
                    </ul>
                </div>
            @else
                <a class="btn btn-primary" href="{{ action('AdminController@index') }}">Control Panel</a>
            @endif
        </p>
    </div>
</div>
<!--/ Desktop Header -->

<!-- Mobile Header -->
<div class="row hidden-md hidden-lg flex-center bottom-space">
    <div class="col-md-12">
        <h1 class="title">{{ $settings->name }}</h1>
        <p class="flex-center">
            @if(Auth::check())
                <a class="btn btn-primary text-right" href="{{ action('AdminController@index') }}">Dashboard</a>&nbsp;
                <a class="btn btn-primary text-right" href="{{ action('HomeController') }}">View Site</a>&nbsp;
                <a class="btn btn-primary text-right" href="{{ action('ImageAdminController@index') }}">
                    @if(Auth::user()->hasPermission('user.image.see'))
                        Manage Images
                    @else
                        Manage My Images
                    @endif
                </a>&nbsp;
                <a class="btn btn-primary text-right" href="{{ action('UserController@destory') }}">Logout</a>
            @else
                <a class="btn btn-primary text-right" href="{{ action('AdminController@index') }}">Control Panel</a>
            @endif
        </p>
    </div>
</div>
<!--/ Mobile Header -->