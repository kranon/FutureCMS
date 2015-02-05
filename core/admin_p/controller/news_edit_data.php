<?php
# Обработка изменений новости (текст и заголовок) #
include '../../config.php';

$id = intval($_POST['id']);

$news = array(
	'id' => $id,
	'caption' => array(
		'lang1' => htmlspecialchars($_POST['caption_lang1'],ENT_QUOTES),
		'lang2' => htmlspecialchars($_POST['caption_lang2'],ENT_QUOTES)
	),
	'text' => array(
		'lang1' => $_POST['editor_lang1'],
		'lang2' => $_POST['editor_lang2']
	),
);
$db->UpdateTextNews($news);

$db->CloseDBConnection();
header('Location: ../index.php?content=news_edit&id='.$id);
exit();
?>
