<?php
# Класс ошибок #
class error{
	private $error_lst = array(
	1 => '<span class="error">Пользователь с таким логином уже существует!</span>',
	2 => '<span class="error">Пользователь с таким E-mail уже существует!</span>',
	3 => '<span class="error">Введите корректный логин!</span>',
	4 => '<span class="error">Введите корректный пароль!</span>',
	5 => '<span class="error">Введите корректный E-mail!</span>',
	6 => '<span class="error">Невозможно загрузить файл аватарки!</span>',
	7 => '<span class="error">Неправильно введён логин или пароль!</span>'
	);

	public function getError($num){
		return $this->error_lst[$num];
	}
}
?>