<?php session_start();
include "core/config.php";
if ($_SESSION['lang']=='lang2'){ $lang='lang2'; }
else { $lang='lang1'; }

//EEEEE

$link='index.php';

$title=$site[$lang]['name'].' - ';
$header=$site[$lang]['header'];
$name=$db->ReadPageName($link,$lang);
$footer=$site[$lang]['footer'];

$word=$db->WordsTranslate($lang);
$form=$db->ReadNews('',$lang);
include 'core/html_templates/main_page_html.php';
?>