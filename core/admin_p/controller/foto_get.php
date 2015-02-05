<?php
include '../../config.php';
$album_id = intval($_REQUEST['album_id']);

if ($album_id > 0){
	$mas = $db->OpenAlbum($album_id);
	if (count($mas) > 0){
		echo json_encode($mas);
	}
}
?>