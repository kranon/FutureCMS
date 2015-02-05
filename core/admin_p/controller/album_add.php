<?php
# Добавление нового альбома #
include '../../config.php';
// TODO: проверить входные данные !!!!
$name = strip_tags(htmlspecialchars($_POST['name'], ENT_QUOTES));

$link = $db->translitIt($name);

$gallery_dir = $_SERVER['DOCUMENT_ROOT'].'/gallery_img/';
// Данная функция не будет работать если в php включен безопасный режим (safe_mode = on)
if (is_dir($gallery_dir.$link)){
	$i = 1;
	$dir = false;
	while(!$dir){
		if (is_dir($gallery_dir.$link.'_'.$i)){
			$i++;
		}
		else{
			$link .= '_'.$i;
			mkdir($gallery_dir.$link);
			mkdir($gallery_dir.$link.'/thumbs');
			$dir = true;
		}
	}
}
else{
	mkdir($gallery_dir.$link);
	mkdir($gallery_dir.$link.'/thumbs');
}

$sql = "INSERT INTO `gallery` (`name_lang1`,`link`,`date`, `album_year`)
			VALUES ('$name', '$link', NOW(), CURDATE())";
$db->query($sql);

echo '1';
?>