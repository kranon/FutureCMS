<?php
include ROOT_DIR.'/core/classes/auth.class.php';

$style = '<link rel="stylesheet" href="/design/form_err.css" type="text/css">';
$script = '<script type="text/javascript" src="/design/register_validate.js"></script>';

$form .= '<span id="error_message">'.$_SESSION['reg_error'].'</span>';
unset($_SESSION['reg_error']);
if ($_SESSION['login'] == null){
	$form .= Auth::ShowRegForm($word,'core/register.php');
}
else {
	$form .= '<br /><p>Вы уже авторизованы!</p>';
}
?>