<?php
include '../../classes/img_biper.class.php';
include '../../config.php';
$link = trim(strip_tags($_GET['link']));
$album_id = intval($_GET['album_id']);

$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/gallery_img/'.$link.'/';
$uploadfile = $uploaddir . basename($_FILES['files']['name']);

$thumbldir = $_SERVER['DOCUMENT_ROOT'].'/gallery_img/'.$link.'/thumbs/';
$thumblfile = $thumbldir . basename($_FILES['files']['name']);

if (!empty($_FILES)){
	copy($_FILES['files']['tmp_name'], $thumblfile);

	if (move_uploaded_file($_FILES['files']['tmp_name'], $uploadfile)) {
		$info = getimagesize($uploadfile);
		// $info = getimagesize($thumb[$i]);
		// $info[0] содержит ширину/width в пикселах.
		// $info[1] содержит высоту/height.
		// $info[2] содержит тип файла:
		// 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(байтовый порядок intel),
		// 8 = TIFF(байтовый порядок motorola), 9 = JPC, 10 = JP2, 11 = JPX.
		$size = $db->GetGalleryImgSize();
		$width = $size['width'];
		$height = $size['height'];
		if ($info[2] == 2){
			if ($info[0] > $width || $info[1] > $height){
				$new_img = new img_biper($uploadfile);
				if ($info[0] > $info[1]){
					$new_img->img_resized($width, 'w');
				}
				else{
					$new_img->img_resized($height, 'h');
				}
				$new_img->img_save($uploadfile);
			}

			$thumb = new img_biper($thumblfile);
			$thumb->img_resized(100, 'w');
			$thumb->img_save($thumblfile);
		}
		else{
			echo 'not type 2';

			unlink($uploadfile);
			unlink($thumblfile);
		}
		if ($uploadfile){
			$link_file = basename($uploadfile);
			$sql = "INSERT INTO `gallery_img` (`album_id`, `link`, `sort`, `create_date`)
					VALUES ('$album_id', '$link_file', '0', NOW())";
			$db->query($sql);
		}
	    echo "Файл корректен и был успешно загружен.\n";
	}
	else{
	    echo "Возможная атака с помощью файловой загрузки!\n";
	}
}
?>