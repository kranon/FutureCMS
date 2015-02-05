<?php
session_start();
$album = $_GET['album'];
$name = $_GET['name'];


if ($_SESSION['group'] == 1 || $_SESSION['group'] == 2){
	$photo = $_SERVER['DOCUMENT_ROOT']."/gallery_img/$album/$name";
	$photo_thumb = $_SERVER['DOCUMENT_ROOT']."/gallery_img/$album/thumbs/$name";
	if (file_exists($photo)){
		unlink($photo) or die("Ошибка удаления foto!");
	}
	if (file_exists($photo_thumb)){
		unlink($photo_thumb) or die("Ошибка удаления thumb!");
	}
}
//header('Location: '.$_SERVER['HTTP_REFERER']);
//exit;
?>