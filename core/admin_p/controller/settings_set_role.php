<?php
include '../../config.php';

$id = intval($_POST['id']);
$lang = $_POST['lang'];
$value = $db->ClearData($_POST['value']);

if ($id > 0 && $value){
	$sql = "UPDATE `role` SET `$lang`='$value' WHERE `id` = '$id'";
	$db->query($sql);
	echo '1';
}
else{
	echo 'Неверные данные!';
}

?>