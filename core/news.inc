<?php
$news_id = intval($_GET['id']);

if ($news_id <= 0){
	$form .= $db->ReadNews('', $lang);
}
else{
	$form .= $db->ReadNewsText($news_id, $lang);
	$form .= $error;

	// Добавление комментария к новости
	$userId = intval($_POST['curr_user_id']);
	$newsId = intval($_POST['news_id']);

	if (($userId > 0) && ($newsId > 0)){
		$comm_text = $db->clearData($_POST['comment_text']);
		if (isset($comm_text) && ($comm_text != '')){
			$db->commentAdd($newsId, $userId, $comm_text);
			header('Location: '.$_SERVER['HTTP_REFERER']);
			exit;
		}
	}

	$mas = $db->commentRead($news_id);
	if (isset($mas)){
		$form .= '<p id="comm_title">Комментарии:</p>';
		foreach ($mas as $val){
			$form .= '<div class="comment">
				<div class="com_ava"><a href="/user/'.$val['users_login'].'/"><img src="/avatars/'.$val['users_ava'].'" /></a></div>
				<div class="com_name_date">
				<a href="/user/'.$val['users_login'].'/">
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
		while ($row = $db->fetch_array($res)){
			$curr_user_id = $row['id'];
		}

		$form .= '<div>
			'.$word[19].'<br />
			<form method="post" action="">
			<textarea rows="6" cols="60" name="comment_text" ></textarea><br />
			<input type="hidden" name="curr_user_id" value="'.$curr_user_id.'">
			<input type="hidden" name="news_id" value="'.$news_id.'">
			<input type="submit" value="'.$word[18].'">
			</form>
			</div>';
		}
}
?>