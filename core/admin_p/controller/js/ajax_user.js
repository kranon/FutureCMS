$(document).ready(function(){
	// Обновление контента
	function getCon(){
		// Получение JSON от сервера
		$.getJSON('controller/users_get.php',getContent);
		function getContent(data){
			var text = '';
			var users_count = 0;
			$.each(data, function(adata){
				// table
				text+='<tr><td>'+this.id+'</td><td><a href="?content=user_edit&login='+this.login+'">'+this.login+'</a></td><td>'+this.email+'</td><td>'+this.datreg+'</td><td>'+this.group+'</td><td><a href="controller/user_del.php?id='+this.id+'" class="del"><i class="icon-trash"></i></td></tr>';

				// div
				//text +='<div class="user"><div class="user_foto"><img src="/avatars/'+this.ava+'" class="img-polaroid img-rounded"></div><div class="data"><b>ID:</b> '+this.id+'<br /><b>Логин:</b> <a href="?content=user_edit&login='+this.login+'">'+this.login+'</a><br /><b>E-mail:</b> '+this.email+'<br /><b>Дата регистрации:</b> '+this.datreg+'<br /></div><div class="user_del_but_kran"><a href="controller/user_del.php?id='+this.id+'" class="del"><i class="icon-trash"></i></a></div></div>';

				users_count++;
				});
			$('#users').html(text);
			$('#users_count').html('Всего пользователей: '+users_count);
		}
	}
	getCon();
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer == '1'){
				getCon();
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show();//.fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show();//.fadeOut(5000);
			}
	}
	// Сохранение группы пользователя при выборе из списка
	$(document).on('change', 'select[]', function(){
		var data2=$('#user_inf').serialize();
		$.post('controller/users_set.php',data2);
	});

	// Сгенерировать новый пароль
	$(document).on('click','.gen',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('controller/genNewPass.php',querystr,rep);
		function rep (mess){
			report(mess,'Пароль сгенерирован и отправлен!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});

	// Удаление пользователя
	$(document).on('click','.del',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('controller/users_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Пользователь удалён!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
	// Добавление нового пользователя
	$('#AddUser').click(function(evt){
		var newUser=$('#reg_form').serialize();
		$.post('controller/users_add.php',newUser,rep);
		function rep(mess){
			report(mess,'Пользователь добавлен!');
		}
		evt.preventDefault();
	});
});