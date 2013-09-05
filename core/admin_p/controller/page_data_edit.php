<?php
# сохранение изменений на странице
include '../../config.php';

$id = intval($_POST['id']);

$page = array(
	'id' => $id,
	'name' => array(
		'lang1' => htmlspecialchars($_POST['name_lang1'], ENT_QUOTES),
		'lang2' => htmlspecialchars($_POST['name_lang2'], ENT_QUOTES)
	),
	'text' => array(
		'lang1' => htmlspecialchars($_POST['editor_lang1'], ENT_QUOTES),
		'lang2' => htmlspecialchars($_POST['editor_lang2'], ENT_QUOTES),
	)
);

$db->AddText($page);

$db->CloseDBConnection();
header('Location: ../?content=page_edit&id='.$id);
exit;
?>