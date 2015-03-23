<?php
session_start();
include '../../config.php';
$album = $_GET['album'];
$name = $_GET['name'];
$photo_id = intval($_GET['photo_id']);

if ($_SESSION['group'] == 1 || $_SESSION['group'] == 2){
	$photo = $_SERVER['DOCUMENT_ROOT']."/gallery_img/$album/$name";
	$photo_thumb = $_SERVER['DOCUMENT_ROOT']."/gallery_img/$album/thumbs/$name";
	if (file_exists($photo)){
		unlink($photo) or die("Ошибка удаления foto!");

		$sql = "DELETE FROM `gallery_img` WHERE `id` = ".$photo_id;
		$db->query($sql);
	}
	if (file_exists($photo_thumb)){
		unlink($photo_thumb) or die("Ошибка удаления thumb!");
	}
}
//header('Location: '.$_SERVER['HTTP_REFERER']);
//exit;
?>