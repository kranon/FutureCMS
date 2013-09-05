$(document).ready(function(){
	// Обновление контента
	function getCon(){
		$.getJSON('controller/news_get.php',getContent);	// Получение JSON от сервера
		function getContent(data){
			var text = '';
			var i = 1;
			$.each(data, function(adata){
				text += '<tr><td class="al_center">&nbsp;'+i+'&nbsp;</td><td><a href="?content=news_edit&id='+this.id+'">'+this.caption_lang1+'</a></td><td>'+this.count+'</td><td>'+this.date+'</td><td class="al_center"><a href="controller/news_del.php?id='+this.id+'" title="удалить" class="del"><i class="icon-trash"></i></a></td></tr>';
				i++;
			});
			$('#tbody').html(text);
		}
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer == 1){
				getCon();
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getCon();
	// Удаление новости
	$(document).on('click','.del',function(){
		var link = $(this).attr('href');
		var querystr = link.slice(link.indexOf('?')+1);
		$.get('controller/news_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Новость удалена!');
		}
		return false;
		//evt.preventDefault();	// Отмена стандартного события
	});
		
	// Добавление новой новости
	$('#add_news_sub').click(function(){
		var newNews = $('#add_news').serialize();
		$.post('controller/news_add.php',newNews,rep);
		function rep(mess){
			report(mess,'Новость добавлена!');
		}
		return false;
		//evt.preventDefault();	// Отмена стандартного события
	});
});