<?php session_start();
include "core/config.php";
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

$link='Galereya.php';

$title=$site[$lang]['name'].' - ';
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);
$sort_word = array('lang1'=>'Абярыце год','lang2'=>'Выберите год');
$all = array('lang1'=>'Усе','lang2'=>'Все');
$year_sort = $_GET['year']*1;

$years = $db->GetAllGalleryYear();

foreach($years as $year){
	$str .='<a href="Galereya.php?year='.$year.'">'.$year.'</a>&nbsp;&nbsp;&nbsp; ';
}


$form .= $sort_word[$lang].': 
<a href="Galereya.php">'.$all[$lang].'</a>&nbsp;&nbsp;&nbsp;'.$str;

$form .= $db->GalleryRead($lang,$year_sort);


include 'core/html_templates/other_page_html.php';
?>
