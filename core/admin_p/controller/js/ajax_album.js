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
					text += '<tr><td class="box"><a rel="foto" title="'+this+'" href="/gallery_img/'+album_link+'/'+this+'"><img src="/gallery_img/'+album_link+'/thumbs/'+this+'"></a></td><td align="center">'+this+'</td><td align="center"><a class="del" href="controller/foto_del.php?album='+album_link+'&name='+this+'"><i class="icon-trash"></i></a></td></tr>';

				});
				console.log(text);
				$('.photo_content').show();
				$('.messages').hide();
				$('#photo_list').html(text);
				$('.photo_count').html(photo_count);
			}
			else{
				$('.photo_content').hide();
				$('.messages').html('<i class="icon-warning-sign"></i> В альбоме нет фотографий').show();
			}
		}
	});
}

$(document).ready(function(){
	getPhoto();
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer == 1){
			$('#mess').html('<b>'+message+'</b>').show().fadeOut(2500);
		}
		else{
			$('#mess').html('<b>'+answer+'</b>').show().fadeOut(5000);
		}
	}

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
			var album_id = $(this).attr('album_id');
			var album_link = $(this).attr('album_link');
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