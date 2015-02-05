<?php
# Чтение данных из базы для "Галерея" #
include '../../config.php';

$id = intval($_POST['id']);
$name_lang1 = htmlspecialchars($_POST['name_lang1'], ENT_QUOTES);
$name_lang2 = htmlspecialchars($_POST['name_lang2'], ENT_QUOTES);
$album_year = strip_tags($_POST['album_year']);

$sql = "UPDATE `gallery` SET
						`name_lang1`='".$name_lang1."',
						`name_lang2`='".$name_lang2."',
						`album_year`='".$album_year."'
	WHERE `id`='".$id."'";
$db->query($sql);
echo '1';
?>
