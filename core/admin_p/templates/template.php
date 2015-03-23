<?php $group = $_SESSION['group'];?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?=$title;?></title>

		<link href="/core/admin_p/view/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/core/admin_p/view/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />

		<link href="/core/admin_p/view/bootstrap/css/docs.css" rel="stylesheet">
		<link href="/core/admin_p/view/bootstrap/css/prettify.css" rel="stylesheet">
		<link href="view/style.css" rel="stylesheet">

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
		<![endif]-->

	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="view/bootstrap/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		// Выделение активного элемента меню
		$(document).ready(function(){
			$('.nav li').each(function (){
				if (this.getElementsByTagName("a")[0].href == location.href){
					this.className = "active";
				}
			});
		});
	</script>
	</head>

	<body data-spy="scroll" data-target=".bs-docs-sidebar">

		<!-- Navbar
		================================================== -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="brand">
						<a href="/" target="_blank">
							<i class="icon-eye-open icon-white"></i> Посмотреть сайт
						</a>
						<div class="pull-right"><?php echo $logout;?></div>
					</div>

					<div class="nav-collapse collapse">
						<ul class="nav">
							<?php echo $menu;?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div id="mess" class="alert alert-success"></div>
				<legend><?php echo $header;?></legend>
			</div>
		</div>
		<?php
		switch($content){
// pages (all) ------------------------------------------------------------------------------
			case 'pages':?>
				<script type="text/javascript" src="controller/js/ajax_page.js"></script>
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form well form-inline" action="controller/page_add.php" name="add_page" id="add_page">
							<fieldset>
								<div class="span3">
									<input type="text" name="name" class="in_text" placeholder="Имя страницы">
								</div>
								<div class="span2">
								<label class="checkbox">
									<input type="checkbox" name="add_in_menu" /> Добавить в меню
								</label>
							</div>
							<div class="span3">
								<input type="submit" class="btn btn-success" id="add_page_sub" value="Создать страницу"/>
							</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<form class="form-inline" enctype="multipart/form-data" action="controller/page_pub.php" method="post" name="page_pub" id="page_pub">
							<table class="table table-striped table-bordered">
								<thead id="head">
									<th><b>№</b></th>
									<th><b>Название</b></th>
									<th><b>Ссылка</b></th>
									<?php if ($group==1){?>
										<th><b>В меню</b></th>
										<th><b>Изменено</b></th>
										<th><b>Удалить</b></th>
									<?php }
									else{
										echo '<th><b>Изменено</b></th>';
									}?>
								</thead>
								<tbody id="tbody"></tbody>
							</table>
							<div id="paginator"></div>
						</form>
					</div>
				</div>
			<?php break;
// news (all) ------------------------------------------------------------------------------
			case 'news':?>
				<script type="text/javascript" src="controller/js/ajax_news.js"></script>
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form well form-inline" action="controller/add_news.php" name="add_news" id="add_news">
							<input type="text" name="caption" class="in_text" placeholder="Заголовок новости">
							<input type="submit" class="btn btn-success" id="add_news_sub" value=" Добавить новость ">
						</form>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span12">
						<table class="table table-striped table-bordered">
							<thead>
								<th><b>№</b></th>
								<th><b>Название</b></th>
								<th><b>Комментариев</b></th>
								<th><b>Дата</b></th>
								<th><b>Удалить</b></th>
							</thead>
							<tbody id="tbody"></tbody>
						</table>
						<div id="paginator"></div>
					</div>
				</div>
			<?php break;
// menu (admin) ------------------------------------------------------------------------------
			case 'menu':
				if ($group == 1){?>
				<script type="text/javascript" src="controller/js/jquery-ui.js"></script>
				<script type="text/javascript" src="controller/js/ajax_menu.js"></script>
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form form-inline well" action="controller/menu_add.php" name="add_menu" id="add_menu">
							<fieldset>
								<input type="text" name="name" class="in_text" placeholder="Имя меню">
								<input type="text" name="link" class="in_text" placeholder="Ссылка">
								<input type="text" name="in" placeholder="Вложено в">
								<label class="checkbox">
									<input type="checkbox" name="publ">&nbsp;&nbsp;Опубликовать&nbsp;
								</label>
								<input type="submit" id="add_menu_sub" class="btn btn-success" value=" Добавить меню "/>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<form class="form-inline" action="controller/menu_set.php" method="post" name="menu_pub" id="menu_pub">
							<div id="tbody_menu"></div>
						</form>
					</div>
				</div>

			<?php
			}
			else{
				header('Location: index.php');
				exit;
			}
			break;
// users (admin) ------------------------------------------------------------------------------
			case 'users':
				if ($group == 1){?>
				<script type="text/javascript" src="controller/js/ajax_user.js"></script>
				<style>
					.user{
						position: relative;
						border:1px solid gray;
						border-radius: 5px;
						width: 500px;
						height: 118px;
						background-color: #F5F5F5;
						margin-bottom: 15px;
					}
					.user_foto{
						float:left;
						margin: 4px 10px 4px 4px;
					}
					.user_del_but_kran{
						border-radius: 10px;
						background: #F5F5F5;
						padding-left: 2px;
						position: relative;
						top:-88px;
						right:-10px;
						float: right;
						border:1px solid gray;
						width: 17px;
						height: 19px;
					}
					.user_del_but_kran:hover{
						background-color: red;
					}
					.fileinput-button {
						position: relative;
						overflow: hidden;
					}
					.fileinput-button input {
						position: absolute;
						top: 0px;
						right: 0px;
						margin: 0px;
						opacity: 0;
						font-size: 200px;
						direction: ltr;
						cursor: pointer;
					}
				</style>
				<div class="row-fluid">
					<div class="span8">
						<i class="icon-user"></i> <span id="users_count"></span><br /><br />
						<form class="form-inline" action="controller/user_save.php" method="post" name="user_inf" id="user_inf">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>ID</th>
										<th>Логин</th>
										<th>E-mail</th>
										<th>Дата регистрации</th>
										<th>Группа</th>
										<th>Удалить</th>
									</tr>
								</thead>
								<tbody id="users"></tbody>
							</table>

							<div id="paginator"></div>
						</form>
					</div>
					<div class="span4">
						<?php
						include '../classes/auth.class.php';
						$word = $db->WordsTranslate('lang2');
						?>
						<div id="register">
							<form class="form well" enctype="multipart/form-data" action="controller/users_add.php" method="post" name="reg_form" id="reg_form">
								<p><b>Регистрация нового пользователя:</b></p>
								<input type="text" name="login" id="login" placeholder="<?=$word[6]?>">
								<input type="password" name="pass" id="pass" placeholder="<?=$word[7]?>">
								<input type="password" name="retype_pass" id="retype_pass" placeholder="<?=$word[29]?>">
								<input type="text" name="email" id="email" placeholder="<?=$word[8]?>">

								<input type="text" name="name" id="name" placeholder="Введите имя">
								<input type="text" name="last_name" id="last_name" placeholder="Введите фамилию">
								<br />
								<b><?=$word[10]?></b><br />

								<label class="radio">
									<input type="radio" name="sex" checked="checked" value="men"/> <?=$word[11]?>
								</label>
								<label class="radio">
									<input type="radio" name="sex" value="women"/> <?=$word[12]?>
								</label>

								<p>
									<span class="btn btn-success fileinput-button span7">
										<span>Загрузить аватар</span>
										<input id="userfile" name="userfile" type="file">
									</span>
								</p>
								<input type="hidden" name="group" value="3" /><br /><br />

								<input type="submit" class="btn btn-success span7" id="AddUser" value="<?=$word[2]?>"/>
							</form>
						</div>
					</div>
				</div>
			<?php
			}
			else{
				echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
			}
			break;
// gallery (admin) ------------------------------------------------------------------------------
			case 'gallery':
				if ($group == 1){?>
				<script type="text/javascript" src="controller/js/jquery-ui.js"></script>
				<script type="text/javascript" src="controller/js/ajax_gallery.js"></script>
				<style type="text/css">
					.photo_count{
						margin-right: 25px;
					}
				</style>
				<div class="row-fluid">
					<div class="span7">
						<form class="form form-inline" action="controller/album_pub.php" method="post" name="gallery_ed">
							<div id="tbody_gallery"></div>
						</form>
					</div>
					<div class="span4">
						<form class="form well form-inline" method="post" action="controller/album_add.php" name="add_album" id="add_album">
							<input type="text" name="name" class="in_text" placeholder="Имя нового альбома">
							<input type="submit" class="btn btn-success" id="add_album_sub" value="Добавить альбом"/>
						</form>
					</div>
				</div>
			<?php
			}
			else{
				echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
			}
			break;
// settings (admin) ------------------------------------------------------------------------------
			case 'settings':
				if ($group == 1){?>
				<script type="text/javascript" src="controller/js/ajax_settings.js"></script>
				<style type="text/css">
					.role_div{
						margin-left: 0px;
					}
				</style>

				<div class="row-fluid">
					<div class="span5">
						<? $emails = $db->GetFeedbackEmails();?>
						<form action="#" class="form form-inline" id="feedback_emails" method="post">
							<legend>E-mail для формы обратной связи</legend>
							<span class="muted">Можно ввести несколько e-mail через запятую</span><br />
							<textarea name="emails" class="span12" rows="3"><?=$emails?></textarea><br /><br />
							<input type="submit" value="Сохранить" class="btn btn-success">
						</form>
					</div>

					<div class="span7">
						<? $size = $db->GetGalleryImgSize(); ?>
						<form action="#" class="form form-inline" id="save_img_size" method="post">
							<legend>Размер картинок для галереи</legend>
							<input type="text" name="width" class="span1" value="<?=$size['width']?>" placeholder="Ширина"> x
							<input type="text" name="height" class="span1" value="<?=$size['height']?>" placeholder="Высота"> px
							<input type="submit" value="Сохранить" class="btn btn-success">
						</form>
					</div>
				</div>

				<div class="row-fluid">
					<div class="span7">
						<legend>Типы пользователей</legend>
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="span1">ID</th>
									<th>Язык 1</th>
									<th>Язык 2</th>
									<th class="span1">Удалить</th>
								</tr>
							</thead>
							<tbody id="roles_list">
								<?
								$roles_lang1 = $db->GetRoles('lang1');
								$roles_lang2 = $db->GetRoles('lang2');

								foreach ($roles_lang1 as $id => $name) {?>
									<tr>
										<td><?=$id?></td>
										<td><input type="text" value="<?=$name?>" role_id="<?=$id?>" name="lang1"></td>
										<td><input type="text" value="<?=$roles_lang2[$id]?>" role_id="<?=$id?>" name="lang2"></td>
										<td>
											<?if ($id != 1):?>
												<a href="#" class="del" role_id="<?=$id?>"><i class="icon-trash"></i></a>
											<?endif;?>
										</td>
									</tr>
								<?}?>
							</tbody>
						</table>
					</div>
					<div class="span5">
						<legend>Добавить новый тип</legend>
						<form action="#" method="post" id="add_role">
							<label>Язык 1</label>
							<input type="text" name="lang1">
							<label>Язык 2</label>
							<input type="text" name="lang2">
							<label></label>
							<input type="submit" value="Добавить" class="btn btn-success">
						</form>
					</div>
				</div>
			<?php
			}
			else{
				echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
			}
			break;
// album (admin) ------------------------------------------------------------------------------
			case 'album':
				if ($group == 1){
					$album_id = intval($_GET['id']);
					if ($album_id > 0){
						$sql = "SELECT `name_lang1`,`name_lang2`,`link`,`album_year` FROM `gallery` WHERE `id`=".$album_id;
						$result = $db->query($sql);
						while($row = $db->fetch_array($result)){
							$album_data = array(
								'name_lang1' => $row['name_lang1'],
								'name_lang2' => $row['name_lang2'],
								'album_year' => $row['album_year'],
								'link' => $row['link']
							);
						}
					}?>
					<link rel="stylesheet" href="/core/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
					<script type="text/javascript" src="controller/js/jquery-ui.js"></script>
					<style type="text/css">
						.box{
							padding: 0px;
							width: 100%;
						}
						.box ul{
							list-style: none;
							margin: 0px;
						}
						.box ul img{
							border: 5px solid #fff;
						}
						.box ul a:hover img{
							border: 5px solid #0088CC;
							color: #fff;
						}
						.box ul a:hover{
							color: #fff;
						}
						.box{
							width:100px;
						}
						.table th{
							text-align: center;
						}
						.del{
							position: absolute;
							right: 5px;
							top: 5px;
						}
						li.well{
							position: relative;
						}
					</style>

					<script type="text/javascript" src="/core/admin_p/controller/js/ajax_album.js"></script>
					<script type="text/javascript" src="/core/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
					<script type="text/javascript" src="/core/fancybox/jquery.fancybox.pack.js"></script>

					<link rel="stylesheet" href="/core/admin_p/controller/fupload/css/jquery.fileupload.css">
					<script src="/core/admin_p/controller/fupload/js/load-image.all.min.js"></script>
					<script src="/core/admin_p/controller/fupload/js/vendor/jquery.ui.widget.js"></script>
					<script src="/core/admin_p/controller/fupload/js/jquery.iframe-transport.js"></script>
					<script src="/core/admin_p/controller/fupload/js/jquery.fileupload.js"></script>
					<script src="/core/admin_p/controller/fupload/js/jquery.fileupload-process.js"></script>
					<script src="/core/admin_p/controller/fupload/js/jquery.fileupload-image.js"></script>

					<script type="text/javascript">
						$(document).ready(function(){
							$('.box a').fancybox();
						});
					</script>
					<div class="row-fluid">
						<div class="span3 well">
							<p><b>Список альбомов:</b></p>
							<?php
							$sql = "SELECT `id`, `name_lang1` FROM `gallery` ORDER BY `num`";
							$result = $db->query($sql);
							while ($row = $db->fetch_array($result)) {
								echo '<a href="?content=album&id='.$row['id'].'"> - '.$row['name_lang1'].'</a><br />';
							}
							?>
						</div>

						<div class="span5">
							<style type="text/css">
								.image{
									display:inline;
								}
								#sortable{
									margin: 0px;
								}
							</style>

							<span style="display:none;" id="album_link" value="<?=$album_data['link']?>"></span>
							<span style="display:none;" id="album_id" value="<?=$album_id?>"></span>
							<div class="photo_content">
								<i class="icon-picture"></i> Всего фотографий: <span class="photo_count"></span>
								<br />
								<br />
								<div id="photo_list"></div>
							</div>
							<div class="messages"></div>
						</div>

						<div class="span4">
							<form class="well form" method="post" action="controller/album_set.php" name="edit_album" id="edit_album" class="form">
								<input class="span12" type="text" placeholder="Язык 1" name="name_lang1" value="<?php echo $album_data['name_lang1'];?>"><br />
								<input class="span12" type="text" placeholder="Язык 2" name="name_lang2" value="<?php echo $album_data['name_lang2'];?>"><br />
								<input class="span12" type="text" placeholder="Год альбома" name="album_year" value="<?php echo $album_data['album_year'];?>"><br />
								<input type="hidden" name="id" value="<?=$album_id;?>">
							</form>
							<div class="well">
								<span class="btn btn-success fileinput-button">
									<i class="glyphicon glyphicon-plus"></i>
									<span>Выберите файлы...</span>
									<input id="fileupload" type="file" name="files" multiple>
								</span>

								<br />
								<br />

								<div id="progress" class="progress progress-striped" style="display:none;">
									<div class="progress-bar bar-success bar"></div>
								</div>
								<p class="final" style="display:none;"></p>

								<div id="files" class="files"></div>

								<? $size = $db->GetGalleryImgSize();?>

								<script type="text/javascript">
									$(document).ready(function(){
										'use strict';
										var url = 'controller/foto_load.php?link=<?=$album_data["link"]?>&album_id=<?=$album_id?>';

										$('#fileupload').fileupload({
											url: url,
											disableImageResize: false,
											imageMaxWidth: <?=$size['width']?>,
											imageMaxHeight: <?=$size['height']?>,
											imageCrop: true,
											dataType: 'json',
											error: function(e, data){
												$('.final').show().html('Ошибка загрузки файлов');
											},
											progressall: function (e, data) {
												$('#progress').show();
												var progress = parseInt(data.loaded / data.total * 100, 10);
												$('#progress .progress-bar').css('width', progress + '%');
												if (progress == 100){
													getPhoto();
													setTimeout("$('#progress').hide();$('.final').show().html('Файлы успешно загружены!').fadeOut(2000);", 1000);
												}
											},
											success: function(e, data){
											}
										});
									});
								</script>
							</div>
						</div>
					</div>
				<?php
				}
				else{
					echo '<p><i class="icon-lock"></i> У вас нет доступа к этому разделу!</p>';
				}
			break;
// page_edit (all) ------------------------------------------------------------------------------
			case 'page_edit':
				$id = intval($_GET['id']);
				$page = $db->GetPageData($id);

				if ($page['link'] != '/'){
					$page_link = '/'.$page['link'].'/';
				}
				else{
					$page_link = $page['link'];
				}
				?>
				<script src="/ckeditor/ckeditor.js"></script>
				<div class="row-fluid">
					<div class="span12">
						<div id="show_link">
							<div>
								<a href="?content=pages"><b>Страницы</b></a>
								<span class="muted">
									<b>></b>
								</span>

								<a href="<?=$page_link?>" target="_blank"><b><?=$page['name']['lang1']?></b></a>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
						$('#tabSet a:first').tab('show');
						$('a[data-toggle="tab"]').on('shown', function (e) {
							e.target; // activated tab
							e.relatedTarget; // previous tab
						})
					});
				</script>

				<div class="row-fluid">
					<div class="span3 well">
						<p><b>Список страниц:</b></p>
						<?php
							$list = $db->GetPageList();
							foreach ($list as $key => $page_data) {
								echo '<a href="?content=page_edit&id='.$page_data['id'].'">- '.$page_data['lang1'].'</a><br />';
							}
						?>
					</div>
					<div class="span9">
						<form  method="post" name="about" id="about" action="controller/page_data_edit.php">
							<div id="edit_date">
								<b>Последнее изменение:</b> <span class="muted"><?=$page['edit_date']?></span>
							</div>

							<label for="name_lang1"><b>Доступ для:</b></label>

							<?
							$access = $db->GetPageAccess($id);

							$roles['all'] = 'Все';
							$roles = $roles + $db->GetRoles();
							?>
							<select name="access[]" multiple="multiple">
								<?
								foreach ($roles as $role_id => $name) {
									$selected = '';
									if (in_array($role_id, $access)){
										$selected = 'selected';
									}
									echo '<option '.$selected.' value="'.$role_id.'">'.$name.'</option>';
								}
								?>
							</select>
							<input class="span12" type="text" name="link" value="<?=$page['link']?>" placeholder="Адрес страницы">
							<br />
							<ul class="nav nav-tabs" id="tabSet">
								<li><a href="#lang1" data-toggle="tab">Язык 1</a></li>
								<li><a href="#lang2" data-toggle="tab">Язык 2</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane" id="lang1">
									<label for="name_lang1"><b>Имя страницы:</b></label>
									<textarea name="name_lang1" rows="2" class="span12"><?php echo $page['name']['lang1'];?></textarea><br /><br />

									<textarea name="editor_lang1" class="ckeditor" id="editor_lang1" rows="10" cols="80"><?=$page['text']['lang1']?></textarea>
									<input type="hidden" name="id" value="<?php echo $id;?>" />
								</div>
								<div class="tab-pane" id="lang2">
									<label for="name_lang2"><b>Имя страницы:</b></label>
									<textarea name="name_lang2" rows="2" class="span8"><?php echo $page['name']['lang2'];?></textarea><br /><br />
									<textarea name="editor_lang2" id="editor_lang2" class="ckeditor" rows="10" cols="80">
											<?=$page['text']['lang2']?>
									</textarea>
									<input type="hidden" name="id" value="<?php echo $id;?>" />
								</div>
							</div><br />
							<p><input type="submit" id="addText" class="btn btn-success" value="Сохранить" /></p>
						</form>
					</div>
				</div>
			<?php break;
// news_edit (all) ------------------------------------------------------------------------------
			case 'news_edit':
				$id = intval($_GET['id']);
				$news_data = array();
				$sql = "SELECT `caption_lang1`,`text_lang1`,`caption_lang2`,`text_lang2` FROM `news` WHERE `id` = ".$id.";";
				$result = $db->query($sql);
				while ($row = mysqli_fetch_array($result)){
					$news_data['text'] = array(
						'lang1' => $row['text_lang1'],
						'lang2' => $row['text_lang2']
					);
					$news_data['caption'] = array(
						'lang1' => $row['caption_lang1'],
						'lang2' => $row['caption_lang2']
					);
				}
				?>
				<script type="text/javascript">
					$(document).ready(function(){
						$('#tabSet a:first').tab('show');
						$('a[data-toggle="tab"]').on('shown', function (e) {
							e.target; // activated tab
							e.relatedTarget; // previous tab
						})
					});
				</script>
				<script src="/ckeditor/ckeditor.js"></script>
				<div class="row-fluid">
					<div class="span12">
						<div id="show_link">
							<?php echo '<div><a href="?content=news"><b>Новости</b></a> <span class="muted"><b>></b></span><a href="/news/'.$id.'/"><b>'.$news_data['caption']['lang1'].'</b></a>';?>
						</div>
					</div>
				</div><br />
				<div class="row-fluid">
					<div class="span3 well">
						<p><b>Список новостей:</b></p>
						<?php
							$sql = "SELECT `id`,`caption_lang1` FROM `news` ORDER BY `id` DESC";
							$result = $db->query($sql);
							while ($row = $db->fetch_array($result, MYSQL_BOTH)){
								echo '<a href="?content=news_edit&id='.$row['id'].'"> - '.$row['caption_lang1'].'</a><br />';
							}
						?>
					</div>
					<div class="span9">
						<ul class="nav nav-tabs" id="tabSet">
							<li><a href="#lang1" data-toggle="tab">Язык 1</a></li>
							<li><a href="#lang2" data-toggle="tab">Язык 2</a></li>
						</ul>
						<form method="post" name="about" id="about" action="controller/news_edit_data.php">
							<div class="tab-content">
								<div class="tab-pane" id="lang1">
									<p>Заголовок:</p>
									<textarea name="caption_lang1" rows="3" class="span12"><?php echo $news_data['caption']['lang1'];?></textarea><br /><br />

									<textarea name="editor_lang1" rows="3" class="ckeditor"><?php echo $news_data['text']['lang1'];?></textarea>

									<input type="hidden" name="id" value=<?php echo $id;?> />
								</div>
								<div class="tab-pane" id="lang2">
									<p>Заголовок:</p>
									<textarea name="caption_lang2" rows="3" class="span12"><?php echo $news_data['caption']['lang2']?></textarea><br /><br />
									<textarea name="editor_lang2" rows="3" class="ckeditor"><?php echo $news_data['text']['lang2'];?></textarea>

									<input type="hidden" name="id" value=<?php echo $id;?> />
								</div>
							</div><br />
							<p><input class="btn btn-success" type="submit" id="addText" value="Сохранить" /></p>
						</form>
						<?php
						$mas = $db->commentRead($id);
						if (count($mas)){
							echo '<p><i class="icon-comment"></i> <b>Комментарии:</b></p>';
						}

						if (isset($mas)){
							foreach ($mas as $val){?>
								<div class="comment span11">
									<div class="com_ava">
										<a href="O_polzovatele.php?login=<?php echo $val['users_login'];?>"><img src="/avatars/<?php echo $val['users_ava'];?>" /></a>
									</div>
									<div class="com_name_date">
										<a href="/user/<?php echo $val['users_login'];?>/">
											<span class="com_username"><?php echo $val['users_login'];?></span>
										</a> |
										<span class="com_date"><?php echo $val['datetime'];?></span>
									</div>
									<span class="com_del">
										<a href="controller/news_comment_del.php?id=<?php echo $val['id'];?>" class="news_comment_del"><i class="icon-trash"></i></a>
									</span>
									<form class="form" action="controller/news_comment_edit.php" method="post">
										<span class="com_text span10">
											<textarea rows="4" class="span11" name="text"><?php echo $val['text'];?></textarea>
										</span>
										<input type="hidden" name="id" value="<?php echo $val['id'];?>"/>
										<input type="submit" class="btn btn-success comm_news_submit" value="OK"/>
									</form>
								</div>
							<?}?>
						<?}?>
					</div>
				</div>
			<?php break;
			case 'user_edit':
				$login = strip_tags($_GET['login']);
				$sql = "SELECT `id`, `login`,`email`,`group`, `sex`,`datreg`,`ava`, `active`, `name`, `last_name` FROM `users` WHERE `login`= '$login'";
				$result = $db->query($sql);
				while ($row = $db->fetch_array($result)){
					$user = $row;
				}

				$rol = $db->GetRoles();
				foreach ($rol as $id => $name) {
					if ($id == $user['group']){
						$els[] = '<option selected="selected" value="'.$id.'">'.$name.'</option>';
					}
					else{
						$els[] = '<option value="'.$id.'">'.$name.'</option>';
					}
				}

				$els = implode('', $els);

				if ($user['active'] == 'Y'){
					$cheked = 'checked="checked"';
				}
				else{
					$cheked = '';
				}
				$active = '<input type="checkbox" name="active" '.$cheked.'>';
			?>
				<script type="text/javascript" src="controller/js/ajax_user.js"></script>
				<style type="text/css">
					.fileinput-button {
						position: relative;
						overflow: hidden;
					}
					.fileinput-button input {
						position: absolute;
						top: 0px;
						right: 0px;
						margin: 0px;
						opacity: 0;
						font-size: 200px;
						direction: ltr;
						cursor: pointer;
					}
				</style>
				<div class="row-fluid">
					<div class="span12">
						<div id="show_link">
							<div>
								<a href="?content=users"><b>Пользователи</b></a>
								<span class="muted">
									<b>></b>
								</span>
								<b>
									<?
										if ($user['name'] || $user['last_name']){
											echo $user['name'].' '.$user['last_name'];
										}
										else{
											echo $user['login'];
										}
									?>
								</b>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<form id="user_edit" action="controller/users_set.php" class="form" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?=$user['id']?>">
						<input type="hidden" name="login" value="<?=$user['login']?>">
						<div class="span2">
							<img src="/avatars/<?=$user['ava']?>" class="img-rounded img-polaroid avatar_img">

							<?if ($user['ava'] != 'default.png'):?>
								<p>
									<a class="del_ava" user_id="<?=$user['id']?>" href="#">Удалить аватар</a>
								</p>
							<?else:?>
								<br /><br />
							<?endif;?>

							<p>
								<span class="btn btn-success fileinput-button span12">
									<span>Загрузить аватар</span>
									<input id="ava" name="ava" type="file">
								</span>
							</p>
						</div>
						<div class="span6">
							<table class="table table-striped table-bordered">
								<tr>
									<td class="span3"><b>ID</b></td>
									<td><?=$user['id']?></td>
								</tr>
								<tr>
									<td><b>Активный</b></td>
									<td><?=$active?></td>
								</tr>
								<tr>
									<td><b>Имя</b></td>
									<td>
										<input type="text" name="name" value="<?=$user['name']?>">
									</td>
								</tr>
								<tr>
									<td><b>Фамилия</b></td>
									<td>
									<input type="text" name="last_name" value="<?=$user['last_name']?>">
									</td>
								</tr>
								<tr>
									<td><b>Логин</b></td>
									<td><?=$user['login']?></td>
								</tr>
								<tr>
									<td><b>E-mail</b></td>
									<td><?=$user['email']?></td>
								</tr>
								<tr>
									<td><b>Пол</b></td>
									<td>
										<label class="radio">
											<input type="radio" <?=$user['sex'] == 'men' ? 'checked="checked"' : ''?> name="sex" id="sex_men" value="men" checked>
											Мужской
										</label>
										<label class="radio">
											<input type="radio" <?=$user['sex'] != 'men' ? 'checked="checked"' :''?> name="sex" id="sex_women" value="women">
											Женский
										</label>
									</td>
								</tr>
								<tr>
									<td><b>Дата регистрации</b></td>
									<td><?=$user['datreg']?></td>
								</tr>
								<tr>
									<td><b>Группа</b></td>
									<td><select name="group"><?=$els?></select></td>
								</tr>
								<tr>
									<td><b>Сменить пароль</b></td>
									<td>
										<input type="password" name="pass" placeholder="Введите пароль"><br />
										<input type="password" name="sec_password" placeholder="Повторите пароль"><br />
										<a class="gen" href="controller/genNewPass.php?login=<?=$user['login']?>">Сгенерировать новый пароль автоматически</a>
									</td>
								</tr>
							</table>
							<input type="submit" class="btn btn-success" value="Сохранить">
						</div>
					</form>
				</div>

			<?break;
			default :?>
				<div class="row-fluid">
					<div class="span12">
						<p>Панель администратора позволяет добавлять, удалять и редактировать страницы, меню, информация о пользователях и многое другое.</p>
						<p>Для начала работы выберите необходимый пункт меню.</p>

						<p>По всем вопросам обращайтесь на E-mail: <a href="mailto:kranon@tut.by">kranon@tut.by</a></p>
					</div>
				</div>
			<?break;?>
			<?}?>
		</div>

	<!-- ========================= Footer ========================= -->
	<footer class="footer">
		<div class="container">
			<?php echo $footer;?>
		</div>
	</footer>
</body>
</html>