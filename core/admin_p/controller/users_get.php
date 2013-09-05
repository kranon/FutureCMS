<?php
include '../../config.php';
$json = '';
$sql = "SELECT `id`, `lang1`, `lang2` FROM `role`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result)){
	$rol[$row['id']] = $row['lang1'];
	$all .= '<option value='.$row['id'].'>'.$row['lang1'].'</option>';
}
$num_mas = sizeof($rol);

$sql = "SELECT `id`, `login`, `pass`, `email`, `sex`, `ava`, `group`, `datreg` FROM `users`";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result)){
	$els = '';
	for ($n = 1; $n <= $num_mas; $n++){
		$now = '<option value='.$row['group'].'>'.$rol[$row['group']].'</option>';
		if ($rol[$row['group']] != $rol[$n]){
			$els .= '<option value='.$n.'>'.$rol[$n].'</option>';
		}
	}
	$gr = '<select name='.$row['id'].'>'.$now.$els.'</select>';
	
	$row['group'] = $gr;
	$json[] = $row;
}
$db->CloseDBConnection();
echo json_encode($json);
?>