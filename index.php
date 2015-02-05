<?php session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

define('ROOT_DIR', getcwd());

include ROOT_DIR."/core/config.php";

//$_SESSION['group'] = 1;
//$_SESSION['login'] = 'kranon';


//$hex_pass= sha1(sha1('123456').'kranon');
//echo $hex_pass;


if ($_GET['lang']){
	$lang = $db->ClearData($_GET['lang']);
	$_SESSION['lang'] = $lang;
}
else{
	if ($_SESSION['lang']){
		$lang = $_SESSION['lang'];
	}
	else {
		$lang = 'lang1';
	}
}

$link = $_REQUEST['page'];

$title = $site[$lang]['name'].' - ';
$header = $site[$lang]['header'];
$footer = $site[$lang]['footer'];

$word = $db->WordsTranslate($lang);

if (!$db->CheckPage($link)){
	// Системные страницы
	switch ($link){
		case 'login':
			$name = 'Авторизация';
			include ROOT_DIR.'/core/login.inc';
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		case 'register':
			$name = 'Регистрация';
			include ROOT_DIR.'/core/register.inc';
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		case 'user':
			$name = 'О пользователе';
			include ROOT_DIR.'/core/user_info.inc';
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		case 'gallery':
			include ROOT_DIR.'/core/gallery.inc';
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		case 'news':
			include ROOT_DIR.'/core/news.inc';
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		default:
			$form = 'Такой страницы не существует!';
			include ROOT_DIR.'/core/html_templates/404.php';
		break;
	}
}
else{
	// Пользовательские страницы
	$name = $db->ReadPageName($link,$lang);
	switch ($link){
		case '':
			include ROOT_DIR.'/core/news.inc';
			include ROOT_DIR.'/core/html_templates/main_page_html.php';
		break;
		case 'gallery':
			include ROOT_DIR.'/core/gallery.inc';
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		case 'news':
			include ROOT_DIR.'/core/news.inc';
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		default:
			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
	}
}
?>