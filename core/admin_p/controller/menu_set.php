<?php
# Редактирование меню. Обработка checkbox "Опубликовать", "Id", "Вложено в"
include '../../config.php';
$result = $db->query("SELECT `id`,`num`,`link`,`in` FROM `menu`");
while ($row = $db->fetch_array($result)){
	if ($_POST[$row['id']] == 1) {
		$pub = 1;
	}
	else {
		$pub = 0;
	}

	$id_menu = intval($_POST['id_'.$row['id']]);
	$in = $_POST['in_'.$row['id']];
	$name_lang1 = htmlspecialchars($_POST['name_lang1_'.$row['id']], ENT_QUOTES);
	$name_lang2 = htmlspecialchars($_POST['name_lang2_'.$row['id']], ENT_QUOTES);
	$link = htmlspecialchars($_POST['link_'.$row['id']], ENT_QUOTES);

	$sql = "UPDATE `menu` SET `published`='".$pub."',
							`in`='".$in."',
							`lang1`='".$name_lang1."',
							`lang2`='".$name_lang2."',
							`link`='".$link."'
		WHERE `id`='".$row['id']."'";
	$db->query($sql);

	$sql = "UPDATE `page` SET `in_menu`='".$pub."' WHERE `link`='".$row['link']."'";
	$db->query($sql);
}
$db->CloseDBConnection();
echo '1';
?>