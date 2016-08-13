<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>这是后台首页</p>
<br>
<p>welcome</p><p>{{ Auth::user()->name }}</p>
<div>
	{{ Auth::user() }}
</div>
<a href="logout">登出</a>
</body>
</html>