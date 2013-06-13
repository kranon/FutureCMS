<?php
# Редактирование настроек сайта.
include '../../config.php';

$mainPage=stripslashes($_POST['main_html_data']);
$otherPage=stripslashes($_POST['other_html_data']);

$handle = fopen("../../html_templates/main_page_html.php", "w");
	fwrite($handle, $mainPage);
	fclose($handle);
$handle = fopen("../../html_templates/other_page_html.php", "w");
	fwrite($handle, $otherPage);
	fclose($handle);
echo '1';
?>