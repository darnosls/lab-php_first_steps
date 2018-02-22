<?php
namespace dao;
include_once 'Connect.php';
include_once 'CustomException.php';
class UserDao
{

	public $conf = 'config.ini';
	private $con = null;

	public function __construct()
	{
		$this->con = new Connect($this->conf);
	}

	public function showUser()
	{
		try
		{
			$query = $this->con->prepare('SELECT * FROM users');
			$query->execute();

			return $query;
		}
		catch(PDOException $e)
		{

			throw new MyDatabaseException( $e->getMessage( ) , (int)$e->getCode( ) );
			echo "Erro".$e;
		}

	}

	public function selectAsId($id)
	{
		try
		{
			$query = $this->con->prepare('SELECT * FROM user WHERE iduser = ?');
				$query->bindValue(1, $id);
				$query->execute();

				$results = $query->fetch(PDO::FETCH_ASSOC);

				return $results;

		}catch(PDOException $e)
		{

			return "Erro".$e;
		}


	}

	//inserção do dados
	public function insertUser($model)
	{

		$usrModel = $model;
			try{
				//1 - salvar os dados de usuário
				//nome - email - data do cadastro no site

				$this->con->beginTransaction();
				$query = $this->con->prepare("INSERT INTO users (name, email, initdate) VALUES (?, ?,now())");
				$query->bindValue(1, $usrModel->getNome() );
				$query->bindValue(2, $usrModel->getEmail() );

				$executa = $query->execute();
				//2 - recupera o id para salvar na tabela de relacionamento
				//usuario<-->contato
				$lastIdUser = $this->con->lastInsertId();
				if(!$executa){
					die("erro ao salvar usuario");
				}

				//3 - salva o contato
				//numero - tipo de contato
				$queryContact = $this->con->prepare("INSERT INTO contacts (numbercontact, type) VALUES (?, ?");
				$queryContact->bindValue(1, $usrModel->getNumber() );
				$queryContact->bindValue(2, (int)$usrModel->getType() );

				$executaContact = $queryContact->execute();
				if(!$executaContact){
					die("erro ao salvar contato");
				}


				//4 - novamente recupera o id para salvar na tabela de relacionamento
				//usuario<-->contato

				//5 - salva o relacionamento usuario<-->contato
				//id usuario - id contato

				//6 salva a mensagem
				//id usuario - mensagem


				$this->con = null;


			}catch ( PDOException $ex ){
				echo 'Erro: '.$ex->getMessage();
			}
		}

	}
