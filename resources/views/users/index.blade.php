@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="thumbnail" style="height: 336px;">
                    <img class="img-circle" src="{{ Auth::user()->avatar }}" width="200" height="200">
                    <div class="caption">
                        <dl style="width: 80%" class="pull-right">
                            <dt>用户名：</dt>
                            <dd>{{ Auth::user()->name }}</dd>
                            <dt>注册时间：</dt>
                            <dd>{{ Auth::user()->created_at }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">

                        @include('users._nav')

                        <dl class="dl-horizontal">
                            <dt>邮箱：</dt>
                            <dd>{{ Auth::user()->email }}</dd>
                            <dt>用户名：</dt>
                            <dd>{{ Auth::user()->name }}</dd>
                            <dt>注册时间：</dt>
                            <dd>{{ Auth::user()->created_at }}</dd>
                        </dl>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
