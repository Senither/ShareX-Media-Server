@extends('master')

@section('page-title', 'Unauthorized')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="title">401 <small>Unauthorized</small></h1>
            <p>You do not have permission to view this page.</p>
            <p><a href="{{ action('AdminController@index') }}" class="btn btn-primary">Control Panel</a></p>
        </div>
    </div>
@stop