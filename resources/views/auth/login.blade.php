
<form method="POST" action="/login">
    {!! csrf_field() !!}

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>

<div>
    <button><a href="/password/email">重置密码</a></button>
</div>
<div>
    <button><a href="/auth/github">Github登录</a></button>
</div>