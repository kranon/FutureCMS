<?php
# Чтение данных из базы для "Настройки" #
include '../../config.php';
/*$sql="SELECT * FROM `html_templ`;";
$result = $db->query($sql);
while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
	$main_page=stripslashes($row['main_page']);
	$other_page=stripslashes($row['other_page']);
	$json.='{"main_html":"'.$main_page.'","other_html":"'.$other_page.'"},';
}*/
$data=file_get_contents('../../html_templates/main_page_html.php');
//echo $data;
//$main_page=htmlspecialchars($data,ENT_QUOTES);
//$main_page=addslashes($main_page);
//$main_page=nl2br($main_page);
//echo $main_page;
$main_page="111  
33";
$main_page=htmlentities($main_page);
$main_page=htmlspecialchars($main_page);
$main_page=nl2br($main_page);

//echo $main_page;



$other_page='111';

$json.='{"main_html":"'.$main_page.'","other_html":"'.$other_page.'"},';



$len=strlen($json);
$json=substr_replace($json, '', $len-1, 1);

//$json='{"main_html":"<p>ssss</p>","other_html":"<p>rrrr</p>"}';
//echo '['.$json.']';
?>