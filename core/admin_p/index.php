<?php session_start();

$group = $_SESSION['group'];
if (($group == '1') || ($group == '2')){
	include '../config.php';
	$content = '';
	if (isset($_GET['content'])){
		$content = $_GET['content'];
	}
	$logout = '<i class="icon-user icon-white"></i> '.$_SESSION['login'].' <a href="../logout.php">Выход</a>';

	$title = $site['lang1']['name'].' - ';
	$footer = '<p>© 2010-'.date('Y').' Andrey Sobko E-mail: <a href="mailto:kranon@tut.by">kranon@tut.by</a><br />
		ver. '.$site['version'].'</p>';

	if ($group == '1'){
		$menu = '<li><a href="?content=pages">Страницы</a></li>
		<li><a href="?content=news">Новости</a></li>
		<li><a href="?content=menu">Меню</a></li>
		<li><a href="?content=users">Пользователи</a></li>
		<li><a href="?content=gallery">Галерея</a></li>
		<li><a href="?content=settings">Настройки</a></li>';
	}
	else{
		$menu = '<ul class="nav">
		<li><a href="?content=pages">Страницы</a></li>
		<li><a href="?content=news">Новости</a></li>
		</ul>';
	}
	switch ($content){
		case 'pages':
			$title .= 'Настройка страниц';
			$header = 'Страницы';
			break;
		case 'news':
			$title .= 'Настройка новостей';
			$header = 'Новости';
			break;
		case 'menu':
			$title .= 'Настройка меню';
			$header = 'Меню';
			break;
		case 'users':
			$title .= 'Настройка пользователей';
			$header = 'Список пользователей';
			break;
		case 'gallery':
			$title .= 'Настройка галереи';
			$header = 'Галерея';
			break;
		case 'album':
			$title .= 'Редактирование альбома';
			$header = 'Редактирование альбома';
			break;
		case 'settings':
			$title .= 'Настройки сайта';
			$header = 'Настройки';
			break;
		case 'page_edit':
			$title .= 'Редактирование страниц';
			$header = 'Редактирование страницы';
			$edit_link = '<a href="<?php echo $link;?> ">Посмотреть страницу</a>';
			break;
		case 'user_edit':
			$title .= 'Редактирование пользователя';
			$header = 'Редактирование пользователя:';
			break;
		case 'news_edit':
			$title .= 'Редактирование новостей';
			$header = 'Редактирование новости';
			break;
		case '':
			$title .= 'Главная';
			$header = 'Главная';
			break;
	}
	include 'templates/template.php';
}
else {
	header('Location: ../../');
	exit;
}
?>