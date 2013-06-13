<?php
# Удаление новости #
include('../../config.php');
$id=(int)$_GET['id'];
$db->DelNews($id);
$db->CloseDBConnection();
echo '1';
?>