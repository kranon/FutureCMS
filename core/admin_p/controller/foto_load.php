<?php
include '../../classes/img_biper.class.php';
$link = trim(strip_tags($_GET['link']));

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
		if ($info[2] == 2){
			if ($info[0] > 1000 || $info[1] > 760){
				$new_img = new img_biper($uploadfile);
				if ($info[0] > $info[1]){
					$new_img->img_resized(1000, 'w');
				}
				else{
					$new_img->img_resized(760, 'h');
				}
				$new_img->img_save($uploadfile);
			}

			$thumb = new img_biper($thumblfile);
			$thumb->img_resized(100, 'w');
			$thumb->img_save($thumblfile);
		}
		else{
			echo 'not type 2';

			unlink($targetFile);
			unlink($targetThumb);
		}

	    echo "Файл корректен и был успешно загружен.\n";
	}
	else{
	    echo "Возможная атака с помощью файловой загрузки!\n";
	}
}
?>