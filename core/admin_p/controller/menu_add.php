<?php
# Дабавление нового меню
include '../../config.php';
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$pub = $_POST['publ'];
$in = $_POST['in'];
$link = $_POST['link'];

if ($pub == 'on'){
	$pub = 1;
}
else {
	$pub = 0;
}
	
$menu_data = array(
	'name' => $name,
	'pub' => $pub,
	'in' => $in,
	'link' => $link
);

$db->MenuAdd($menu_data); 
?>