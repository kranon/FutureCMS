$(document).ready(function(){
	function getMenu(){
		$.getJSON('controller/menu_get.php',getContent);	// Получение JSON от сервера
		function getContent(data){
			var text='';
			var pub='';
			var inm='';
			$.each(data, function(adata){
				if (this.published==1){pub='checked="checked"';}
				else{pub='';}
				text+='<li class="ui-state-default" id='+this.id+'><div class="line well"><div class="menu_id">'+this.id+'</div><span><input type="text" name="name_lang1_'+this.id+'" value="'+this.lang1+'"/></span><span><input type="text" name="name_lang2_'+this.id+'" value="'+this.lang2+'"/></span><span><input type="text" name="link_'+this.id+'" value="'+this.link+'"/></span><span class="in_menu"><input type="text" class="ed" name="in_'+this.id+'" value="'+this.in+'"></span><span class="publ"><input type="checkbox" name="'+this.id+'" value="1" '+pub+'/></span><span class="menu_del"><a href="controller/menuDel.php?id='+this.id+'" class="del" title="Удалить"><i class="icon-trash"></i></a></span></div></li>';
			});
			
			$('#tbody_menu').html('<div class="line_head well">'+
				'<span><b>ID</b></span>'+
				'<span id="name1"><b>Имя lang1</b></span>'+
				'<span id="name2"><b>Имя lang2</b></span>'+
				'<span id="link"><b>Ссылка</b></span>'+
				'<span id="in_menu"><b>Родитель</b></span>'+
				'<span id="publ"><b>Активно</b></span>'+
				'<span id="menu_del"><b>Удалить</b></span></div>'+
				'<ul id="sortable">'+text+'</ul>');
			
			// drag and drop
			$(function(){
			  $("#sortable").sortable({
			    opacity: 0.7,
				axis:'y',
				update: function(event, ui) {
					 var ser=$(this).sortable('toArray');
					 $.post('controller/menu_sort.php?rep='+ser,rep);
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
		if (answer==1){
				$('#mess').html(message).show().fadeOut(2000);
			}
			else{
				$('#mess').html('<b>&nbsp;'+answer+'&nbsp;</b>').show().fadeOut(5000);
			}
	}
	getMenu();
	// При изменении text сохраняется его значение ("Id", "Вложено в")
	$('#menu_pub :text').live('change',function(){
		var data2=$('#menu_pub').serialize();
		$.post('controller/menu_set.php',data2,rep);
		function rep(mess){
			report(mess,'Сохранено!');
		}
	});
		
	// При нажатии на checkbox сохраняется его значение ("Опубликовать")
	$('#menu_pub :checkbox').live('click',function(){
		var data2=$('#menu_pub').serialize();
		$.post('controller/menu_set.php',data2,rep);
		function rep(mess){
			report(mess,'Сохранено!');
		}
	});
	
	// Удаление меню
	$('.del').live('click',function(evt){
		var link=$(this).attr('href');
		var querystr=link.slice(link.indexOf('?')+1);
		if (confirm("Вы действительно хотите удалить это меню?")){
			$.get('controller/menu_del.php',querystr,rep);}
		else getMenu();	
		function rep (mess){
			getMenu();
			report(mess,'Меню удалено!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
	
	// Добавление нового меню
	$('#add_menu_sub').click(function(evt){
		var newMenu=$('#add_menu').serialize();
		$.post('controller/menu_add.php',newMenu,rep);
		function rep(mess){
			getMenu();
			report(mess,'Меню создано!');
		}
		evt.preventDefault();	// Отмена стандартного события
	});
});