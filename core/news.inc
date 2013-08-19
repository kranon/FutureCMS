<?
$news_id = intval($_GET['id']);

if ($news_id == 0){
	$form .= $db->ReadNews('',$lang);
}
else{
	$form .= $db->ReadNewsText($news_id,$lang);
	$form .= $error;
	$mas = $db->commentRead($news_id);
	/*echo '<pre>';
	print_r($mas);
	echo '</pre>';*/
	if (isset($mas)){
		$form .= '<p id="comm_title">Комментарии:</p>';
		foreach ($mas as $val){
			$form .= '<div class="comment">
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
	if ($_SESSION['login'] == NULL){
		$form .= $word[20].' <a href="/login/">'.$word[1].'</a> '.$word[21].' <a href="/register/">'.$word[2].'</a>';
	}
	else{
		$sql = "SELECT `id` FROM `users` WHERE `login`='".$_SESSION['login']."';";
		$res = $db->query($sql);
		while ($row = mysql_fetch_array($res)){
			$curr_user_id=$row['id'];
		}
		$form .= '<div>
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