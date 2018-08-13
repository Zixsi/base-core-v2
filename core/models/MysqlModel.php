<?php

class MysqlModel extends Model
{
	private $instance = null;
	private $connection = null;

	public function __construct()
	{
		$this->instance = MysqlConnection::getInstance();
		$this->connection = $this->instance->getConnection();
	}

	public function __call($method, $args)
	{
		return call_user_func_array(array($this->connection, $method), $args);
	}

	public function getAll($sql, $binds = [])
	{
		$stmt = $this->prepare($sql);
		$stmt->execute($binds);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getOne($sql, $binds = [])
	{
		$stmt = $this->prepare($sql);
		$stmt->execute($binds);
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function put($sql, $binds = [])
	{
		$stmt = $this->prepare($sql);
		$stmt->execute($binds);
		return $this->lastInsertId();
	}

	public function execute($sql, $binds = [])
	{
		$stmt = $this->prepare($sql);
		$stmt->execute($binds);
		return $stmt->rowCount();
	}
}

class MysqlConnection
{
	protected static $instance = null;
	private $connection = null;

	protected function __construct()
	{
		global $config;
		$this->connection = new PDO($config['mysql']['dsn'], $config['mysql']['user'], $config['mysql']['password']);
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->connection->exec('SET NAMES utf8');
	}

	protected function __clone() {}

	public static function getInstance()
	{
		if(!isset(static::$instance))
		{
			static::$instance = new static();
		}

		return static::$instance;
	}

	public function getConnection()
	{
		return $this->connection;
	}

	public function __get($a)
	{
		return $this->connection->$a;
	}
}