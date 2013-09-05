<?php
# Удаление новости #
include('../../config.php');
$id = intval($_GET['id']);
$db->DelNews($id);
$db->CloseDBConnection();
echo '1';
?>