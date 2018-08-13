<?php
// Версия приложения
define('VERSION', '0.0.1'); 
// Уровень отображения ошибок
define('CNF_ERROR_REPORTING', E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
// Время жизни сесиии
define('CNF_SESSION_MAX_LIFE_TIME', 86400);
// Профайлер
define('CNF_PROFILER', TRUE);

// Дополнительные пути для автозагрузчика классов
define('CNF_REGISTER_PATHS', [
	// empty
]);

// Файлы для автозагрузки
define('CNF_INCLUDE_FILES', [
	// empty
]);

// Локальный конфиг
include_once 'static.php';