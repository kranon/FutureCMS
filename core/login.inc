<?php
include ROOT_DIR."/core/classes/auth.class.php";

if ($_POST['login']){
	include 'classes/error.class.php';

	$error = new error();
	$auth = new Auth();

	$logn = $_POST['login'];
	$pass = $_POST['pass'];

	if ($auth->authorisation($logn, $pass) == true){
		$_SESSION['login'] = $logn;
		$sql = "SELECT `ava`, `group` FROM `users` WHERE `login`='".$logn."'";
		$res = $db->query($sql);
		while ($row = mysql_fetch_array($res)){
			$_SESSION['ava'] = $row['ava'];
			$_SESSION['group'] = $row['group'];
		}
	}
	else{
		$_SESSION['auth_error'] = $error->getError(7);
	}   

	$db->CloseDBConnection();
	header('Location: ../core/admin_p/');
	exit;

}
else{
	
	$style = '<link rel="stylesheet" href="/design/form_err.css" type="text/css">';
	$script = '<script type="text/javascript" src="/core/js/jquery.validate.js"></script>
	<script type="text/javascript" src="/core/js/auth_validate.js"></script><script type="text/javascript" src="/design/autorize_validate.js"></script>';

	if ($_SESSION['login'] != null){
		$form.='<br /><div id="ava" align="center">
			<a href="/O_polzovatele/?login='.$_SESSION['login'].'">
			<img src="'.$_SESSION['ava'].'" alt="avatar"/>
			</a><br />'.$_SESSION['login'].'<br />
			<a href="/core/logout.php">'.$word[4].'</a><br /><br />';
		if (($_SESSION['group'] == '1') || ($_SESSION['group'] == '2')){
			$form .= '<a href="/core/admin_p/">'.$word[3].'</a>';
		}
		$form .= '</div>';
	}
	else{
		$form .= '<span id="error_message">'.$_SESSION['auth_error'].'</span><br />';
		$form .= Auth::ShowAuthForm($word).'<span><a href="/register/">'.$word[2].'</a></span>';
		unset($_SESSION['auth_error']);
	}
}
?>