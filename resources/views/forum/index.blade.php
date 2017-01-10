@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>欢迎来到laravel forum社区!
                <a class="btn btn-primary btn-lg pull-right" href="{{ url('discussions/create') }}" role="button">发布帖子</a>
            </h1>
        </div>
    </div>

    <div class="container">
        <div id="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="{{ url('discussions',$discussion->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $discussion->user->name }} 发布于 {{ $discussion->created_at->diffForHumans() }}">
                                <img src="{{ $discussion->user->avatar }}" alt="46*46" style="width: 46px; height: 46px" class="media-object img-circle">
                            </a>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">
                                <a href="{{ url('discussions',$discussion->id) }}">{{ $discussion->title }}</a>
                                <span class="media-conversation-replies icon-comment-alt"> {{ $discussion->comments_count }}</span>
                            </h3>
                            @if($discussion->comments_count)
                                <span class="username  icon-reply"> {{ $discussion->comments()->latest()->first()->user->name }}</span> 回复于 {{ $discussion->comments()->latest()->first()->created_at->diffForHumans() }}
                            @else
                            <span class="username">{{ $discussion->user->name }}</span> 发布于 {{ $discussion->created_at->diffForHumans() }}
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="media-bottom pull-right">
                    {{ $discussions->render() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () { $("[data-toggle='tooltip']").tooltip(); });
    </script>
@stop