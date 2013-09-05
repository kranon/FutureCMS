<?php
# Чтение данных из базы для "Редактирование меню" #
include '../../config.php';
$sql = "SELECT `id`,`num`,`lang1`,`lang2`,`link`,`published`,`in` FROM `menu` ORDER BY `num`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result)){
	$json[] = $row;
}	
$db->CloseDBConnection();
echo json_encode($json);
?>