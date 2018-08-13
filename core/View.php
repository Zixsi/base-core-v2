<?php

class View
{
	private $_template = 'index';
	public $_layout = 'index';
	private $_params = [];

	public function __construct(){}

	public function setLayout($name = 'index')
	{
		if(!empty($name))
		{
			$this->_layout = $name;
		}
	}

	public function render($template = 'index', $params = [])
	{
		$this->_template = $template;
		$this->_params = $params;
		echo $this->getRender($template, $params);
	}

	private function getRender($template = 'index', $params = [])
	{
		$this->_params = $params;
		$this->_template = $template;
		$layout = APP_DIR . 'view/' . $this->_layout . '.phtml';

		if(is_array($params) && !empty($params))
		{
			extract($params);
		}

		if(file_exists($layout))
		{
			ob_start();
			include_once $layout;
			return ob_get_clean();
		}

		return null;
	}

	protected function partitial($template, $params = [])
	{
		$layout = APP_DIR . 'view/'. $template . '.phtml';

		if(is_array($params) && !empty($params))
		{
			extract($params);
		}

		if(is_array($this->_params) && !empty($this->_params))
		{
			extract($this->_params);
		}

		if(is_file($layout))
		{
			ob_start();
			include_once $layout;
			echo ob_get_clean();
		}
	}

	protected function content()
	{
		$this->partitial($this->_template, $this->_params);
	}
}