<?php
# Удаление пользователя
include '../../config.php';
$id = $db->ClearData($_GET['id']);
$db->userDel($id);
$db->CloseDBConnection();
echo '1';
?>