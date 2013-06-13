<?php
# Добавление нового альбома #
include '../../config.php';
// проверить входные данные !!!!
$name = $_POST['name'];

$link = $db->translitIt($name);

// Данная функция не будет работать если в php включен безопасный режим (safe_mode = on)
if (is_dir('../../../gallery/'.$link)){
	$i = 1;
	$dir = false;
	while(!$dir){
		if (is_dir('../../../gallery/'.$link.'_'.$i)){
			$i++;
		}
		else{
			$link .= '_'.$i;
			mkdir('../../../gallery/'.$link);
			mkdir('../../../gallery/'.$link.'/thumbs');
			$dir = true;
		}
	}
}
else{
	mkdir('../../../gallery/'.$link);
	mkdir('../../../gallery/'.$link.'/thumbs');
}

$sql="INSERT INTO `gallery` (`name_lang1`,`link`,`date`)VALUES ('".$name."','".$link."',NOW())";
$db->query($sql);

echo '1';
?>
