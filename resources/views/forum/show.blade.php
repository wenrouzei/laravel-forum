@extends('layouts.app')

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
            <div class="col-md-9" role="main" id="post">
                <div class="blog-post">
                    {!! $html !!}
                </div>
                <br>
                @foreach($discussion->comments()->latest()->paginate(10) as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img src="{{ $comment->user->avatar }}" alt="46*46" style="width: 46px; height: 46px" class="media-object img-circle">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</a> <span style="font-size: 12px; font-weight: normal;">回复于{{ $discussion->created_at->diffForHumans() }}</span></h4>
                            {{ $comment->body }}
                        </div>
                    </div>
                @endforeach

                @if(Auth::check())
                <div class="media" v-for="comment in comments">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" v-bind:src="comment.avatar" alt="46*46" style="width: 46px; height: 46px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">@{{ comment.name }}</a></h4>
                        @{{ comment.body }}
                    </div>
                </div>
                @endif

                <div class="media-bottom pull-right">
                {{ $discussion->comments()->latest()->paginate(10)->render() }}
                </div>
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

                    {!! Form::open(['url'=>'/comments', 'v-on:submit'=>'onSubmitForm']) !!}
                        {!! Form::hidden('discussion_id', $discussion->id) !!}
                    {{-- Body field --}}
                    <div class="form-group">
                        {!! Form::textarea('body', null, ['class'=>'form-control', 'v-model'=>'newComment.body', 'required']) !!}
                    </div>

                    {!! Form::submit('发表评论', ['class'=>'btn btn-success pull-right']) !!}

                    {!! Form::close() !!}
                @else
                    <a href="{{ url('login') }}" class="btn btn-block btn-success">登录参与评论</a>
                @endif
            </div>
        </div>
    </div>
@stop

@section('js')
    {{--laravel5.3 app.js文件自带vue--}}
    {{--<script src="{{ asset('js/vue.min.js') }}"></script>--}}
    {{--<script src="{{ asset('js/vue-resource.min.js') }}"></script>--}}
    @if(Auth::check())
        <script>
            Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;
            new Vue({
                el:'#post',
                data:{
                    comments:[],
                    newComment:{
                        name:'{{ Auth::user()->name }}',
                        avatar:'{{ Auth::user()->avatar }}',
                        body:''
                    },
                    newPost:{
                        discussion_id:'{{ $discussion->id }}',
                        user_id:'{{ Auth::user()->id }}',
                        body:''
                    }
                },
                methods:{
                    onSubmitForm:function (e) {
                        e.preventDefault();
                        var comment = this.newComment;
                        var post = this.newPost;
                        post.body = comment.body;
                        this.$http.post('/comments', post).then(
                            (response) => {
                            if(response.data.success){
                                this.comments.push(comment);
                            }else{
                                alert('发表评论失败');
                            }
                        },
                        (response) => {
                            // error callback
                            alert('发表评论失败');
                        });
                        this.newComment = {
                            name:'{{ Auth::user()->name }}',
                            avatar:'{{ Auth::user()->avatar }}',
                            body:''
                        };
                    }
                }
            })
        </script>
    @endif
@stop