<?php
# Добавление новой страницы и меню для перехода на неё #
include '../../config.php';

$in_menu = 'no';
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
if (isset($_POST['add_in_menu'])){
	$in_menu = $_POST['add_in_menu'];
}

$sql = "SELECT `lang2` FROM `page` WHERE `lang2`= '".$name."'";
$result = $db->query($sql);
// Если страницы с таким именем не существует, то создаём новую
if ($db->num_rows($result) == 0){
	if ($in_menu == 'on' && $in_menu != 'no'){
		$in_menu = 1;
	}
	else {
		$in_menu = 0;
	}

	$link = $db->translitIt($name);

	if ($in_menu == 1){
		//добавление меню
		$menu = array(
			'name'		=> $name,
			'link'		=> '/'.$link.'/',
			'published'	=> $in_menu,
			'in'		=> '0'
		);
		$db->MenuAdd($menu, 'N');
	}

	//добавление страницы
	$access = serialize(array(0 => 'all'));
	if (!$db->query("INSERT INTO `page` (`lang1`,`lang2`,`link`,`in_menu`,`edit_date`, `access`)VALUES ('".$name."','".$name."', '".$link."', '".$in_menu."', NOW(), '".$access."')")){
		echo 'Ошибка запроса создания страницы (page_add.php)';
	}
	echo '1';
}
else{
	echo 'Страница с таким именем уже существует!!!';
}?>