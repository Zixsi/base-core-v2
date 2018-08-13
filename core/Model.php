<?php

class Model
{
	public function __get($key)
	{
		return get_instance()->$key;
	}
}