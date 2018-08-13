<?php
// Объявляем пути
define('CORE_DIR', __DIR__.'/');
define('ROOT_DIR', __DIR__ . '/../');
define('DATA_DIR', ROOT_DIR . 'data/');
define('APP_DIR', ROOT_DIR . 'app/');

// Подключаем конфиг
include_once APP_DIR . 'config/config.php';

// Инициализируем список системных путей
$SYSTEM_PATHS = [CORE_DIR, CORE_DIR.'models/', APP_DIR.'controllers/', APP_DIR.'models/'];
if(defined('CNF_REGISTER_PATHS') && is_array(CNF_REGISTER_PATHS))
{
	$SYSTEM_PATHS = array_merge($SYSTEM_PATHS, CNF_REGISTER_PATHS);
}
define('SYSTEM_PATHS', $SYSTEM_PATHS);

// Выставляем базовые настройки
error_reporting(CNF_ERROR_REPORTING);
ini_set('session.gc_maxlifetime', CNF_SESSION_MAX_LIFE_TIME);
session_set_cookie_params(CNF_SESSION_MAX_LIFE_TIME);

// Подключаем файлы ядра
include_once CORE_DIR.'Common.php';
include_once CORE_DIR.'Benchmark.php';
include_once CORE_DIR.'Model.php';
include_once CORE_DIR.'Controller.php';
include_once CORE_DIR.'Route.php';

// Подключаем доп. файлы
include_files(CNF_INCLUDE_FILES);

// Запускаем роутинг
Route::run();