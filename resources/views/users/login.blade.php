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
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body>
<div class="container">
    @if($errors->any())
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    @endif

    @if(Session::has('user_login_failed'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('user_login_failed') }}
        </div>
    @endif
    <form class="form-signin" action="{{ url('/login') }}" method="POST" role="form">
        {{ csrf_field() }}
        <h2 class="form-signin-heading">laravel forum</h2>
        <input name="email" type="email" class="form-control" placeholder="邮箱" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="密码" required>
        <!--<div class="checkbox">-->
        <!--<label>-->
        <!--<input type="checkbox" value="remember-me"> Remember me-->
        <!--</label>-->
        <!--</div>-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
    </form>

</div> <!-- /container -->
</body>
</html>