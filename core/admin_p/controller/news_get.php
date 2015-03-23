<?php
# Чтение данных из базы для "Редактирование новостей" #
include '../../config.php';
$json = '';

$page = intval($_GET['page']);
$count = intval($_GET['count']);

$page = ($page - 1) * $count;

$sql = "SELECT `id` FROM `page` ORDER BY `id` ASC";
$result = $db->query($sql);
$json[]['pages_count'] = ceil($db->num_rows($result) / $count);

$sql = "SELECT `id`, `caption_lang1`, DATE_FORMAT(date,'%d.%m.%Y в %H:%i:%S') as date2 FROM `news` ORDER BY `date` DESC LIMIT $page, $count;";
$result = $db->query($sql);
while ($row = $db->fetch_array($result)){
	$sql2 = "SELECT COUNT(1) as count FROM `news_comments` WHERE `news_id`=".$row['id'];
	$res = $db->query($sql2);
	while ($row2 = $db->fetch_array($res)){
		$comm_count = $row2['count'];
	}
	$row['count'] = $comm_count;
    $json[] = $row;
}
$db->CloseDBConnection();
echo json_encode($json);
?>
