<?php
class ModelMessageContact
{
	private $idMessage;
	private $idUser;
	private $userName;
	private $numberContact;
	private $email;
	private $textMessage;


	public function getIdUser()
	{
		return $this->idUser;
	}
	public function setIdUser($idUser)
	{
		$this->idUser = $idUser;
	}

	public function getUserName()
	{
		return $this->userName;
	}
	public function setUserName($userName)
	{
		//fazer tratamento das variaveis para impedir entrada de
		//código malicioso
		$this->userName = strip_tags($userName);
	}

	public function getNumberContact()
	{
		return $this->numberContact;
	}
	public function setNumberContact($numberContact)
	{
		//fazer tratamento das variaveis para impedir entrada de
		//código malicioso
		$this->numberContact = strip_tags($numberContact);
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($email)
	{
		//fazer tratamento das variaveis para impedir entrada de
		//código malicioso
		$this->email = strip_tags($email);
	}

	public function getTextMessage()
	{
		return $this->textMessage;
	}
	public function setTextMessage($textMessage)
	{
		//fazer tratamento das variaveis para impedir entrada de
		//código malicioso
		$this->textMessage = strip_tags($textMessage);
	}




	public function createModel($arrayMessage)
	{
		//tratar os dados antes de montar a model
			/*echo "ModelMessageContact";
			echo "<pre>";
			print_r($arrayMessage);
			echo "</pre>";*/


			$this->setUserName($arrayMessage['name']);
			$this->setEmail($arrayMessage['email']);
			$this->setTextMessage($arrayMessage['text']);
		//$dao = new MessageDao();
		//$dao->saveMessage($arrayMessage);
	}
}
