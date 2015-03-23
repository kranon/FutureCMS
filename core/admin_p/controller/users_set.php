<?php
# обработка listbox "Группа"
# запись изменений в базу
include '../../config.php';

$user = $_POST;

$id = intval($user['id']);
$login = $user['login'];

if (strlen($user['pass']) > 0){
	if ($user['pass'] == $user['sec_password']){
		unset($user['sec_password']);
		include $_SERVER['DOCUMENT_ROOT'].'/core/classes/auth.class.php';
		$user['pass'] = Auth::hex($user['pass'], $user['login']);
	}
	else{
		unset($user['pass']);
		unset($user['sec_password']);
		die('Пароль и подтверждение пароля не совпадают!');
	}
}
else{
	unset($user['pass']);
	unset($user['sec_password']);
}

if ($user['active'] == 'on'){
	$user['active'] = 'Y';
}
else{
	$user['active'] = 'N';
}
unset($user['id']);
unset($user['login']);

foreach ($user as $key => $value) {
	$query[] = "`$key` = '$value'";
}

if ($_FILES['ava']['name']){
	// Загрузка аватарки
	$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/avatars/';
	$f_name = $login;
	$uploadfile = $uploaddir.$f_name.strrchr(basename($_FILES['ava']['name']), '.');

	if (!move_uploaded_file($_FILES['ava']['tmp_name'], $uploadfile)){
		echo 'файл не загружен';
		$uploadfile = 'default.png';
	}
	else{
		$info = getimagesize($uploadfile);
		if ($info[2] == 1 or $info[2] == 2 or $info[2] == 3){
			if ($info[0] > 100 || $info[1] > 100){
				// изменение размера изображения
				include $_SERVER['DOCUMENT_ROOT'].'/core/classes/img_biper.class.php';
				$new_img = new img_biper($uploadfile);
				if ($info[0] > $info[1]){
					$new_img->img_resized(100, 'w');
				}
				else{
					$new_img->img_resized(100, 'h');
				}
				$new_img->img_save($uploadfile);
			}
		}
		else{
			// если загружено не изображение, то удаляем файл и загрузить стандартный аватар
			unlink($uploadfile);
			$uploadfile = 'default.png';
		}
	}
	$uploadfile = basename($uploadfile);
	$query[] = "`ava` = '$uploadfile'";
}


$query = implode(', ', $query);

$sql = "UPDATE `users` SET $query WHERE `id` = $id";
$db->query($sql);

header('Location: /core/admin_p/?content=user_edit&login='.$login);
exit();
?>
