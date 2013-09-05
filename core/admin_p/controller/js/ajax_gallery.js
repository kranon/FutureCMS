$(document).ready(function(){
	function getGallery(){
		// Получение JSON от сервера
		$.getJSON('controller/album_get.php',getContent);
		function getContent(data){
			var text  = '';
			var i = 1;
			$.each(data, function(adata){
				text += '<li class="ui-state-default" id='+this.id+'><div class="album_line well"><span class="gallery_name_lang1"><a href="?content=album&id='+this.id+'">'+this.name_lang1+'</a></span><div class="gallery_right"><span class="gallery_date"><b>Дата создания:</b> '+this.date+'</span><span class="gallery_del"><a href="controller/album_del.php?id='+this.id+'" class="del"><i class="icon-trash"></i></a></span></div></div></li>';
				i++;
			});
			$('#tbody_gallery').html('<ul id="sortable">'+text+'</ul>');
			// drag and drop
			$(function(){
			  $("#sortable").sortable({
			    opacity: 0.7,
				axis: 'y',
				update: function(event, ui) {
					 var ser = $(this).sortable('toArray');
					 $.post('controller/album_sort.php?rep='+ser,rep);
						function rep(mess){
							report(mess,'Сохранено!');
						}
				}
				});
			});
		}
	}
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer == 1){
				getGallery();
				$('#mess').html('<b>&nbsp;'+message+'&nbsp;</b>').show().fadeOut(1500);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getGallery();

	// Удаление альбома
	$(document).on('click','.del',function(evt){
		var link = $(this).attr('href');
		var querystr = link.slice(link.indexOf('?')+1);
		$.get('controller/album_del.php',querystr,rep);
		function rep (mess){
			report(mess,'Альбом удалён!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});

	// Добавление нового альбома
	$('#add_album_sub').click(function(evt){
		var newMenu = $('#add_album').serialize();
		$.post('controller/album_add.php',newMenu,rep);
		function rep(mess){
			report(mess,'Альбом добавлен!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
});