<?php
// TODO: проверить входные данные
$login = $db->ClearData($_GET['login']);

if ($login){
	$sql = "SELECT `login`,`ava`,`sex`,`group`,`email`,`datreg`,`role`.`id`,`role`.`".$lang."` FROM `users`,`role` WHERE `login`='".$login."' and `role`.`id` = `group`";
	$result = $db->query($sql);
	if (mysql_num_rows($result) > 0){
		while ($row = mysql_fetch_array($result)){
			$form .= '<img src="/avatars/'.$row['ava'].'" alt="avatar" /> <br />
			<b>'.$word[22].' </b>'.$row['login'].'<br />
			<b>E-mail: </b>'.$row['email'].'<br />';
			if ($row['sex'] == 'men'){
				$sex = $word[11];
			}
			else{
				$sex = $word[12];
			}
			$form .= '<b>Пол: </b>'.$sex.'<br />
				<b>'.$word[23].' </b>'.$row[$lang].'<br />
				<b>'.$word[24].' </b>'.$row['datreg'].'<br />';
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