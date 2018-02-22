<?php
namespace controller;
class UserController
{
	private $model;

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function show()
	{
		echo $this->model->getNome();
	}

	public function daoShow()
	{

		$dao = new UserDao();
		$query = $dao->showUser();

		foreach($query as $row)
		{
			var_dump($row);
		}
	}

	public function daoShowAsId()
	{
		$id = 1;
		$dao = new UserDao();
		$response = $dao->selectAsId($id);

		return $response;
	}

	public function insereDadosCtrl()
	{

		$dao = new UserDao();
		if($dao->insertUser($this->model))
		{
			echo "Ok";
		}
		else
		{
			echo "Erro";
		}


	}

}
