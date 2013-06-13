<?php
# Редактирование комментария к новости #
include '../../config.php';
$id=(int)$_POST['id'];
$text=$_POST['text'];

$db->commentEdit($id,$text);
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>