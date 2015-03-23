<?php
$id = intval($_GET['id']);

if ($id > 0){
	$script = '
	<script type="text/javascript" src="/core/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript" src="/core/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="/core/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#gallery a").fancybox();
	});</script>';
	$style =
	'<link rel="stylesheet" href="/core/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="/design/lb_gallery.css"/>';

	$result = $db->query("SELECT `name_".$lang."`,`link` FROM `gallery` WHERE `id`=".$id);
	while ($row = $db->fetch_array($result)){
		$album = array(
			'name' => $row['name_'.$lang],
			'link' => $row['link']
		);
	}

	$name = $album['name'];
	$mas = $db->OpenAlbum($id);
	if(isset($mas)){
		$form .= '<a href="/gallery/">Назад</a><br />';
		$form .= '<div id="gallery">';
		foreach($mas as $photo){
			$form .= '<a rel="album" href="/gallery_img/'.$album['link'].'/'.$photo['link'].'"><img src="/gallery_img/'.$album['link'].'/thumbs/'.$photo['link'].'"></a>';
		}
		$form .= '</div>';
	}
}
else{
	$sort_word = array(
		'lang1' => 'Абярыце год',
		'lang2' => 'Выберите год'
	);
	$all = array(
		'lang1' => 'Усе',
		'lang2' => 'Все'
	);
	$year_sort = intval($_GET['year']);

	$years = $db->GetAllGalleryYear();

	foreach($years as $year){
		$str .='<a href="?year='.$year.'">'.$year.'</a>&nbsp;&nbsp;&nbsp; ';
	}

	$form .= $sort_word[$lang].':
	<a href="/gallery/">'.$all[$lang].'</a>&nbsp;&nbsp;&nbsp;'.$str;

	$form .= $db->GalleryRead($lang,$year_sort);
}
?>