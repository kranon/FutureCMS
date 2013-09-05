<?php
# Чтение данных из базы для "Редактирование новостей" #
include '../../config.php';
$json = '';

$sql = "SELECT `id`, `caption_lang1`, DATE_FORMAT(date,'%d.%m.%Y в %H:%i:%S') as date FROM `news` ORDER BY `date` DESC;";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result)){
	$sql2 = "SELECT COUNT(1) as count FROM `news_comments` WHERE `news_id`=".$row['id'];
	$res = $db->query($sql2);
	while ($row2 = mysql_fetch_array($res)){
		$comm_count = $row2['count'];
	}
	$row['count'] = $comm_count;
    $json[] = $row;
}
$db->CloseDBConnection();
echo json_encode($json);
?>
