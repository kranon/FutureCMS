<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<title><?php echo $title.$name;?></title>
	<meta name="title" content="<?php echo $meta[$lang]['title'];?>" />
	<meta name="keywords" content="<?php echo $meta[$lang]['keywords'].', '.$name;?>" />
	<meta name="description" content="<?php echo $meta[$lang]['description'];?>" />
	<link rel="stylesheet" type="text/css" href="/design/style.css">
	<link rel="stylesheet" type="text/css" href="/design/droppy.css">
	<link rel="stylesheet" type="text/css" href="/design/fancybox/jquery.fancybox.css">
	<?php echo $style;?>
	<script type="text/javascript" src="/core/js/jquery.js"></script>
	<script type="text/javascript" src="/design/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/design/scripts.js" type="text/javascript"></script>
	<?php echo $script;?>
</head>
<body class="body">
	<table width="698"  cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td colspan="2" class="td_top">
				<div id="lang">
					<a href="?lang=lang1"><img src="/design/by.png" border="0"></a>
					<a href="?lang=lang2"><img src="/design/ru.gif" border="0"></a>
				</div>
				<div id="link_l"></div>
				<script type="text/javascript">insertSwf('/design/animkaru.swf',698,178);</script>
			</td>
		</tr>
		<tr>
			<td class="kol_lewa">
				<table width="167" align="center" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<div id="nav">
								<?php $db->menuRead($lang);?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="td_news"></td>
					</tr>
				</table>
			</td>
			<td class="kol_prawa">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<h1><?php echo $name;?></h1>
						</td>
					</tr>
					<tr>
						<td class="text">
							<?php echo $db->TextRead($link, $lang, $_SESSION['group']);
							echo $form;?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><img src="/design/dol.gif" /></td>
		</tr>
		<tr>
			<td colspan="2" class="menu_bot">
				<img src="/design/iko_mb.gif" align="absmiddle" />
				<a href="/" class="granat"><?php echo $word[25];?></a>
				<img src="/design/iko_mb.gif" align="absmiddle" />
				<a href="/login/" class="granat"><?php echo $word[27];?></a>
				<img src="/design/iko_mb.gif" align="absmiddle" />
				<a href="#feedback_form" class="granat feedback"><?php echo $word[28];?></a>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="td_copy">
				<div id="copy">
					<?=$footer;?>
				</div>
				<div id="develop">
					Разработка: <a href="http://sobko.by/" target="_blink">Andrey Sobko</a>
				</div>
			</td>
		</tr>
	</table>

	<div style="display:none">
		<form id="feedback_form" method="post" action="#">
			<p><h2>Оставить сообщение</h2></p><br />
			<input type="text" id="name" name="name" placeholder="Введите ваше имя"><br />
			<input type="text" id="email" name="email" placeholder="Введите E-mail"><br />
			<textarea id="message" name="message" placeholder="Текст сообщения" rows="7" cols="26"></textarea><br /><br />

			<input type="submit" value="Отправить" />
		</form>
	</div>

</body>
</html>
