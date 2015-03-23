<?php
include '../../config.php';

$roles_lang1 = $db->GetRoles('lang1');
$roles_lang2 = $db->GetRoles('lang2');

$json = array();

foreach ($roles_lang1 as $id => $name) {
	$json[] = array(
		'id' => $id,
		'lang1' => $name,
		'lang2' => $roles_lang2[$id],
	);
}
echo json_encode($json);

?>