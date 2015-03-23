<?php
include 'classes/base.class.php';
$db = new DataBase('localhost', 'root', '', 'futurecms');

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

// год . № недели . день недели
$site['version'] = '13.36.5';
?>
