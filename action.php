<?php
include 'MySQL.class.php';
$sql_obj = new MySQL('127.0.0.1','root','root','lzf');

if (!isset($_POST)) {
	ajax_error();
}
$data = $_POST;

$table = isset($_POST['mid'])?'replay':'messages';
if ($table == 'replay') {
	$data['uid'] = $sql_obj->find('users','id',"username='".$_POST['name']."'");
	unset($data['name']);
}

$data['createtime'] = time();

if ($sql_obj -> insert($table,$data)){
	ajax_success();
}else{
	ajax_error();
}


function ajax_success($data = NULL) {
	header('Content-Type:application/json; charset=utf-8');
	$ret = [
	'ok' => true,
	];
	$ret['body'] = $data;
	exit(json_encode($ret));
}

function ajax_error($code = null, $message = null) {
	header('Content-Type:application/json; charset=utf-8');

	if (is_array($code)) {
		$message = $code[1];
		$code = $code[0];
	}

	if ($message === null) {
		$message = $code;
		$code = 'SYSTEM_ERROR';
	}

	$ret = [
	'ok' => false,
	'code' => $code ?: 'SYSTEM_ERROR',
	'message' => $message ?: '系统错误，请稍后重试！',
	];
	exit(json_encode($ret));
}


