<?php
include '../../config.php';

$lang1 = $_POST['lang1'];
$lang2 = $_POST['lang2'];

if ($lang1 && $lang2){
	$sql = "INSERT INTO `role` (`lang1`, `lang2`) VALUES ('$lang1', '$lang2')";
	$db->query($sql);
	echo '1';
}
else{
	echo 'Введите название типа пользователя';
}

?>