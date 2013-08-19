<?php
include 'classes/base.class.php';
//include 'classes/auth.class.php';
$db = new DataBase('localhost','root','root');
$db->SelectDataBase('futurecms');

$site['lang1']['name'] = 'Сужэнскія сустрэчы';
$site['lang1']['header'] = 'Сужэнскія сустрэчы';
$site['lang1']['footer'] = '© 2012-'.date('Y').' <b>Сужэнскія сустрэчы.</b> Усе правы абаронены.';

$site['lang2']['name'] = 'Супружеские встречи';
$site['lang2']['header'] = 'Супружеские встречи';
$site['lang2']['footer'] = '© 2012-'.date('Y').' <b>Супружеские встречи.</b> Все права защищены.';

$meta['lang1']['title'] = 'Сужэнскія сустрэчы';
$meta['lang1']['keywords'] = 'Сужэнскія сустрэчы';
$meta['lang1']['description'] = 'Сужэнскія сустрэчы';

$meta['lang2']['title'] = 'Супружеские встречи';
$meta['lang2']['keywords'] = 'Супружеские встречи';
$meta['lang2']['description'] = 'Супружеские встречи';

// TODO !!! сохранить данные в файле для уменьшения запросов к БД
/*$sql="SELECT `id`,`siteName`,`siteHeader`,`siteFooter`,`metaTitle`,`metaKeywords`,`metaDescription`,`metaCharset` FROM `settings`";
$res=$db->query($sql);
while ($row = mysql_fetch_array($res)){
	$meta['lang'.$row['id']]=array(
			'title'=>$row['metaTitle'],
			'keywords'=>$row['metaKeywords'],
			'description'=>$row['metaDescription'],
			'charset'=>$row['metaCharset']
	);
	$site['lang'.$row['id']]=array(
			'name'=>$row['siteName'],
			'header'=>$row['siteHeader'],
			'footer'=>$row['siteFooter']
		);
}*/
// год - № недели - день недели
$site['version']='13.26.5';
?>
