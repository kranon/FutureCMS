$(document).ready(function(){
	function getCon(page){
		var count = 20;
		$.getJSON('controller/users_get.php?page='+page+'&count='+count,getContent);
		function getContent(data){
			var text = '';
			var users_count = 0;
			$.each(data, function(adata){
				if (this.pages_count || this.users_count){
					if (this.pages_count){
						pages_count = this.pages_count;
					}
					else{
						users_count = this.users_count;
					}
				}
				else{
					text+='<tr><td>'+this.id+'</td><td><a href="?content=user_edit&login='+this.login+'">'+this.login+'</a></td><td>'+this.email+'</td><td>'+this.datreg+'</td><td>'+this.group+'</td><td><a href="controller/user_del.php?id='+this.id+'" class="del"><i class="icon-trash"></i></td></tr>';
				}
			});

			$('#users').html(text);
			$('#users_count').html('Всего пользователей: '+users_count);

			if (pages_count > 1){
				var pg = '';
				var _class = '';
				for (var i = 1; i <= pages_count; i++){
					_class = '';
					if (page == i){
						_class = 'active btn-info';
					}
					pg += '<a class="page '+_class+'" page="'+i+'" href="#">'+i+'</a> ';
				}
				$('#paginator').html(pg);
			}
		}
	}
	getCon(1);

	$(document).on('click','.page',function(){
		var page = $(this).attr('page');
		getCon(page);

		return false;
	});

	// вывод результата действий при сохранений
	function report(answer, message, getContent){
		if (answer == '1'){
			if (getContent == 'Y'){
				getCon(1);
			}
			$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
		}
		else{
			$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show();//.fadeOut(5000);
		}
	}

	$(document).on('click','.del_ava',function(){
		var user_id = $(this).attr('user_id');
		$.ajax({
			type: "POST",
			url: "controller/users_del_ava.php",
			data: {"user_id": user_id},
			success: function(msg){
				$('.avatar_img').attr('src', '/avatars/default.png');
				report(msg, 'Аватар удалён!');
			}
		});
	});

	// Сгенерировать новый пароль
	$(document).on('click','.gen',function(evt){
		var link = $(this).attr('href');
		var querystr = link.slice(link.indexOf('?')+1);
		$.get('controller/genNewPass.php',querystr,rep);
		function rep (mess){
			report(mess,'Пароль сгенерирован и отправлен!');
		}
		return false;
	});

	// Удаление пользователя
	$(document).on('click','.del',function(evt){
		var link = $(this).attr('href');
		var querystr = link.slice(link.indexOf('?')+1);
		$.get('controller/users_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Пользователь удалён!', 'Y');
		}
		return false;
	});

	// Добавление нового пользователя ajax. Отключен, т.к. невозможно загрузить аву
	/*$('#AddUser').click(function(evt){
		var newUser = $('#reg_form').serialize();
		$.post('controller/users_add.php',newUser,rep);
		function rep(mess){
			report(mess,'Пользователь добавлен!', 'Y');
			if (mess == 1){
				$('#reg_form').trigger('reset');
			}
		}
		return false;
	});*/
});