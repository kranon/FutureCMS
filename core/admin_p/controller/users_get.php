<?php
include '../../config.php';

$json = '';

$rol = $db->GetRoles();

$page = intval($_GET['page']);
$count = intval($_GET['count']);

$page = ($page - 1) * $count;

$sql = "SELECT `id` FROM `users` ORDER BY `id` ASC";
$result = $db->query($sql);
$users_count = $db->num_rows($result);
$json[]['pages_count'] = ceil( $users_count / $count);
$json[]['users_count'] = $users_count;


$sql = "SELECT `id`, `login`, `pass`, `email`, `sex`, `ava`, `group`, `datreg` FROM `users` ORDER BY `id` DESC LIMIT $page, $count;";
$result = $db->query($sql);
while ($row = $db->fetch_array($result)){
	if (isset($rol[$row['group']])){
		$row['group'] = $rol[$row['group']];
	}
	else{
		$row['group'] = 'Пользователь';
	}

	$json[] = $row;
}
$db->CloseDBConnection();
echo json_encode($json);
?>