<?php
include_once 'Connect.php';
//include_once 'CustomException.php';
class MessageDao
{

	public $conf = "dhl-restrict/config.ini";
	private $con = null;

	public function __construct()
	{
		$this->con = new Connect($this->conf);
		//habilita retorno de exceção
		$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}


	public function saveMessageUser($message)
	{
		$excp = null;
		$lastIdUser = null;
		$response = null;

		try
		{
				// 1 - salvar os dados da pessoa que enviou a mensagem
				//     esses dados serão salvos na tabela users, essa tabela
				//     é para uso geral, todos os usuários, independente de sua função
				//     ou atividade dentro do sistema terá seus dados básicos salvos nele
			  $queryUser = $this->con->prepare('INSERT INTO users (name,email,initdate) VALUES (:name,:email,:initdate)');
				$queryUser->bindValue(':name', $message->getUserName());
				$queryUser->bindValue(':email', $message->getEmail());
				$queryUser->bindValue(':initdate', date('Y-m-d H:i'));

				$response = "Novo usuario cadastrado: ".$queryUser->execute();
				// 2 - caso o usuário ainda não tenha seus dados na base de dados, e não
				//     tenha ocorrido nenhum erro na inserção o id do novo usuário será
				//     resgatado.

				$lastIdUser = $this->con->lastInsertId();
				$message->setIdUser($lastIdUser);
				$this->saveMessage($message);

		}
		catch(PDOException $e)
		{
			$response = intVal($e->getCode());
		}
		return $response;

	}

	//salva as mensgens enviadas do formulário da página de contato
	//esse método pode receber um id ou um email para fazer o cadastro da pessoa
	//que entrou em contato
	public function saveMessage($message)
	{
		$excp = null;
		$response = null;

		// 1 - verifica se o valor é um inteiro.
		//     essa situação ocorre quando o contato ainda não está cadastrado na base
		//     dados. O id é recuperado após a criação do usuário aproveitando o retorno
		//     do id.
		if(intVal($message->getIdUser()) > 0)
		{
				try
				{
					  $queryMessage = $this->con->prepare('INSERT INTO messages (iduser,textmessage) VALUES (:idUser,:textMessage)');
						$queryMessage->bindValue(':idUser',intVal($message->getIdUser()));
					  $queryMessage->bindValue(':textMessage', $message->getTextMessage());

						$response = $queryMessage->execute();
				}
				catch (Exception $e)
				{
					$response = "Exceção na menssage por id.<br />Resposta >>".$e;
				}
		}
		// 2 - para qualquer tipo de valor não inteiro a busca será realizada usando o
		//     email informado. Essa situação ocorre quando o sistema detecta que o contato já tem os
		//     dados pessoais cadastrado na base de dados.
		else
		{
				try
				{
					$selectUser = $this->con->prepare('SELECT * FROM users WHERE email = :email');
					$selectUser->bindValue(':email', $message->getEmail());
					$selectUser->execute();

					$result = $selectUser->fetchAll(PDO::FETCH_ASSOC);
					$queryMessage = $this->con->prepare('INSERT INTO messages (iduser,textmessage) VALUES (:idUser,:textMessage)');
					$queryMessage->bindValue(':idUser',intVal($result[0]['iduser']));
					$queryMessage->bindValue(':textMessage', $message->getTextMessage());

					$response = "Salvou mensagem: ".$queryMessage->execute();

				}
				catch (Exception $e)
				{
						$response = "Exceção na message por email: ".$e->getCode();
				}
		}
		return $response;
	}
}
