<?php session_start();
# Чтение данных из базы для "Редактирование страниц" #
include '../../config.php';
$json = '';
$sql = "SELECT `id`, `lang1`, `link`,`in_menu`,`edit_date` FROM `page` ORDER BY `lang1` ASC;";
$result = $db->query($sql);
while ($row = $db->fetch_array($result)){
	$row['group'] = $_SESSION['group'];
    $json[] = $row;
}
$db->CloseDBConnection();
echo json_encode($json);
?>