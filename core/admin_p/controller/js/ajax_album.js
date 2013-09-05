$(document).ready(function(){
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
			report(mess,'Сохранено!');
		}
	});

});