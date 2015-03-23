function getPhoto(){
	var album_ids = $('#album_id').attr('value');
	var album_link = $('#album_link').attr('value');

	$.ajax({
		type: "POST",
		url: 'controller/foto_get.php',
		data: {album_id: album_ids},
		success: function(msg){
			var text = '';
			if (msg){
				var photo = jQuery.parseJSON(msg);
				var photo_count = photo.length;
				$.each(photo, function(){
					text += '<li class="ui-state-default well" id="'+this.id+'"><div class="image box"><a rel="foto" title="'+this.link+'" href="/gallery_img/'+album_link+'/'+this.link+'"><img src="/gallery_img/'+album_link+'/thumbs/'+this.link+'" class=""></a></div> <span>'+this.link+'</span><a class="del" href="controller/foto_del.php?album='+album_link+'&name='+this.link+'&photo_id='+this.id+'"><i class="icon-trash"></i></a></li>';
				});

				$('.photo_content').show();
				$('.messages').hide();
				$('.photo_count').html(photo_count);

				$('#photo_list').html('<ul id="sortable">'+text+'</ul>');

				$(function(){
				  $("#sortable").sortable({
				    opacity: 0.7,
					axis: 'y',
					update: function(event, ui) {
						var ser = $(this).sortable('toArray');
						$.post('controller/foto_sort.php?sort='+ser, rep);
						function rep(mess){
							report(mess,'Сохранено!');
						}
					}
					});
				});
			}
			else{
				$('.photo_content').hide();
				$('.messages').html('<i class="icon-warning-sign"></i> В альбоме нет фотографий').show();
			}
		}
	});
}

// вывод результата действий при сохранений
	function report(answer, message){
		if (answer == 1){
			$('#mess').html('<b>'+message+'</b>').show().fadeOut(2500);
		}
		else{
			$('#mess').html('<b>'+answer+'</b>').show().fadeOut(5000);
		}
	}

$(document).ready(function(){
	getPhoto();

	// При изменении text сохраняется его значение
	$(document).on('change','#edit_album :text',function(){
		var data2 = $('#edit_album').serialize();
		$.post('controller/album_set.php',data2,rep);
		function rep(mess){
			report(mess, 'Сохранено!');
		}
	});

	$(document).on('click','.del',function(){
		if (confirm("Вы действительно хотите удалить эту фотографию?")){
			var href = $(this).attr('href');
			$.ajax({
				type: "GET",
				url: href,
				success: function(msg){
					getPhoto();
				}
			});
		}
		return false;
	});
});