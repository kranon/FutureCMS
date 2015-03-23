<?php
# Класс 'base' предназначен для работы с БД MySQL #
class DataBase{
	private $host = '';
	private $user = '';
	private $pass = '';
	private $db_name = '';
	private static $connection;
	// Конструктор класса
	public function __construct($host = '', $user = '', $pass = '', $db_name = ''){
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db_name = $db_name;
		self::$connection = $this->connect();
		self::query("set names utf8");
	}

	// Подключение к базе данных
	public function connect(){
		$connection = mysqli_connect($this->host, $this->user, $this->pass, $this->db_name) or die("could not connect to DB");
		return $connection;
	}

	// Закрытие MySQl
	public function CloseDBConnection(){
		return mysqli_close(self::$connection);
	}

	public static function query($sql){
		$res = mysqli_query(self::$connection, $sql) or die(mysqli_error());
		return $res;
	}

	public function fetch_array($object){
		return mysqli_fetch_array($object, MYSQLI_ASSOC);
	}

	public function num_rows($object){
		return mysqli_num_rows($object);
	}

	// Очистка строк от "мусора"
	public static function ClearData($data){
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = trim($data);
		$data = mysqli_real_escape_string(self::$connection, $data);
		if ($data == ''){
			$data = null;
		}
		return $data;
	}

	public function GetRoles($lang = 'lang2'){
		if(self::$connection){
			$roles = array();
			$sql = "SELECT `id`, `$lang` FROM `role` ORDER BY `id` ASC;";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)){
				$roles[$row['id']] = $row[$lang];
			}
		}
		return $roles;
	}
	// Чтение списка новостей
	public function ReadNews($col = '',$lang){
		if(self::$connection){
			$sql = "SELECT	`id`,
							`caption_".$lang."`,
							`text_".$lang."`,
							DATE_FORMAT(date,'%d.%m.%Y') AS date
				FROM `news` ORDER BY `id` DESC;";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)){
				$sql2 = "SELECT COUNT(`id`) as count FROM `news_comments` WHERE `news_id`=".$row['id'];
				$res = self::query($sql2);
				while ($row2 = $this->fetch_array($res)){
					$count = $row2['count'];
				}

				$caption = $row['caption_'.$lang];
				$mor['lang1'] = 'Падрабязней';
				$mor['lang2'] = 'Подробней';
				$news .= '<div class="news">
				<a href="/news/'.$row['id'].'/"><h4 class="news_caption">'.$caption.'</h4></a>
				<span class="news_date">'.$row['date'].'</span>
				<span class="news_num_comments">Комментариев: '.$count.'</span>
				<span class="news_read"><a href="/news/'.$row['id'].'/">'.$mor[$lang].'</a></span><br />
				</div>';
			}
			return $news;
		}
	}
	// Добавление новости
	public function AddNews($caption){
		if(self::$connection){
			$sql = "INSERT INTO `news` (`caption_lang1` ,`date`)VALUES ('".$caption."', NOW());";
			self::query($sql);
		}
	}
	// Удаление новости
	public function DelNews($id){
		if(self::$connection){
			$sql = "DELETE FROM `news` WHERE `news`.`id` = ".$id;
			$result  = self::query($sql);
		}
	}
	// Изменение текста новости
	public function UpdateTextNews($news){
		if(self::$connection){
				$sql="UPDATE `news` SET
								`caption_lang1` = '".$news['caption']['lang1']."',
								`caption_lang2` = '".$news['caption']['lang2']."',
								`text_lang1`='".$news['text']['lang1']."',
								`text_lang2`='".$news['text']['lang2']."'
					WHERE `id` = ".$news['id'];
			self::query($sql);
		}
	}
	// Чтение текста новости
	public function ReadNewsText($id, $lang){
		if(self::$connection){
			$sql = "SELECT `text_".$lang."` FROM `news` WHERE `id`=".$id;
			$result = self::query($sql);
			if ($this->num_rows($result) > 0){
				while ($row = $this->fetch_array($result)){
					return $row['text_'.$lang];
				}
			}
			else{
				return 'Такой новости не существует!';
			}
		}
	}
	// Добавление комментария к новости
	public function commentAdd($newsId, $userId, $comment_text){
		if(self::$connection){
			$sql = "INSERT INTO `news_comments` (`text` ,`news_id` ,`users_id`, `datetime`)VALUES ('".$comment_text."','".$newsId."','".$userId."',NOW());";
			self::query($sql);
		}
	}
	// Добавление комментария к новости
	public function commentEdit($id,$text){
		if(self::$connection){
			$sql = "UPDATE `news_comments` SET `text` = '".$text."' WHERE `id`=".$id;
			self::query($sql);
		}
	}
	// Чтение комментариев к новости
	public function commentRead($newsId){
		if(self::$connection){
			$comment = array();
			$sql = "SELECT
						`news_comments`.`id`,
						`news_comments`.`text`,
						`news_comments`.`news_id`,
						`news_comments`.`users_id`,
						`news_comments`.`datetime`,
						`users`.`login`,
						`users`.`ava`
				FROM `news_comments`,`users`
				WHERE
					`news_comments`.`news_id`= $newsId
					AND
					`users`.`id`=`news_comments`.`users_id`;";

			$res = self::query($sql);
			while ($row = $this->fetch_array($res)){
				$comment[] = array(
					"id"			=> $row['id'],
					"text"			=> $row['text'],
					"news_id"		=> $row['news_id'],
					"users_login"	=> $row['login'],
					"users_ava"		=> $row['ava'],
					"datetime"		=> $row['datetime']
					);
			}
			return $comment;
		}
	}
	// Чтение меню из БД и вывод его на экран ввиде ссылок
	public function MenuRead($lang, $dir = ''){
		if(self::$connection){
			$sql = "SELECT `id`,`num`,`link`,`".$lang."`,`in` FROM `menu` WHERE `published`='1' ORDER BY `num`;";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)){
				$menu[$row['num']] = array(
					'id'	=> $row['id'],
					'in'	=> $row['in'],
					'name'	=> $row[$lang],
					'link'	=> $row['link']
				);
			}
			// TODO: перенести в шаблон
			foreach($menu as $val){
				if ($val['in'] == 0){
					echo '<li class="menu"><a href="'.$val['link'].'" class="granat">'.$val['name'].'</a>';
					echo '<ul>';
					foreach ($menu as $val2){
						if ($val2['in'] != 0){
							if ($val2['in'] == $val['id']){
								echo '<li><a href="'.$val2['link'].'">'.$val2['name'].'</a></li>';
							}
						}
					}
					echo '</ul></li>';
				}
			}
		}
	}
	//добавление меню в БД
	public function MenuAdd($menu){
		if(self::$connection){
			$sql = "SELECT `link` FROM `menu` WHERE `lang1`='".$menu['name']."'";
			$result = self::query($sql);
			if ($this->num_rows($result) == 0){
				$sql = "SELECT `num` FROM `menu` ORDER BY `num` DESC LIMIT 1";
				$result = self::query($sql);
				while ($row = $this->fetch_array($result)){
					$next_num = $row['num']+1;
				}

				$sql = "INSERT INTO `menu` (
									`num`,
									`lang1`,
									`link`,
									`published`,
									`in`)
					VALUES (
									".$next_num.",
									'".$menu['name']."',
									'".$menu['link']."',
									'".$menu['published']."',
									'".$menu['in']."')";
				if ($result = self::query($sql)){
					echo 'Меню создано';
				}
				else{
					echo 'Ошибка запроса создания меню';
				}
			}
			else{
				echo 'Такое меню уже существует!';
			}
		}
	}
	//удаление меню
	public function MenuDel($id){
		if(self::$connection){
			$sql = "DELETE FROM `menu` WHERE `id` = ".$id;
			self::query($sql);
		}
	}

	// Изменение имени меню (не задействовано!!!)
	public function MenuNameEd($id,$name){
		if(self::$connection){
			if (!$result = self::query("UPDATE `menu` SET `text` = '".$name."' WHERE `id` = '".$id."'")){
				echo 'Ошибка изменения имени меню';
			}
		}
	}

	public function GetPageData($id){
		if(self::$connection){
			$sql = "SELECT `lang1`,`lang2`,`text_lang1`,`text_lang2`,`link`, `edit_date` FROM `page` WHERE `id` = '".$id."'";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)) {
				$data['text'] = array(
					'lang1' => htmlspecialchars_decode($row['text_lang1'], ENT_QUOTES),
					'lang2' => htmlspecialchars_decode($row['text_lang2'], ENT_QUOTES)
				);
				$data['name'] = array(
					'lang1' => htmlspecialchars_decode($row['lang1'], ENT_QUOTES),
					'lang2' => htmlspecialchars_decode($row['lang2'], ENT_QUOTES)
				);
				$data['link'] = $row['link'];
				$data['edit_date'] = $row['edit_date'];
			}
			return $data;
		}
	}

	public function GetPageAccess($id){
		if(self::$connection){
			$sql = "SELECT `access` FROM `page` WHERE `id` = '".$id."';";
			$result = self::query($sql);
			if ($row = $this->fetch_array($result)) {
				$data = unserialize($row['access']);
			}
			return $data;
		}
	}

	public function CheckPageAccess($group_id, $access){
		if (in_array($group_id, $access) || in_array('all', $access)){
			return true;
		}
		else{
			return false;
		}
	}

	public function GetPageIDbyLink($link){
		if(self::$connection){
			$sql = "SELECT `id` FROM `page` WHERE `link` = '".$link."';";
			$result = self::query($sql);
			if ($row = $this->fetch_array($result)) {
				$id = $row['id'];
			}
			return $id;
		}
	}

	public function GetPageList(){
		if(self::$connection){
			$pages = array();
			$sql = "SELECT `id`, `lang1` FROM `page` ORDER BY `lang1` ASC;";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result, MYSQL_BOTH)) {
				$pages[] = $row;
			}
			return $pages;
		}
	}

	//удаление страницы
	public function PageDel($id){
		if(self::$connection){
			$result = self::query("DELETE FROM `page` WHERE `id` = ".$id);
		}
	}

	public function ReadPageName($PageLink,$lang){
		if(self::$connection){
			$sql = "SELECT `".$lang."` FROM `page` WHERE `link` = '".$PageLink."'";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)){
				$pageData = $row[$lang];
			}
			return $pageData;
		}
	}
	//Проверка на существование страницы
	public function CheckPage($PageLink){
		if(self::$connection){
			$sql = "SELECT `id` FROM `page` WHERE `link` = '".$PageLink."'";
			$result = self::query($sql);
			if($this->num_rows($result)){
				return true;
			}
			else{
				return false;
			}
		}
	}

	//чтение переведённых стандартных слов на сайте
	public function WordsTranslate($lang){
		if(self::$connection){
			$num = 1;
			$sql = "SELECT `".$lang."` FROM `language`";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)){
				$word[$num] = $row[$lang];
				$num++;
			}
			return $word;
		}
	}
	// добавление текста на страницу
	public function AddText($page){
		if(self::$connection){
			$sql = "UPDATE `page` SET
								`lang1`='".$page['name']['lang1']."',
								`lang2`='".$page['name']['lang2']."',
								`access` = '".serialize($page['access'])."',
								`text_lang1` = '".$page['text']['lang1']."',
								`text_lang2` = '".$page['text']['lang2']."',
								`link` = '".$page['link']."',
								`edit_date` = NOW()
					WHERE `id` = ".$page['id'];
			self::query($sql);
		}
	}

	// вывод текста на страницу
	public function TextRead($link, $lang, $user_group = false){
	   if(self::$connection){
	   		$text = '';
			$sql = "SELECT `text_$lang`, `access` FROM `page` WHERE `link` = '$link';";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)){
				// если указана группа пользователя, то проверяем доступ к странице
				$access = unserialize($row['access']);
				if ($user_group && $this->CheckPageAccess($user_group, $access)){
					$text = html_entity_decode($row['text_'.$lang]);
				}
				elseif($this->CheckPageAccess('all', $access)){
					$text = html_entity_decode($row['text_'.$lang]);
				}
			}
			mysqli_free_result($result);
			return $text;
		}
	}

	public function GetAllGalleryYear(){
		if(self::$connection){
			$sql = "SELECT `album_year` FROM `gallery` GROUP by `album_year` ORDER BY `album_year`";
			$result = $this->query($sql);
			while ($row = $this->fetch_array($result)){
				$year[$row['album_year']] = $row['album_year'];
			}
			return $year;
		}
	}

	public function GetGalleryImgSize(){
		if(self::$connection){
			$sql = "SELECT `gallery_img_width`, `gallery_img_height` FROM `settings`";
			$result = $this->query($sql);
			if ($row = $this->fetch_array($result)){
				$size = array(
					'width' => $row['gallery_img_width'],
					'height' => $row['gallery_img_height'],
				);
			}
			return $size;
		}
	}

	public function GetFeedbackEmails(){
		if(self::$connection){
			$email = false;
			$sql = "SELECT `feedback_emails` FROM `settings`";
			$result = $this->query($sql);
			if ($row = $this->fetch_array($result)){
				$emails = $row['feedback_emails'];
			}
			return $emails;
		}
	}

	// Чтение списка галерей
	public function GalleryRead($lang, $sort=''){
		if(self::$connection){
			$textNumFoto = array(
				'lang1' => 'Колькасць фотаздымкаў: ',
				'lang2' => 'Количество фотографий: '
			);
			$date_lang = array(
				'lang1' => 'Дата:',
				'lang2' => 'Дата:'
			);
			if (!$sort){
				$sql = "SELECT `id`,`name_".$lang."`,`link`,`date` FROM `gallery` ORDER BY `num`";
			}
			else{
				$sql = "SELECT `id`,`name_".$lang."`,`link`,`date` FROM `gallery` WHERE album_year='".$sort."' ORDER BY `num`";
			}
			$result = $this->query($sql);
			while ($row = $this->fetch_array($result)){
				$mas = $this->OpenAlbum($row['id']);
				$name = array(
					'lang1' => $row['name_lang1'],
					'lang2' => $row['name_lang2']
				);

				$num = count($mas);
				$gallery .= '<div class="album">
						<a href="/gallery/'.$row['id'].'/">';
							if ($mas[0]){
								$gallery .= '<img src="/gallery_img/'.$row['link'].'/thumbs/'.$mas[0]['link'].'">';
							}
							else{
								$gallery .= '<img src="/image/nopic.jpg">';
							}
				$gallery .= '</a>
						<a href="/gallery/'.$row['id'].'/" class="albumName">'.$name[$lang].'</a>
						<p class="numberFoto">'.$textNumFoto[$lang].$num.'</p>
						<p class="dateFoto">'.$date_lang[$lang].' '.$row['date'].'</p>
					</div>';
			}
			mysqli_free_result($result);
			return $gallery;
		}
	}
	// Получение списка фотографий в папке альбома
	public function OpenAlbum($id){
		if(self::$connection){
			$files = '';
			$sql = "SELECT `id`, `link`, `sort` FROM `gallery_img` WHERE `album_id` = $id ORDER BY `sort` ASC";
			$result = self::query($sql);
			while ($row = $this->fetch_array($result)){
				$files[] = $row;
			}
			return $files;
		}
	}
	// Удаление альбома
	public function AlbumDel($id){
		if(self::$connection){
			$sql = "DELETE FROM `gallery` WHERE `id` = ".$id;
			self::query($sql);
		}
	}
	// Функция транслитерации с русского на английский
	public function translitIt($str){
		$tr = array(
			"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
			"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
			"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
			"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
			"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
			"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
			"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
			"ў"=>"y","і"=>"i"," "=>"_","."=>"","/"=>"-",
			"'"=>"","\""=>"","\\"=>""
		);
		return strtr($str,$tr);
	}

	// Добавление нового пользователя
	public static function userAdd($login, $pass, $email, $name = '', $last_name = '', $ava = "default.png" ,$sex = 'men',$group = 3){
		$sql = "INSERT INTO `users` (
							`login`,
							`pass`,
							`email`,
							`ava`,
							`sex`,
							`name`,
							`last_name`,
							`datreg`,
							`group`)
					VALUES (
							'".$login."',
							'".$pass."',
							'".$email."',
							'".$ava."',
							'".$sex."',
							'".$name."',
							'".$last_name."',
							NOW(),
							'".$group."')";
		self::query($sql);
	}

	public static function userUpdate($data){
		$data2 = '';
		foreach ($data as $key => $value) {
			if ($key == 'id' || $key == 'user_id'){
				continue;
			}
			$data2[] = "`".$key."` = '".$value."'";
		}
		$data2 = implode(',', $data2);

		$sql = "UPDATE `users` SET ".$data2." WHERE `id` = ".$data['user_id'];
		self::query($sql);
	}

	// Удаление пользователя
	public function userDel($id){
		$id = intval($id);
		if(self::$connection && $id > 0){
			// удаление аватарки
			$result = self::query("SELECT `ava` FROM `users` WHERE `id` = '".$id."'");
			while ($row = $this->fetch_array($result)){
				if (!($row['ava'] == 'default.png')){
					$file_path = $_SERVER['DOCUMENT_ROOT'].'/avatars/'.$row['ava'];
					if (file_exists($file_path)){
						unlink($file_path);
					}
				}
			}
			// удаление пользователя из базы
			self::query("DELETE FROM `users` WHERE `id` = '".$id."'");
		}
	}
	// Изменение пароля пользователя
	public function EditPassword($login,$new_pass){
		if(self::$connection){
			$pass = sha1(sha1($pass).$login);
			$sql = "UPDATE `users` SET `pass`='".$pass."' WHERE `login` = '".$login."'";
			self::query($sql);
		}
	}
	// Добавление нового пользователя
	public function EditAvatar($login,$avatar){
		if(self::$connection){

			$sql = "UPDATE `users` SET `ava`='".$avatar."' WHERE `login` = '".$login."'";
			self::query($sql);
		}
	}
}
?>