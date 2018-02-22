<?php
class ContactModel
{
	private $idContact;
	private $number;
	private $type;


	public function __construct($number, $type)
	{

		$this->number = $number;
		$this->type = $type;
		$this->defineContato();
	}

	//função para validação do contato
	//
	public function defineContato()
	{
		if(preg_match('/^\([0-9]{2}+\)+\s+[0-9]{4}+([\s-]{1})+([0-9]{4})$/', $this->number))
		{
			return true;
		}else{
			return false;
		}
	}

	public function getNumber()
	{
		return $this->number;
	}
	public function getType()
	{
		return $this->type;
	}
}
