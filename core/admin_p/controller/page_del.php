<?php
# Удаление страницы #
include '../../config.php';
$id = intval($_GET['id']);
$result = $db->query("SELECT `link`,`lang1` FROM `page` WHERE `id`=".$id);
while ($row = mysql_fetch_array($result)){
	$link = $row['link'];
	$name = $row['lang1'];
}
// Проверка, чтобы не удалить главную страницу
if ($link != ''){
	$result = $db->query("SELECT `menu`.`id` FROM `menu`,`page` WHERE `page`.`id`=".$id." and `menu`.`link`=`page`.`link`");
	while ($row = mysql_fetch_array($result)){
		$id_menu = $row['id'];
	}
	if (isset($id_menu)){
		$db->MenuDel($id_menu);
	}
	$db->PageDel($id);
	$db->CloseDBConnection();
	echo '1';
}
else{
	echo 'Страницу '.$name.' удалить нельзя!!';
}
?>
