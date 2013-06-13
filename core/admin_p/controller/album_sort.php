<?php
# Редактирование меню. Обработка checkbox "Опубликовать", "Id", "Вложено в"
include '../../config.php';

$mas=$_GET['rep'];
$mas=explode(',',$mas);

foreach ($mas as $key=>$val){
	$db->query("UPDATE `gallery` SET `num`=".$key." WHERE `id`=".$val);
}
echo '1';
?>