<?php session_start();
# Регистрация пользователей из панели администрирования#
# Регистрация пользователей #
include '../../config.php';
include '../../classes/auth.class.php';
include '../../classes/error.class.php';

$logn		= $_POST['login'];
$pass		= $_POST['pass'];
$ret_pass   = $_POST['retype_pass'];
$email		= $_POST['email'];
$sex		= $_POST['sex'];
$name		= $_POST['name'];
$last_name	= $_POST['last_name'];
$grup		= $_POST['group'];
$ava		= $_FILES;

$user = array(
	'logn'		=> $logn,
	'pass'		=> $pass,
	'ret_pass'	=> $ret_pass,
	'email'		=> $email,
	'sex'		=> $sex,
	'name'		=> $name,
	'last_name'	=> $last_name,
	'group'		=> $grup,
	'ava'		=> $ava
);

$auth = new auth();

if ($auth->validLogin($user['logn']) && $auth->validPass($user['pass'],$user['ret_pass']) && $auth->validEmail($user['email'])){

	if ($auth->uniqueLoginEmail($user['logn'], $user['email'], $db)){
		$auth->register($user, $db);
	}
	else{
		echo 'Такой логин или E-mail уже используются!';
		exit;
	}
}
else{
	 echo 'Введите корректные данные!';
	 exit;
}
header('Location: /core/admin_p/?content=users');
exit();

echo '1';
?>