$(document).ready(function(){
	$('#autori').validate({
		rules:{
			login:{
				required: true,
				rangelength:[3,9]
			},
			pass:{
				required: true,
				rangelength:[5,16]
			}
		},
		messages: {
			login:{
				required: "Не введён логин",
				rangelength: "Логин должен быть не менее 3 и не более 9 символов"
			},
			pass:{
				required: "Не введён пароль",
				rangelength: "Пароль должен быть не менее 5 и не более 16 символов"
			}
		}
	});
});