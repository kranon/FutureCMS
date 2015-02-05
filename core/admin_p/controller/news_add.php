<?php
# Добавление новой новости #
include '../../config.php';
$caption = htmlspecialchars($_POST['caption'], ENT_QUOTES);
$db->AddNews($caption);
echo '1';
?>