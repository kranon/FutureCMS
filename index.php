<?php session_start();
include "core/config.php";

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
	$form = 'Такой страницы не существует!';
	include 'core/html_templates/404.php';
	
}
else{
	$name = $db->ReadPageName($link,$lang);
	switch ($link){
		case '':
			$form = $db->ReadNews('',$lang);
			include 'core/html_templates/main_page_html.php';
		break;
		case 'login':
			include "core/classes/auth.class.php";
			$style='<link rel="stylesheet" href="/design/form_err.css" type="text/css">';
			$script='<script type="text/javascript" src="/design/autorize_validate"></script>';
			if ($_SESSION['login']!=null){
				$form.='<br /><div id="ava" align="center">
					<a href="/O_polzovatele/?login='.$_SESSION['login'].'">
					<img src="'.$_SESSION['ava'].'" alt="avatar"/>
					</a><br />'.$_SESSION['login'].'<br />
					<a href="/core/logout.php">'.$word[4].'</a><br /><br />';
				if (($_SESSION['group']=='1')|($_SESSION['group']=='2')){
					$form.='<a href="/core/admin_p/">'.$word[3].'</a>';
				}
					$form.='</div>';
				}
			else{
				$form .= '<span id="error_message">'.$_SESSION['auth_error'].'</span><br />';
				$form .= Auth::ShowAuthForm($word).'<span><a href="Registratsiya.php">'.$word[2].'</a></span>';
				unset($_SESSION['auth_error']);
			}
			include 'core/html_templates/other_page_html.php';
		break;
		case 'register':
			include 'core/html_templates/other_page_html.php';
		break;
		case '':
			include 'core/html_templates/other_page_html.php';
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

			include 'core/html_templates/other_page_html.php';
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
			$id=(int)$_GET['id'];
			if (isset($id)){
				$result = mysql_query("SELECT `name_".$lang."`,`link` FROM `gallery` WHERE `id`=".$id);
				while ($row = mysql_fetch_array($result, MYSQL_BOTH)){
					$album=array(
						'name'=>$row['name_'.$lang],
						'link'=>$row['link']
					);
				}
			}
			$name = $album['name'];
			$mas = $db->OpenAlbum($id,'');
			if(isset($mas)){
				$form.='<a href="/gallery/">Назад</a><br />
					<div id="gallery"><ul>';
				foreach($mas as $fileName){
					$form.='<li><a href="/gallery/'.$album['link'].'/'.$fileName.'"><img src="/gallery/'.$album['link'].'/thumbs/'.$fileName.'"></a></li>';
				}   
				$form.='</ul></div><script type="text/javascript">$(\'#gallery a\').lightBox();</script>';
			}
			include 'core/html_templates/other_page_html.php';	
		break;
		case 'news':
			$news_id=$_GET['id'];

			if ($news_id==0){
				$form.=$db->ReadNews('',$lang);
			}
			else{
				$form.=$db->ReadNewsText($news_id,$lang);
				$form.=$error;
				$mas=$db->commentRead($news_id);
				echo '<pre>';
				print_r($mas);
				echo '</pre>';
				if (isset($mas)){
					$form.= '<p id="comm_title">Комментарии:</p>';
					foreach ($mas as $val){
						$form.= '<div class="comment">
							<div class="com_ava"><a href="/O_polzovatele/?login='.$val['users_login'].'"><img src="'.$val['users_ava'].'" /></a></div>
							<div class="com_name_date">
							<a href="/O_polzovatele/?login='.$val['users_login'].'">
							<span class="com_username">'.$val['users_login'].'</span>
							</a> | 
							<span class="com_date">'.$val['datetime'].'</span>
							</div>
							<span class="com_text">'.$val['text'].'</span>
							</div>';
					}
				}
				if ($_SESSION['login']==NULL){
					$form.= $word[20].' <a href="/login/">'.$word[1].'</a> '.$word[21].' <a href="/register/">'.$word[2].'</a>';
				}
				else{
					$sql="SELECT `id` FROM `users` WHERE `login`='".$_SESSION['login']."';";
					$res=$db->query($sql);
					while ($row = mysql_fetch_array($res, MYSQL_BOTH)){
						$curr_user_id=$row['id'];
					}
					$form.= '<div>
						'.$word[19].'<br />
						<form method="post" action="/core/commentAdd.php">
						<textarea rows="6" cols="60" name="comment_text" ></textarea><br />
						<input type="hidden" name="curr_user_id" value="'.$curr_user_id.'">
						<input type="hidden" name="news_id" value="'.$news_id.'">
						<input type="submit" value="'.$word[18].'">
						</form>
						</div>';
					}
			}

			include 'core/html_templates/other_page_html.php';	
		break;
		default:
			include 'core/html_templates/other_page_html.php';	
		break;
	}
}
?>