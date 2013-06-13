<?php
# Удаление меню #
include '../../config.php';

$id = (int)$_GET['id'];

$result = $db->query("SELECT `link` FROM `menu` WHERE `id`='".$id."'");
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
    $link = $row['link'];
}
if ($link!='index.php'){
    $db->MenuDel($id);
		
	$sql="UPDATE `page` SET `in_menu`='0' WHERE `link`='".$link."'";
    $db->query($sql);
	
    $db->CloseDBConnection();
  	echo '1';
}
else{
    echo 'Главную страницу удалить нельзя!! <br /> <a href=../'.$link.'>'.$id.'</a>';
}
?>
