<?php
include '../../config.php';

$id = intval($_POST['id']);

if ($id > 0){
	$user_count = 0;
	$sql = "SELECT `id` FROM `users` WHERE `group` = '$id'";
	$res = $db->query($sql);
	$user_count = $db->num_rows($res);

	if ($user_count <= 0){
		$sql = "DELETE FROM `role` WHERE `id` = '$id'";
		$db->query($sql);
		echo '1';
	}
	else{
		echo 'В этой группе есть пользователи!';
	}
}
else{
	echo 'Некорректный id!';
}

?>