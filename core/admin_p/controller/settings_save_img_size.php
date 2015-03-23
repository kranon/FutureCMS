<?php
include '../../config.php';

$width = intval($_POST['width']);
$height = intval($_POST['height']);

if ($width > 0 && $height > 0){
	$sql = "UPDATE `settings` SET `gallery_img_width` = '".$width."', `gallery_img_height` = '".$height."'";
	$db->query($sql);
	echo '1';
}
else{
	echo 'Ширина или высота изображения должны быть больше 0!';
}

?>