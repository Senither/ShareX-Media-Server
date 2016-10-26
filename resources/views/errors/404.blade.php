@extends('master')

@section('page-title', 'Not Found')

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="title">404 <small>Not Found</small></h1>
            <p>It looks like the page you were looking for has been misplaced... or it just doesn't exists.</p>
            <p><a href="{{ action('HomeController') }}" class="btn btn-primary">Home Page</a></p>
        </div>
    </div>
@stop