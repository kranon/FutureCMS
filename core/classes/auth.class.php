<?php
# класс авторизации, регистрации пользователей
class Auth {
	public static function hex($str, $salt = null){
		$hex_pass = sha1(sha1($str).$salt);
		return $hex_pass;
	}

	public function validLogin($logn){
		$logn = DataBase::clearData($logn);
		if (isset($logn)){
			if (!((preg_match('~^[a-z0-9_\-]*$~i', $logn)) && ((strlen($logn)>=3) && (strlen($logn)<16)))){
				$logn = null;
				return false;
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}

	// Проверка валидности и повторности пароля
	public function validPass($pass,$ret_pass){
		$pass = DataBase::clearData($pass);
		$ret_pass = DataBase::clearData($ret_pass);

		if (isset($pass) && (strlen($pass) > 5) && (strlen($pass) < 12)){
			if ($pass == $ret_pass){
				return true;
			}
			else{
				$pass = null;
				$ret_pass = null;
				return false;
			}
		}
		else{
			$pass = null;
			$ret_pass = null;
			return false;
		}
	}

	public function validEmail($email){
		$email = DataBase::clearData($email);

		$valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($valid_email == false){
			$email = null;
			return false;
		}
		else{
			return true;
		}
	}

	// Проверка повторности логина и email
	public function uniqueLoginEmail($logn, $email, $db){
		$sql = "SELECT `login`, `email` FROM `users` WHERE `login`='".$logn."' OR email='".$email."'";
		$result = $db->query($sql);
		if (mysqli_num_rows($result) > 0){
			return false;
		}
		else{
			return true;
		}
	}

	public function register($user, $db){
		$logn	= $user['logn'];
		$pass	= $user['pass'];
		$email	= $user['email'];
		$sex	= $user['sex'];
		$name	= $user['name'];
		$last_name	= $user['last_name'];
		$group	= $user['group'];
		$ava	= $user['ava'];

		$hex_pass = self::hex($pass, $logn);

		// Если аватар выбран
		if ($ava['userfile']['name']){
			// Загрузка аватарки
			$f_name = $logn;
			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/avatars/';
			$uploadfile = $uploaddir.$f_name.strrchr(basename($ava['userfile']['name']), '.');

			if (!move_uploaded_file($ava['userfile']['tmp_name'], $uploadfile)){
				//echo 'файл не загружен';
				$uploadfile = '../avatars/default.png';
			}
			else{
				$info = getimagesize($uploadfile);
				if ($info[2] == 1 or $info[2] == 2 or $info[2] == 3){
					if ($info[0] > 100 || $info[1] > 100){
						// изменение размера изображения
						include 'img_biper.class.php';
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
		}
		// Если аватар не выбран, то загрузить стандартный
		else{
			$uploadfile = $_SERVER['DOCUMENT_ROOT'].'/avatars/default.png';
		}
		if (!isset($group) || ($group == '')){
			$group = 3;
		}

		$uploadfile = basename($uploadfile, '.');

		$db->userAdd($logn, $hex_pass, $email, $name, $last_name, $uploadfile, $sex, $group);
	}
	public function authorisation($logn, $pass, $db){
		$logn = DataBase::clearData($logn);
		$pass = DataBase::clearData($pass);

		if (isset($logn) && isset($pass)){
			$pass = sha1(sha1($pass).$logn);

			$sql = "SELECT `login`,`pass` FROM `users` WHERE `login` = '$logn' AND `pass` = '$pass'";
			$result = $db->query($sql);
			if($db->num_rows($result) == 0){
				return false;
			}
			else{
				return true;
			}
		}
	}

	public static function ShowAuthForm($word){
		$form = '<div id="autorise">
		<form action="" method="post" name="autoris" id="autori">
		<input type="text" name="login" id="login" placeholder="'.$word[6].'"><br />
		<input type="password" name="pass" id="pass" placeholder="'.$word[7].'"><br /><br />
		<input type="submit" id="aut_sub" value=" '.$word[1].' ">
		</form></div><br />';
		return $form;
	}

	public static function ShowRegForm($word,$action){
		$form = '<div id="register">
				<form class="form well" enctype="multipart/form-data" action="'.$action.'" method="post" name="reg_form" id="reg_form">
				<input type="text" name="login" id="login" placeholder="'.$word[6].'"><br />
				<input type="password" name="pass" id="pass" placeholder="'.$word[7].'"><br />
				<input type="password" name="retype_pass" id="retype_pass" placeholder="'.$word[29].'"><br />
				<input type="text" name="email" id="email" placeholder="'.$word[8].'"><br />
				<input type="text" name="name" id="name" placeholder="'.$word[30].'"><br />
				<input type="text" name="last_name" id="last_name" placeholder="'.$word[31].'"><br />

				<input type="file" name="userfile" id="userfile" placeholder="'.$word[9].'"><br />
				'.$word[10].'<br />
				<input type="radio" name="sex" checked="checked" value="men"/> '.$word[11].'<br />
				<input type="radio" name="sex" value="women"/> '.$word[12].'<br /><br />
				<input type="hidden" name="group" value="3" />
				<input type="submit" class="btn btn-success" id="AddUser" value="'.$word[2].' "/>
				</form></div>';
		return $form;
	}
}
?>
