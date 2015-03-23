<?php session_start();
# Чтение данных из базы для "Редактирование страниц" #
include '../../config.php';
$json = '';
$page = intval($_GET['page']);
$count = intval($_GET['count']);

$page = ($page - 1) * $count;

$sql = "SELECT `id` FROM `page` ORDER BY `id` ASC";
$result = $db->query($sql);
$json[]['pages_count'] = ceil($db->num_rows($result) / $count);

$sql = "SELECT `id`, `lang1`, `link`, `in_menu`, `edit_date` FROM `page` ORDER BY `id` ASC LIMIT $page, $count;";
$result = $db->query($sql);
while ($row = $db->fetch_array($result)){
	$row['group'] = $_SESSION['group'];
    $json[] = $row;
}
$db->CloseDBConnection();
echo json_encode($json);
?>