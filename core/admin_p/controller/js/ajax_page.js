$(document).ready(function(){
	// Обновление контента
	function getCon(){
		$.getJSON('controller/page_get.php',getContent);
		function getContent(data){
			var text='';
			var pub='';
			var in_menu='';
			var i=1;
			$.each(data, function(adata){
				if (this.in_menu==1){
					in_menu='checked="checked"';
				}
				else{
					in_menu='';
				}
				if (this.group==1){
					text+='<tr><td>'+i+'</td><td><a href="index.php?content=page_edit&id='+this.id+'">'+this.lang1+'</a></td><td>'+this.link+'</td><td class="al_center"><input type="checkbox" name="menu_'+this.id+'" value="1" '+in_menu+'/></td><td>'+this.edit_date+'</td><td class="al_center"><a href="controller/page_del.php?id='+this.id+'" class="del"><i class="icon-trash"></i></a></td></tr>';
				}
				else{
					text+='<tr><td>'+i+'</td><td><a href="index.php?content=page_edit&id='+this.id+'">'+this.lang1+'</a></td><td>'+this.link+'</td><td>'+this.edit_date+'</td></tr>';
				}
				i++;
			});
			$('#tbody').html(text);
		}
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer=='1'){
				getCon();
				$('#mess').html('<b>'+message+'</b>').hide().show().fadeOut(6500);
			}
			else{
				$('#mess').html('<b>'+answer+'</b>').hide().show().fadeOut(5000);
			}
	}
	getCon();
	// При нажатии на checkbox сохраняется его значение ("Опубликовать", "В меню")
	$('#page_pub :checkbox').live('click',function(){
		var data2=$('#page_pub').serialize();
		$.post('controller/page_set.php',data2,rep);
		function rep (mess){
			report(mess,'Сохранено!');
		}
	});
	// Удаление страницы
	$('.del').live('click',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		$.get('controller/page_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Страница удалена!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
	// Добавление новой страницы
	$('#add_page_sub').click(function(evt){
		var newPage=$('#add_page').serialize();
		$.post('controller/page_add.php',newPage,rep);
		function rep(mess){
			report(mess,'Страница создана!');
		}
		evt.preventDefault();
	});
});
