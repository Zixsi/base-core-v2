<?php

// Автозагрузка классов
spl_autoload_register(function($class){
	foreach(SYSTEM_PATHS as $val)
	{
		$class = str_replace('Core\\', '', $class);
		$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

		//var_dump($val . $class . '.php');
		if(file_exists($val . $class . '.php'))
		{
			include_once $val . $class . '.php';
		}
	}
});

// Подключаем файлы
function include_files($list)
{
	if(is_array($list))
	{
		foreach($list as $file)
		{
			if(file_exists($file))
			{
				include_once($file);
			}
		}
	}
}

// Получить синглтон контроллера
function get_instance()
{
	return Controller::getInstance();
}

// Редирект
function redirect($url)
{
	header('Location: ' .  $url);
	exit;
}