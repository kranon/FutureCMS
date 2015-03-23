<?php
# Чтение данных из базы для "Галерея" #
include '../../config.php';

$json = array();
$sql = "SELECT `id`,`name_lang1`,`name_lang2`,`link`,`date` FROM `gallery` ORDER BY `num`";
$result = $db->query($sql);
while ($row = $db->fetch_array($result)){
	$id = $row['id'];
	$sql2 = "SELECT COUNT(*) as count FROM `gallery_img` WHERE `album_id` = $id";
	$result2 = $db->query($sql2);
	while ($row2 = $db->fetch_array($result2)){
		$row['count'] = $row2['count'];
	}
	$json[] = $row;
}
$db->CloseDBConnection();
if (count($json) > 0){
	echo json_encode($json);
}
?>