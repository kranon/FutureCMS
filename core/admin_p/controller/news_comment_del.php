<?php
# Удаление комментария к новости #
include '../../config.php';
$id = intval($_GET['id']);
$sql = "DELETE FROM `news_comments` WHERE `id` = ".$id;
$db->query($sql);
header('Location: '.$_SERVER['HTTP_REFERER']);
exit;
?>