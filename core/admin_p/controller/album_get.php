<?php
# Чтение данных из базы для "Галерея" #
include '../../config.php';
$grop=$_POST['grop'];

$sql="SELECT `id`,`name_lang1`,`name_lang2`,`link`,`date` FROM `gallery` ORDER BY `num`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result)){
	$json[] = $row;
}
$db->CloseDBConnection();
echo json_encode($json);
?>