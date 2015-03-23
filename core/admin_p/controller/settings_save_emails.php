<?php
include '../../config.php';

$emails = strip_tags($_POST['emails']);

if (strlen($emails) > 5){
	$sql = "UPDATE `settings` SET `feedback_emails` = '".$emails."';";
	$db->query($sql);
	echo '1';
}
else{
	echo 'Введите хотя бы один e-mail!';
}
?>