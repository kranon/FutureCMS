<?php
session_start();
include '../../config.php';

$id = intval($_POST['user_id']);

if ($_SESSION['group'] == 1){
	// TODO: проверить чтобы никто кроме админа и самого пользователя не могли удалить фото

	$sql = "SELECT `ava` FROM `users` WHERE `id` = $id";
	$result = $db->query($sql);
	if ($row = $db->fetch_array($result)){
		$ava = $_SERVER['DOCUMENT_ROOT'].'/avatars/'.$row['ava'];
		if (file_exists($ava)){
			unlink($ava);
		}

		$sql = "UPDATE `users` SET `ava` = 'default.png' WHERE `id` = $id";
		$db->query($sql);
		echo '1';
	}
}
else{
	echo 'У вас нет прав для удалния аватарки!';
}
?>