<?php

class Route
{
	public static $controller = null;
	public static $action = null;

	public static function run()
	{
		self::parse();

		if(empty(self::$controller) || file_exists(APP_DIR . 'controllers/' . self::$controller . '.php') === false)
		{
			self::show404();
		}

		$kernel = get_instance();
		$controller = $kernel->{self::$controller};

		if(empty(self::$action) || method_exists($controller, self::$action) == false)
		{
			self::show404();
		}

		ob_start();
		$kernel->Benchmark->mark('total_execution_time_start');
		$controller->{self::$action}();
		$content = ob_get_contents();
		$kernel->Benchmark->mark('total_execution_time_end');
		ob_end_clean();

		if(CNF_PROFILER)
		{
			$content = preg_replace('|</body>.*?</html>|is', '', $content, -1, $count) . $kernel->Profiler->show();
			if($count > 0)
			{
				$content .= '</body></html>';
			}
		}

		echo $content;
	}

	public static function show404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		die();
		//header('Location:'.$host.'404');
	}

	private static function parse()
	{
		if(file_exists(APP_DIR . 'config/route.php'))
		{
			require_once APP_DIR . 'config/route.php';
		}

		$route['default'][0] = isset($route['default'][0])?$route['default'][0]:'index';
		$route['default'][1] = isset($route['default'][1])?$route['default'][1]:'index';

		self::$controller = isset($_GET['c'])?ucfirst($_GET['c']) . 'Controller':'IndexController';
		self::$action = isset($_GET['a'])?$_GET['a'] . 'Action':'indexAction';
	}
}