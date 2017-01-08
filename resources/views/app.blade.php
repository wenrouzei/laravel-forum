<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laravel forum</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('Font-Awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<body>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>
                        <a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="{{ url('/user/avatar') }}"> <i class="icon-user"></i> 更换头像</a></li>
                            <li><a href="#"> <i class="icon-cog"></i> 更换密码</a></li>
                            <li><a href="#"> <i class="icon-heart"></i> 特别感谢</a></li>
                            <li role="separator" class="divider"></li>
                            <li> <a href="{{ url('logout') }}">  <i class="icon-signout"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    <li><img src="{{ Auth::user()->avatar }}" alt="" width="50" class="img-circle"></li>
                @else
                <li><a href="{{ url('/user/login') }}">登陆</a></li>
                <li><a href="{{ url('/user/register') }}">注册</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

@yield('content')
@yield('footer')
</body>
</html>