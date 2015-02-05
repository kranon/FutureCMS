<?php
# Чтение данных из базы для "Галерея" #
include '../../config.php';

$json = array();
$sql = "SELECT `id`,`name_lang1`,`name_lang2`,`link`,`date` FROM `gallery` ORDER BY `num`";
$result = $db->query($sql);
while ($row = $db->fetch_array($result)){
	$json[] = $row;
}
$db->CloseDBConnection();
if (count($json) > 0){
	echo json_encode($json);
}
?>