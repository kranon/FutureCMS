<?php
# Удаление меню #
include '../../config.php';
$id = intval($_GET['id']);

$result = $db->query("SELECT `link` FROM `menu` WHERE `id`='".$id."'");
while ($row = $db->fetch_array($result)){
    $link = $row['link'];
}
if ($link != '/'){
    $db->MenuDel($id);

	$sql = "UPDATE `page` SET `in_menu`='0' WHERE `link`='".$link."'";
    $db->query($sql);

    $db->CloseDBConnection();
  	echo '1';
}
else{
    echo 'Главную страницу удалить нельзя!';
}
?>
