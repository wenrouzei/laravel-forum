@extends('app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="">
                        <img src="{{ $discussion->user->avatar }}" alt="64*64" style="width: 64px; height: 64px" class="media-object img-circle">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                        {{ $discussion->title }}

                        @if(Auth::check() && Auth::user()->id === $discussion->user_id)
                        <a class="btn btn-primary btn-lg pull-right" href="{{ url('discussions/'.$discussion->id.'/edit') }}" role="button">修改帖子</a>
                        @endif
                    </h4>
                    {{ $discussion->user->name }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="row">
            <div class="col-md-9" role="main">
                <div class="blog-post">
                    {!! $html !!}
                </div>
                <br>
                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img src="{{ $comment->user->avatar }}" alt="64*64" style="width: 64px; height: 64px" class="media-object img-circle">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</a></h4>
                            {{ $comment->body }}
                        </div>
                    </div>
                @endforeach
                <hr>
                @if(Auth::check())
                    @if($errors->any())
                        <ul class="list-group">
                            @foreach($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url'=>'/comments']) !!}
                        {!! Form::hidden('discussion_id', $discussion->id) !!}
                    {{-- Body field --}}
                    <div class="form-group">
                        {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    </div>

                    {!! Form::submit('发表评论', ['class'=>'btn btn-success pull-right']) !!}

                    {!! Form::close() !!}
                @else
                    <a href="{{ url('user/login') }}" class="btn btn-block btn-success">登录参与评论</a>
                @endif
            </div>
        </div>
    </div>
@stop