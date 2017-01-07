@extends('app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>欢迎来到laravel forum社区!
                <a class="btn btn-primary btn-lg pull-right" href="#" role="button">发布帖子</a>
            </h1>
        </div>
    </div>

    <div class="container">
        <div id="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img src="{{ $discussion->user->avatar }}" alt="64*64" style="width: 64px; height: 64px" class="media-object img-circle">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ url('discussions',$discussion->id) }}">{{ $discussion->title }}</a></h4>
                            {{ $discussion->user->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop