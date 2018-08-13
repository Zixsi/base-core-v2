<?php

class IndexController extends Controller
{

	public function __construct(){}

	public function indexAction()
	{
		$this->View->render('index/index', []);
	}
}