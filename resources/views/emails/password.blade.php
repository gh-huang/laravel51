<!-- 文件 resources/views/emails/password.blade.php -->

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<p>点击此处重置你的密码：</p><a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a>
</body>
</html>