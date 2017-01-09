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
<style>
    .footer {
        color: #777;
        padding: 30px 0;
        border-top: 1px solid #e5e5e5;
        margin-top: 70px;
    }
</style>
<footer class="footer">
    <div class="container">
        <div class="row footer-top">
            <div class="col-sm-6 col-lg-6">
                <h4>
                    <img src="http://static.bootcss.com/www/assets/img/logo.png">
                </h4>
                <p>本网站所列开源项目的中文版文档全部由<a href="http://www.bootcss.com/">Bootstrap中文网</a>成员翻译整理，并全部遵循 <a href="http://creativecommons.org/licenses/by/3.0/" target="_blank">CC BY 3.0</a>协议发布。</p>
            </div>
            <div class="col-sm-6  col-lg-5 col-lg-offset-1">
                <div class="row about">
                    <div class="col-xs-3">
                        <h4>关于</h4>
                        <ul class="list-unstyled">
                            <li><a href="/about/">关于我们</a></li>
                            <li><a href="/ad/">广告合作</a></li>
                            <li><a href="/links/">友情链接</a></li>
                            <li><a href="/hr/">招聘</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-3">
                        <h4>联系方式</h4>
                        <ul class="list-unstyled">
                            <li><a href="http://weibo.com/bootcss" title="Bootstrap中文网官方微博" target="_blank">新浪微博</a></li>
                            <li><a href="mailto:admin@bootcss.com">电子邮件</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-3">
                        <h4>旗下网站</h4>
                        <ul class="list-unstyled">
                            <li><a href="http://www.golaravel.com/" target="_blank">Laravel中文网</a></li>
                            <li><a href="http://www.ghostchina.com/" target="_blank">Ghost中国</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-3">
                        <h4>赞助商</h4>
                        <ul class="list-unstyled">
                            <li><a href="http://www.ucloud.cn/" target="_blank">UCloud</a></li>
                            <li><a href="https://www.upyun.com" target="_blank">又拍云</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <div class="row footer-bottom">
            <ul class="list-inline text-center">
                <li><a href="http://www.miibeian.gov.cn/" target="_blank">京ICP备11008151号</a></li><li>京公网安备11010802014853</li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>