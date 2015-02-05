<?php
include ROOT_DIR.'/core/classes/auth.class.php';

if ($_POST['login']){
	# Регистрация пользователей #
	include 'classes/error.class.php';

	$logn		= $_POST['login'];
	$pass		= $_POST['pass'];
	$ret_pass   = $_POST['retype_pass'];
	$email		= $_POST['email'];
	$sex		= $_POST['sex'];
	$ava		= $_FILES;

	$user = array(
		'logn'		=> $logn,
		'pass'		=> $pass,
		'ret_pass'	=> $ret_pass,
		'email'		=> $email,
		'sex'		=> $sex,
		'ava'		=> $ava
	);

	$auth = new auth();

	if ($auth->validLogin($user['logn']) && $auth->validPass($user['pass'],$user['ret_pass']) && $auth->validEmail($user['email'])){

		if ($auth->uniqueLoginEmail($user['logn'], $user['email'])){
			$auth->register($user);
			if ($auth->authorisation($logn, $pass) == true){
				$_SESSION['login'] = $logn;
				$sql = "SELECT `ava`, `group` FROM `users` WHERE `login`='".$logn."'";
				$res = $db->query($sql);
				while ($row = $db->fetch_array($res)){
					$_SESSION['ava'] = $row['ava'];
					$_SESSION['group'] = $row['group'];
				}
			}
			header('Location: ../login/');
			exit;
		}
		else{
			$_SESSION['reg_error'] = 'Такой логин или E-mail уже используются!';
		}
	}
	else{
		$_SESSION['reg_error'] = 'Введите корректные данные!';
	}

	header('Location: ../register/');
	exit;

}
else{
	$style = '<link rel="stylesheet" href="/design/form_err.css" type="text/css">';
	$script = '<script type="text/javascript" src="/design/register_validate.js"></script>';

	$form .= '<span id="error_message">'.$_SESSION['reg_error'].'</span>';
	unset($_SESSION['reg_error']);
	if ($_SESSION['login'] == null){
		$form .= Auth::ShowRegForm($word,'');
	}
	else {
		$form .= '<br /><p>Вы уже авторизованы!</p>';
	}
}
?>