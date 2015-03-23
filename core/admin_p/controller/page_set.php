<?php
# сохранение состояния страниц "в меню"(checkbox)

include '../../config.php';

$page_id = intval($_POST['page_id']);
$in_menu = intval($_POST['in_menu']);

$menu = '';
$sql = "SELECT `id`, `lang1`, `link`, `in_menu` FROM `page` WHERE `id` = $page_id";
$result = $db->query($sql);
if ($row = $db->fetch_array($result)){
	$page_link = $row['link'];
	$page_name = $row['lang1'];
	$db->query("UPDATE `page` SET `in_menu` = '$in_menu' WHERE `id` = '$page_id';");

	$sql = "SELECT `id` FROM `menu` WHERE `link` = '/$page_link/';";
	$result = $db->query($sql);
	if ($db->num_rows($result) > 0){
		$db->query("UPDATE `menu` SET `published` = '$in_menu' WHERE `link` = '/$page_link/';");
	}
	else{
		if (strlen($page_link) > 0){
			$page_link = '/'.$page_link.'/';
		}

		$menu = array(
			'name'		=> $page_name,
			'link'		=> $page_link,
			'published'	=> 1,
			'in'		=> 0,
		);
		$db->MenuAdd($menu, 'N');
	}
	echo '1';
}

$db->CloseDBConnection();
?>