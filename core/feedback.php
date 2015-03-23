<?
include $_SERVER['DOCUMENT_ROOT'].'/core/config.php';

$emails = $db->GetFeedbackEmails();
if ($emails){
	$name = $db->ClearData($_POST['name']);
	$email = $db->ClearData($_POST['email']);
	$message = $db->ClearData($_POST['message']);

	$text = 'Пользователь '.$name.' (E-mail: '.$email.') оставил вам сообщение:

	'.$message;

	mail($emails, 'Сообщение с сайта', $text);
}
?>