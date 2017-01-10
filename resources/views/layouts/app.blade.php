<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>laravel forum</title>
    {{--<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('Font-Awesome/css/font-awesome.min.css') }}">--}}
    {{--<link rel="stylesheet" href="{{ asset('css/style.css') }}">--}}
    {{--<script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>--}}
    {{--<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>--}}

    {{--使用自带app.css app.js 已包含bootstrap、jquery、vue--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('Font-Awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-inverse navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">laravel forum</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/') }}">首页</a></li>
                <li><a href="#about">积分规则</a></li>
                <li><a href="#contact">积分商城</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">欢迎，{{ Auth::user()->name }}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="" class="icon-user"> 我的账户</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/user/avatar') }}">更换头像</a></li>
                        <li><a href="#">修改密码</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('logout') }}" class="icon-signout"> 退出登录</a></li>
                    </ul>
                </li>
                <li><img src="{{ Auth::user()->avatar }}" alt="" width="46" class="img-circle"></li>
            </ul>
            @else
                <!--<form class="navbar-form navbar-right" role="form">-->
                    <!--&lt;!&ndash;<div class="form-group">&ndash;&gt;-->
                    <!--&lt;!&ndash;<input type="text" placeholder="邮箱" class="form-control">&ndash;&gt;-->
                    <!--&lt;!&ndash;</div>&ndash;&gt;-->
                    <!--&lt;!&ndash;<div class="form-group">&ndash;&gt;-->
                    <!--&lt;!&ndash;<input type="password" placeholder="密码" class="form-control">&ndash;&gt;-->
                    <!--&lt;!&ndash;</div>&ndash;&gt;-->
                    <!--&lt;!&ndash;<button type="submit" class="btn btn-success">Sign in</button>&ndash;&gt;-->
                    <!--</form>-->
                <li><a href="{{ url('/user/login') }}">登陆</a></li>
                <li><a href="{{ url('/user/register') }}">注册</a></li>
            @endif
        </div><!--/.navbar-collapse -->
    </div>
</nav>

@yield('content')


<footer class="footer">
    <div class="container">
        {{--<div class="row footer-top">--}}
            {{--<div class="col-sm-6 col-lg-6">--}}
                {{--<h4>--}}
                    {{--logo img--}}
                {{--</h4>--}}
                {{--<p>logo</p>--}}
            {{--</div>--}}
            {{--<div class="col-sm-6  col-lg-5 col-lg-offset-1">--}}
                {{--<div class="row about">--}}
                    {{--<div class="col-xs-3">--}}
                        {{--<h4>关于</h4>--}}
                        {{--<ul class="list-unstyled">--}}
                            {{--<li><a href="/about/">关于我们</a></li>--}}
                            {{--<li><a href="/ad/">广告合作</a></li>--}}
                            {{--<li><a href="/links/">友情链接</a></li>--}}
                            {{--<li><a href="/hr/">招聘</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
        {{--<hr>--}}
        <div class="row footer-bottom">
            <ul class="list-inline text-center">
                <li><a href="#" target="_blank">备案号 </a></li><li>地址</li>
            </ul>
        </div>
    </div>
</footer>
@yield('js')
</body>
</html>