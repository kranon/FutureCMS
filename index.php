<?php session_start();

ini_set('display_errors', 0);

define('ROOT_DIR', getcwd());

include ROOT_DIR."/core/config.php";

if (isset($_GET['lang'])){
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
$link = false;
if (isset($_REQUEST['page'])){
	$link = $_REQUEST['page'];
}


if (!$link){
	$link = '/';
}

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

		default:
			$form = 'Такой страницы не существует!';
			include ROOT_DIR.'/core/html_templates/404.php';
		break;
	}
}
else{
	// Пользовательские страницы
	$name = $db->ReadPageName($link, $lang);
	$page_id = $db->GetPageIDbyLink($link);
	$access = $db->GetPageAccess($page_id);

	if ($db->CheckPageAccess($_SESSION['group'], $access)){
		switch ($link){
			case '/':
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
	else{
		$form = 'У вас нет доступа для просмотра этой страницы!';
		include ROOT_DIR.'/core/login.inc';
		include ROOT_DIR.'/core/html_templates/other_page_html.php';
	}
}
?>