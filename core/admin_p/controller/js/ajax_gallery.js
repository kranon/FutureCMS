$(document).ready(function(){
	function getGallery(){
		$.ajax({
			type: "POST",
			url: "controller/album_get.php",
			success: function(msg){
				//alert(msg);
				var text = '';
				var i = 1;
				if (msg){
					var album = jQuery.parseJSON(msg);
					$.each(album, function(){
						text += '<li class="ui-state-default" id='+this.id+'><div class="album_line well"><span class="gallery_name_lang1"><a href="?content=album&id='+this.id+'">'+this.name_lang1+'</a></span><div class="gallery_right"><span class="photo_count"><i class="icon-picture"></i> '+this.count+'</span><span class="gallery_date"><b>Дата создания:</b> '+this.date+'</span><span class="gallery_del"><a href="controller/album_del.php?id='+this.id+'" album_id="'+this.id+'" class="del"><i class="icon-trash"></i></a></span></div></div></li>';
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
							$.post('controller/album_sort.php?rep='+ser, rep);
							function rep(mess){
								report(mess,'Сохранено!');
							}
						}
						});
					});
				}
				else{
					$('#tbody_gallery').html('<ul id="sortable"><li><i class="icon-warning-sign"></i> Нет альбомов!</li></ul>');
				}
			}
		});
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
		var album_id = $(this).attr('album_id');
		if (confirm("Вы действительно хотите удалить альбом?")){
			$.ajax({
				type: "GET",
				url: "controller/album_del.php?id="+album_id,
				success: function(msg){
					report(msg,'Альбом удалён!');
				}
			});
		}

		return false;
	});

	// Добавление нового альбома
	$('#add_album_sub').click(function(evt){
		var newMenu = $('#add_album').serialize();
		$.post('controller/album_add.php',newMenu,rep);
		function rep(mess){
			report(mess,'Альбом добавлен!');
		}
		$('#add_album .in_text').val('');
		return false;
	});
});