<?php
namespace view;
class UserView
{
	private $model;
	private $controller;

	public function __construct($controller, $model)
	{
		$this->controller = $controller;
		$this->model = $model;
	}

	public function output()
	{
		return $this->controller->show();
	}
}
