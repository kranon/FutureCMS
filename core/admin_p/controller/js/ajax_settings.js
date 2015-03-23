$(document).ready(function(){
	/*function getSettings(){
		// Получение JSON от сервера
		$.getJSON('controller/settings_get.php',getContent);
		function getContent(data){
			var site_name_lang1='';
			var site_header_lang1='';
			var site_footer_lang1='';

			var meta_title_lang1='';
			var meta_keywords_lang1='';
			var meta_description_lang1='';
			var meta_charset_lang1='';


			var site_name_lang2='';
			var site_header_lang2='';
			var site_footer_lang2='';

			var meta_title_lang2='';
			var meta_keywords_lang2='';
			var meta_description_lang2='';
			var meta_charset_lang2='';

			$.each(data, function(adata){
				if (this.id == 1){
					site_name_lang1 = this.siteName;
					site_header_lang1 = this.siteHeader;
					site_footer_lang1 = this.siteFooter;

					meta_title_lang1=this.metaTitle;
					meta_keywords_lang1=this.metaKeywords;
					meta_description_lang1=this.metaDescription;
					meta_charset_lang1=this.metaCharset;
				}
				else{
					site_name_lang2=this.siteName;
					site_header_lang2=this.siteHeader;
					site_footer_lang2=this.siteFooter;

					meta_title_lang2=this.metaTitle;
					meta_keywords_lang2=this.metaKeywords;
					meta_description_lang2=this.metaDescription;
					meta_charset_lang2=this.metaCharset;
				}
			});

			$('#site_name_lang1').val(site_name_lang1);
			$('#site_header_lang1').val(site_header_lang1);
			$('#site_footer_lang1').val(site_footer_lang1);

			$('#meta_title_lang1').val(meta_title_lang1);
			$('#meta_keywords_lang1').val(meta_keywords_lang1);
			$('#meta_description_lang1').val(meta_description_lang1);
			$('#meta_charset_lang1').val(meta_charset_lang1);


			$('#site_name_lang2').val(site_name_lang2);
			$('#site_header_lang2').val(site_header_lang2);
			$('#site_footer_lang2').val(site_footer_lang2);

			$('#meta_title_lang2').val(meta_title_lang2);
			$('#meta_keywords_lang2').val(meta_keywords_lang2);
			$('#meta_description_lang2').val(meta_description_lang2);
			$('#meta_charset_lang2').val(meta_charset_lang2);
		}
	}*/

	function GetRoles(){
		$.getJSON('controller/settings_get_role_list.php', function(data){
			var text = '';
			var del_link = '';
			$.each(data, function(adata){
				del_link = '';
				if (this.id != 1){
					del_link = '<a href="#"class="del" role_id="'+this.id+'"><i class="icon-trash"></i></a>';
				}
				text += '<tr><td>'+this.id+'</td><td><input type="text" value="'+this.lang1+'" name="'+this.id+'_lang1"></td><td><input type="text" value="'+this.lang2+'" name="'+this.id+'_lang2"></td><td>'+del_link+'</td></tr>';
			});
			$('#roles_list').html(text);
		});
	}

	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer == 1){
			$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
		}
		else{
			$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
		}
	}
	//getSettings();

	// Сохранение имени типа пользователя
	$(document).on('change', '#roles_list input', function(){
		var id = $(this).attr('role_id');
		var lang = $(this).attr('name');
		var value = $(this).val();

		$.ajax({
			type: "POST",
			url: "controller/settings_set_role.php",
			data: {id: id, lang: lang, value:value},
			success: function(msg){
				report(msg, 'Сохранено!');
			}
		});

		return false;
	});

	// При изменении text сохраняется его значение (настройки lang1)
	/*$(document).on('change', '#edit_settings_lang1 input[type="text"], textarea', function(){
		var data2 = $('#edit_settings_lang1').serialize();
		$.ajax({
			type: "POST",
			url: "controller/settings_set.php",
			data: data2,
			success: function(msg){
				report(msg, 'Сохранено!');
			}
		});
	});*/

	// При изменении text сохраняется его значение (настройки lang2)
	/*$(document).on('change', '#edit_settings_lang2 input[type="text"], textarea', function(){
		var data2 = $('#edit_settings_lang2').serialize();
		$.ajax({
			type: "POST",
			url: "controller/settings_set.php",
			data: data2,
			success: function(msg){
				report(msg, 'Сохранено!');
			}
		});
	});*/

	// Сохранение размера картинок для галереи
	$('#save_img_size').submit(function(){
		var data = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "controller/settings_save_img_size.php",
			data: data,
			success: function(msg){
				report(msg, 'Сохранено!');
			}
		});

		return false;
	});

	$('#feedback_emails').submit(function(){
		var data = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "controller/settings_save_emails.php",
			data: data,
			success: function(msg){
				report(msg, 'Сохранено!');
			}
		});

		return false;
	});

	// Добавление типа пользователя
	$('#add_role').submit(function(){
		var data = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "controller/settings_add_role.php",
			data: data,
			success: function(msg){
				if (msg == 1){
					$('#add_role')[0].reset();
				}
				report(msg, 'Сохранено!');
				GetRoles();
			}
		});

		return false;
	});

	// удаление типа пользователя
	$(document).on('click', '.del', function(){
		if (confirm("Вы действительно хотите этот тип пользователей?")){
			var id = $(this).attr('role_id');
			$.ajax({
				type: "POST",
				url: "controller/settings_del_role.php",
				data: {id: id},
				success: function(msg){
					report(msg, 'Удалено!');
					GetRoles();
				}
			});
		}

		return false;
	});
});