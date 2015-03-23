$(document).ready(function(){
	// Обновление контента
	function getCon(page){
		var count_p = 20;
		$.getJSON('controller/news_get.php?page='+page+'&count='+count_p, getContent);
		function getContent(data){
			var text = '';
			var pages_count = 0;
			var i = (page - 1)*count_p + 1;
			$.each(data, function(adata){
				if (this.pages_count){
					pages_count = this.pages_count;
				}
				else{
					text += '<tr><td class="al_center">&nbsp;'+i+'&nbsp;</td><td><a href="?content=news_edit&id='+this.id+'">'+this.caption_lang1+'</a></td><td>'+this.count+'</td><td>'+this.date2+'</td><td class="al_center"><a href="controller/news_del.php?id='+this.id+'" title="удалить" class="del"><i class="icon-trash"></i></a></td></tr>';
					i++;
				}
			});

			$('#tbody').html(text);
			if (pages_count > 1){
				var pg = '';
				var _class = '';
				for (var j = 1; j <= pages_count; j++){
					_class = '';
					if (page == j){
						_class = 'active btn-info';
					}
					pg += '<a class="page '+_class+'" page="'+j+'" href="#">'+j+'</a> ';
				}
				$('#paginator').html(pg);
			}
		}
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer == 1){
				getCon(1);
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getCon(1);

	$(document).on('click','.page',function(){
		var page = $(this).attr('page');
		getCon(page);
		return false;
	});

	// Удаление новости
	$(document).on('click','.del',function(){
		var link = $(this).attr('href');
		var querystr = link.slice(link.indexOf('?')+1);
		$.get('controller/news_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Новость удалена!');
		}
		return false;
	});

	// Добавление новой новости
	$('#add_news_sub').click(function(){
		var newNews = $('#add_news').serialize();
		$.post('controller/news_add.php',newNews,rep);
		function rep(mess){
			report(mess,'Новость добавлена!');
			$('#add_news input[name="caption"]').val('');
		}
		return false;
	});
});