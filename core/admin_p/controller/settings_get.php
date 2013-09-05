<?php
# Чтение данных из базы для "Настройки" #
include '../../config.php';
$sql = "SELECT * FROM `settings`";
$result = $db->query($sql);
$i = 1;
while ($row = mysql_fetch_array($result)){
	$json['lang'.$i] = $row;
	$i++;
}
echo json_encode($json);
?>