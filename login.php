<?php
session_start();
if (isset($_POST['dosubmit'])) {
	include 'MySQL.class.php';
	$username = addslashes($_POST['username']);
	$password = md5($_POST['password']);
	$db = new MySQL('localhost', 'root', 'root', 'lzf');
	$sql = "SELECT * FROM users WHERE username='{$username}'";
	$user = $db->getOne($sql);
	if (empty($user)) {
		redirect('user not exists!');
		exit;
	} 
	if ($user['password'] != $password) {
		redirect('password error!');
		exit;
	}

	$_SESSION['is_login'] = $user['username'];
	header('Location:index.php');
	exit;
}

function redirect($msg, $delay = 3) {
	$output = '<div><p>' . $msg . '</p><span id="counter">' . $delay . '</span>秒后跳转</div>
	<script type="text/javascript">
	// setTimeout("document.location=\'index.php\';", 2000 );
		function counter(){ 
			var div = document.getElementById(\'counter\');
			var time = parseInt(div.innerHTML);
			time--;
			div.innerHTML = time;
			if (time == 0) {
				document.location=\'index.php\'; 
			}

			setTimeout(function(){ 
				counter(); 
			}, 1000);
		}
		setTimeout(function(){ 
			counter(); 
		}, 1000);
	</script>';
	echo $output;
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>用户登录</title>
	<link href="css/login.css" rel="stylesheet"/>
	<link href="css/init.css" rel="stylesheet"/>
</head>
<body>
	<div class="header">
		<div class="container">
			<a href="index.php">
				<img src="images/home_03.png">
				<h1>深圳市有棵树科技股份有限公司</h1>
			</a>
		</div>
	</div>
	<div class="main">
		<div class="form">
			<form action="login.php" method="POST">
				<div class="form_message"><label>用户名:</label><input type="text" id="username" name="username" /></div>
				<div class="clc"></div>
				<div class="form_message"><label>密码:</label><input type="password" id="password" name="password" /></div>
				<input type="submit" id="dosubmit" name="dosubmit" value="登录" />
			</form>
		</div>
	</div>
</body>
</html>
