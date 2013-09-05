<?php
# Редактирование комментария к новости #
include '../../config.php';
$id = intval($_POST['id']);
$text = htmlspecialchars($_POST['text'], ENT_QUOTES);

$db->commentEdit($id,$text);
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>