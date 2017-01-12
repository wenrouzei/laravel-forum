<ul class="nav nav-tabs nav-justified">
    <li class="{{ Request::path() == 'user/index'?'active':'' }}"><a href="{{ url('user/index') }}">个人信息</a></li>
    <li class="{{ Request::path() == 'user/credit'?'active':'' }}"><a href="{{ url('user/credit') }}">积分</a></li>
    <li class="{{ Request::path() == 'user/avatar'?'active':'' }}"><a href="{{ url('user/avatar') }}">更换头像</a></li>
    <li class="{{ Request::path() == 'user/password'?'active':'' }}"><a href="{{ url('/user/password') }}">修改密码</a></li>
    <li>
        <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form2').submit();">
            退出登录
        </a>
        <form id="logout-form2" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
</ul>
<br>