<?php
$login = $db->ClearData($_GET['login']);

// Изменение профиля
if (isset($_POST['user_data'])){
	unset($_POST['user_data']);
	foreach ($_POST as $key => $value) {
		$data[$key] = $db->ClearData($value);
	}

	if ($_FILES['ava']['name']){
		// Загрузка аватарки
		$f_name = $data['login'].strrchr(basename($_FILES['ava']['name']), '.');
		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/avatars/';
		$uploadfile = $uploaddir.$f_name;

		if (!move_uploaded_file($_FILES['ava']['tmp_name'], $uploadfile)){
			//echo 'файл не загружен';
			$uploadfile = $_SERVER['DOCUMENT_ROOT'].'/avatars/default.png';
		}
		else{
			$info = getimagesize($uploadfile);
			if ($info[2] == 1 or $info[2] == 2 or $info[2] == 3){
				if ($info[0] > 100 || $info[1] > 100){
					// изменение размера изображения
					include $_SERVER['DOCUMENT_ROOT'].'/core/classes/img_biper.class.php';
					$new_img = new img_biper($uploadfile);
					if ($info[0]>$info[1]){
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
				$uploadfile = $_SERVER['DOCUMENT_ROOT'].'/avatars/default.png';
			}
		}
		$data['ava'] = basename($uploadfile);
	}

	$db->userUpdate($data);
}

if ($login){
	$sql = "SELECT `users`.`id` as user_id, `active`, `login`,`ava`,`sex`,`name`,`last_name`,`group`,`email`,`datreg`,`role`.`id`,`role`.`".$lang."` FROM `users`,`role` WHERE `login`='".$login."' and `role`.`id` = `group`";
	$result = $db->query($sql);
	if ($db->num_rows($result) > 0){
		while ($row = $db->fetch_array($result)){
			if ($login == $_SESSION['login'] && $row['active'] == 'Y'){
				$form .= '<form action="" method="post" enctype="multipart/form-data"><img src="/avatars/'.$row['ava'].'?'.date('His').'" alt="avatar" /> <br />';
				$form .= '<input type="hidden" name="user_id" value="'.$row['user_id'].'">';
				$form .= '<input type="hidden" name="login" value="'.$row['login'].'">';
				$form .= '<b>'.$word[9].'</b><br /><input type="file" name="ava"><br />';
				$form .= '<b>'.$word[6].': </b>'.$row['login'].'<br />';
				$form .= '<b>E-mail: </b>'.$row['email'].'<br />';
				$form .= '<input type="text" name="name" value="'.$row['name'].'"><br />';
				$form .= '<input type="text" name="last_name" value="'.$row['last_name'].'"><br />';
				$form .= '<b>Пол: </b><br />';
				$form .= '<label class="radio">
					<input type="radio" '.($row['sex'] == 'men' ? 'checked="checked"' : '') . ' name="sex" id="sex_men" value="men" checked>
					Мужской
				</label><br />
				<label class="radio">
					<input type="radio" '. ($row['sex'] != 'men' ? 'checked="checked"' :'') .' name="sex" id="sex_women" value="women">
					Женский
				</label><br />';
				$form .= '<b>'.$word[32].':</b><br /><input type="password" value=""><br /><input type="password" value=""><br />';
				$form .= '<b>'.$word[23].' </b>'.$row[$lang].'<br />';
				$form .= '<b>'.$word[24].' </b>'.$row['datreg'].'<br />
				<input type="submit" name="user_data" value="'.$word[18].'">
				</form>';
			}
			else{
				$form .= '<img src="/avatars/'.$row['ava'].'" alt="avatar" /> <br />';
				$form .= '<b>'.$word[22].' </b>'.$row['login'].'<br />';

				if ($row['sex'] == 'men'){
					$sex = $word[11];
				}
				else{
					$sex = $word[12];
				}
				$form .= '<b>Пол: </b>'.$sex.'<br />';
				$form .= '<b>'.$word[24].' </b>'.$row['datreg'].'<br />';
			}
		}
	}
	else{
		$form .= 'Пользователя с логином "'.$login.'" не существует!`';
	}
}
else{
	header('Location: /');
	exit;
}
?>