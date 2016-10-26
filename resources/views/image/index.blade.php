@extends('master')

@section('page-title', 'Images')

@section('content')
    @include('partial.flash')

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

    @elseif(Auth::user()->hasPermission('user.image.see'))
        @foreach($images->groupBy('owner.username') as $username => $userImages)
        <div class="row">
            <div class="col-md-12">
                <h3>{{ ucfirst($username) }}</h3>
                @foreach($userImages as $image)
                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                    <div class="thumbnail">
                        <a href="{{ action('ImageController@show', [$image->slug]) }}">
                            <img src="{{ action('ImageController@show', [$image->slug, 'thumb']) }}" alt="{{ $image->slug }}">
                        </a>
                        <div class="caption">
                            @if(($image->owner->id == Auth::user()->id && Auth::user()->hasPermission('user.image.delete')) || Auth::user()->hasPermission('user.image.delete.others'))
                            <p class="text-center">
                                <a href="{{ action('ImageAdminController@destory', [$image->id]) }}" class="btn btn-danger">Delete Image</a>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @else
    
    <div class="row">
        <div class="col-md-12">
            @foreach($images as $image)
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <div class="thumbnail">
                    <a href="{{ action('ImageController@show', [$image->slug]) }}">
                        <img src="{{ action('ImageController@show', [$image->slug, 'thumb']) }}" alt="{{ $image->slug }}">
                    </a>
                    <div class="caption">
                        @if(Auth::user()->hasPermission('user.image.delete'))
                        <p class="text-center">
                            <a href="{{ action('ImageAdminController@destory', [$image->id]) }}" class="btn btn-danger">Delete Image</a>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <!--/ Display Images -->
@stop