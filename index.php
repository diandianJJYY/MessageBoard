<?php
session_start();
include 'MySQL.class.php';
date_default_timezone_set('PRC');
if (isset($_GET['act']) && ($_GET['act'] == 'logout')) {
	unset($_SESSION['is_login']);
}
$name = '';
if (isset($_SESSION['is_login'])) {
	$name = $_SESSION['is_login'];
}
$sql_obj = new MySQL('127.0.0.1','root','root','lzf'); // 连接数据库
$message_arr = array_reverse($sql_obj->query('SELECT * FROM messages'));
$replay_arr = $sql_obj->query('SELECT * FROM replay');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>留言板</title>
	<link href="css/index.css" rel="stylesheet"/>
	<link href="css/init.css" rel="stylesheet"/>
	<link href="js/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css" >
</head>
<body>
	<div class="header">
		<div class="container">
			<a class="logo" href="index.php">
				<img src="images/home_03.png">
				<h1>深圳市有棵树科技股份有限公司</h1>
			</a>
			<?php 
			if ($name) {
				echo "<p class='logout' ><a href='index.php?act=logout'>退出</a></p>";
				echo "<a id='title' name='",$name,"'>欢迎光临  ",$name,"</a>";
			}else{
				echo "<a class='login' href='login.php'>登录</a>";
			}
			?>
		</div>
	</div>
	<div class="main">
		<div class="content">
			<div class="list">
				<?php foreach ($message_arr as $key => $value) { ?>
					<div class='message' >
						<div id="<?php echo $value['id'];?>" style="display:none"></div>
						<div class='title' >
							<h1 class="name"><?php echo $value['username'];?></h1>
							<?php if ($value['gender']) {
								echo '先生';
							}else {
								echo '女士';
							}
							;?>
							<div class="tel" >
								电话：<?php echo $value['tel'];?>
							</div> 
							<p class="time"><?php echo date('Y-m-d H:i:s',$value['createtime']);?></p>
						</div>
						
						<div class="message_content" >
							<div>
								<?php echo $value['content'];?>
								<div class='replay_list'>
									<?php foreach ($replay_arr as $a => $b) {
										$u_name = $sql_obj->find('users','username','id ='.$b['uid']);
										if ($b['mid'] == $value['id']){
											echo "<p>",$u_name,"回复:",$b['content'],"<span>回复时间：&nbsp;<span>",date("Y-m-d H:i:s",$b['createtime']),"</p>";
										}
									}?>
								</div>
							</div>
							<?php if ($name) {echo "<div class='replay' name=",$value['username'],"><a href='javascript:void(0)'>回复</a></div>";}?>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="form">
					<form action="" method="POST">
						<div class="form_message"><label>姓名:</label><input type="text" id="username" name="username" /><br /></div>
						<div class="form_message"><label>性别:</label>
							<p class="gender_text">男 </p><input class="gender" type="radio" value="1" name="sex" checked>
							<p class="gender_text">女 </p><input class="gender" type="radio" value="0" name="sex"><br />
						</div>
						<div class="clc"></div>
						<div class="form_message"><label>电话:</label><input type="text" id="tel" name="tel" onblur="checkMobile(this)"/><span id= 'tip'></span><br /></div>
						<div class="form_message"><label>内容:</label><textarea type="text" id="content" name="content"></textarea><br /></div>
						<a id="dosubmit" >提交</a>
					</form>
				</div>
			</div>	
		</div>
		<div class="footer"></div>
		<script src="js/jquery-3.0.0.min.js"></script>
		<script src="js/sweetalert/dist/sweetalert.min.js"></script>
		<script src="js/index.js"></script>
		<script type="text/javascript">
			function checkMobile(input) {
			    var mobile_number = input.value;
			    var mobile_rule = /^1[3|4|5|7|8][0-9]{9}$/;
			    var tip = document.getElementById("tip");
			    if(mobile_number.match(mobile_rule) == null){
			        tip.innerHTML = "请输入11位正确的手机号码！";
			        return false;
			    } else {
			        tip.innerHTML = "输入正确";
			        $("#tip").css("color","green");
			    }
			}
		</script>
	</body>
	</html>