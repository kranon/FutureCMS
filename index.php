<?php session_start();
define('ROOT_DIR', getcwd());

include ROOT_DIR."/core/config.php";

if ($_SESSION['lang'] == 'lang2'){
	$lang='lang2';
}
else {
	$lang='lang1';
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
		default:
			$form = 'Такой страницы не существует!';
			include ROOT_DIR.'/core/html_templates/404.php';
		break;
	}
}
else{
	$name = $db->ReadPageName($link,$lang);
	switch ($link){
		case '':
			include ROOT_DIR.'/core/news.inc';
			include ROOT_DIR.'/core/html_templates/main_page_html.php';
		break;
		case 'galery':
			$sort_word = array('lang1'=>'Абярыце год','lang2'=>'Выберите год');
			$all = array('lang1'=>'Усе','lang2'=>'Все');
			$year_sort = intval($_GET['year']);

			$years = $db->GetAllGalleryYear();

			foreach($years as $year){
				$str .='<a href="?year='.$year.'">'.$year.'</a>&nbsp;&nbsp;&nbsp; ';
			}

			$form .= $sort_word[$lang].': 
			<a href="/galery/">'.$all[$lang].'</a>&nbsp;&nbsp;&nbsp;'.$str;

			$form .= $db->GalleryRead($lang,$year_sort);

			include ROOT_DIR.'/core/html_templates/other_page_html.php';
		break;
		case 'album':
			$script='<script type="text/javascript" src="/core/lightBox/js/jquery.lightbox-0.5.min.js"></script>';
			$style='<link rel="stylesheet" type="text/css" href="/core/lightBox/css/jquery.lightbox-0.5.css" media="screen" />
				<style type="text/css">
				/* jQuery lightBox plugin - Gallery style */
				#gallery {
					background-color: #FFFFF0;
					padding: 10px;
					width: 400px;
				}
				#gallery ul{ list-style: none; }
				#gallery ul li { display: inline; }
				#gallery ul img {
					border: 5px solid #F7DD80;/*Цвет рамки вокру фото*/
					border-width: 5px 5px 5px;
					margin: 2px;
				}
				#gallery ul a:hover img {
					border: 5px solid #E69600;/*Цвет рамки вокру фото при наведении*/
					border-width: 5px 5px 5px;
					color: #fff;
				}
				#gallery ul a:hover { color: #fff; }
				#content a{ padding:0px 0px;}
				</style>';
			// проверить входные данные!!!!!
			$id = intval($_GET['id']);
			if (isset($id)){
				$result = mysql_query("SELECT `name_".$lang."`,`link` FROM `gallery` WHERE `id`=".$id);
				while ($row = mysql_fetch_array($result)){
					$album = array(
						'name' => $row['name_'.$lang],
						'link' => $row['link']
					);
				}
			}
			$name = $album['name'];
			$mas = $db->OpenAlbum($id,'');
			if(isset($mas)){
				$form .= '<a href="/gallery/">Назад</a><br />
					<div id="gallery"><ul>';
				foreach($mas as $fileName){
					$form .= '<li><a href="/gallery/'.$album['link'].'/'.$fileName.'"><img src="/gallery/'.$album['link'].'/thumbs/'.$fileName.'"></a></li>';
				}   
				$form .= '</ul></div><script type="text/javascript">$(\'#gallery a\').lightBox();</script>';
			}
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