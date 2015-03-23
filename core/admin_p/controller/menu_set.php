<?php
# Редактирование меню

include '../../config.php';

$result = $db->query("SELECT `id`,`num`,`link`,`in` FROM `menu`");
while ($row = $db->fetch_array($result)){
	$id = $row['id'];
	$pub = 0;

	if (isset($_POST[$id])) {
		$pub = $_POST[$id];
	}

	$in = $_POST['in_'.$row['id']];
	$name_lang1 = htmlspecialchars($_POST['name_lang1_'.$row['id']], ENT_QUOTES);
	$name_lang2 = htmlspecialchars($_POST['name_lang2_'.$row['id']], ENT_QUOTES);
	$link = htmlspecialchars($_POST['link_'.$row['id']], ENT_QUOTES);

	$sql = "UPDATE `menu`
		SET
			`published` = '$pub',
			`in` = '$in',
			`lang1` = '$name_lang1',
			`lang2` = '$name_lang2',
			`link` = '$link'
		WHERE `id` = '$id';";
	$db->query($sql);

	$link = $row['link'];

	if (strlen($link) > 1){
		$link = str_replace('/', '', $link);
	}

	$sql = "UPDATE `page` SET `in_menu` = '$pub' WHERE `link` = '$link';";
	$db->query($sql);
}
$db->CloseDBConnection();
echo '1';
?>