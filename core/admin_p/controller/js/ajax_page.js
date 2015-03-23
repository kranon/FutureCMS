$(document).ready(function(){
	// Обновление контента
	function getCon(page){
		var count = 20;
		$.getJSON('controller/page_get.php?page='+page+'&count='+count, getContent);
		function getContent(data){
			var text = '';
			var pub = '';
			var in_menu = '';
			var i = (page - 1)*count;
			var pages_count = 0;
			$.each(data, function(adata){
				if (this.in_menu == 1){
					in_menu = 'checked="checked"';
				}
				else{
					in_menu = '';
				}

				if (this.group == 1 || this.pages_count){
					if (this.pages_count){
						pages_count = this.pages_count;
					}
					else{
						text += '<tr><td>'+i+'</td><td><a href="?content=page_edit&id='+this.id+'">'+this.lang1+'</a></td><td>'+this.link+'</td><td class="al_center"><input type="checkbox" page_id="'+this.id+'" name="menu_'+this.id+'" value="1" '+in_menu+'/></td><td>'+this.edit_date+'</td><td class="al_center"><a href="controller/page_del.php?id='+this.id+'" class="del"><i class="icon-trash"></i></a></td></tr>';
					}
				}
				else{
					text += '<tr><td>'+i+'</td><td><a href="?content=page_edit&id='+this.id+'">'+this.lang1+'</a></td><td>'+this.link+'</td><td>'+this.edit_date+'</td></tr>';
				}
				i++;
			});

			$('#tbody').html(text);
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
	// вывод результата действий при сохранений
	function report(answer,message){
		if (answer == '1'){
				getCon(1);
				$('#mess').html('<b>'+message+'</b>').hide().show().fadeOut(6500);
			}
			else{
				$('#mess').html('<b>'+answer+'</b>').hide().show().fadeOut(5000);
			}
	}
	getCon(1);

	$(document).on('click','.page',function(){
		var page = $(this).attr('page');
		getCon(page);

		return false;
	});

	// При нажатии на checkbox сохраняется его значение
	$(document).on('click','#page_pub :checkbox', function(){
		var page_id = $(this).attr('page_id');
		var in_menu = 0;

		if ($(this).prop("checked")){
			in_menu = 1;
		}

		$.ajax({
			type: "POST",
			url: "controller/page_set.php",
			data: {page_id:page_id, in_menu:in_menu},
			success: function(msg){
				report(msg, 'Сохранено!');
			}
		});
	});

	// Удаление страницы
	$(document).on('click','.del',function(){
		if (confirm("Вы действительно хотите удалить страницу?")){
			var link = $(this).attr('href');
			var querystr = link.slice(link.indexOf('?')+1);

			$.ajax({
				type: "GET",
				url: 'controller/page_del.php?'+querystr,
				success: function(msg){
					report(msg, 'Сохранено!');
				}
			});
		}

		return false;
	});
	// Добавление новой страницы
	$('#add_page_sub').click(function(){
		var newPage = $('#add_page').serialize();
		$.post('controller/page_add.php',newPage,rep);
		function rep(mess){
			report(mess,'Страница создана!');
		}
		return false;
	});
});