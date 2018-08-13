<?php

class Controller
{
	private static $_instance = null;
	private static $_classes = [];

	private function __construct(){}
	private function __clone(){}

	public static function &getInstance()
	{
		if(isset(self::$_instance) == false)
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __get($class)
	{
		if(class_exists($class))
		{
			if(isset(self::$_classes[$class]) == false)
			{
				self::$_classes[$class] = new $class();
			}

			return self::$_classes[$class];
		}

		return null;
	}
}