<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<title><?php echo $title.$name;?></title>
	<script language="JavaScript" src="design/scripts.js" type="text/javascript"></script>
	<meta name="title" content="<?php echo $meta[$lang]['title'];?>" />
	<meta name="keywords" content="<?php echo $meta[$lang]['keywords'].', '.$name;?>" />
	<meta name="description" content="<?php echo $meta[$lang]['description'];?>" />
	<link rel="stylesheet" href="/design/style.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="/design/droppy.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="/design/fancybox/jquery.fancybox.css">
	<?php echo $style;?>
	<script type="text/javascript" src="/core/js/jquery.js"></script>
	<script type="text/javascript" src="/design/fancybox/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="/design/scripts.js" type="text/javascript"></script>
	<?php echo $script;?>
	<script type="text/javascript">
	/*var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-34514367-1']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();*/
</script>
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
			<script type="text/javascript">insertSwf('/design/animkaru.swf', 698, 178);</script>
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
					<td class="text">
						<?php echo $db->TextRead($link, $lang);
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
			<script type="text/javascript">mailer('beshion', 'mail.ru', ' class="granat"', '<?php echo $word[28];?>', '');</script>
		</td>
	</tr>
	<tr><td colspan="2" class="td_copy">
	<div id="copy">
		<?=$footer;?>
	</div>
	<div id="develop">
		Разработка: <a href="http://sobko.by/" target="_blink">Andrey Sobko</a>
	</div>
</td></tr>
</table>
</body>
</html>
