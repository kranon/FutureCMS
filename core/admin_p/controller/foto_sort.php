<?php
include '../../config.php';

$mas = $_GET['sort'];
$mas = explode(',', $mas);

foreach ($mas as $key => $val){
	$db->query("UPDATE `gallery_img` SET `sort` = $key  WHERE `id` = ".$val);
}
echo '1';
?>