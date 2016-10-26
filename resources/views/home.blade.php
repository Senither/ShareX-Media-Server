@extends('master')

@section('page-title', 'Home')

@section('content')
    <!-- Display Images -->
    @if($images->isEmpty())
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <p> <strong>There are no uploads yet!</strong>
                    <br class="hidden-md hidden-lg">
                    Give it a few minutes, then check back again, if there still isn't any images.. Read this message again.
                </p>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-12">
            @foreach($images as $image)
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                <a href="{{ action('ImageController@show', [$image->slug]) }}" class="thumbnail">
                    <img src="{{ action('ImageController@show', [$image->slug, 'thumb']) }}" alt="{{ $image->slug }}">
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 flex-center">{{ $images->links() }}</div>
    </div>
    @endif
    <!--/ Display Images -->
@stop