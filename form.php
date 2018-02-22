<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


include_once 'controller/LoadPages.php';
new LoadPages();

$usrModel = new UserModel();
$pgModel = new PagamentoModel();
$usrController = new UserController($usrModel);

$usrView = new UserView($usrController, $usrModel);

$validar = new Validador();


		$nome 		= $validar->validaNome($_POST['nome']);
		$telefone = addslashes($_POST['telefone']);
		$contato = new Contact($telefone,(int)7);
		$email = $validar->validaEmail($_POST['email']);
		$mensagem	= htmlspecialchars($_POST['mensagem']);


		if ($contato->defineContato())
		{
			//se a condição retornar vedadeiro
			//o contato é passado para o model
			echo "OK! ->".$contato->getNumber()."<br>";



			$usrModel->setNome(addslashes($nome));
			$usrModel->setEmail($email);
			$usrModel->setTelefone($contato);
			$usrModel->setMensagem($mensagem);
		}else{
			//se retornar falso o usuário é redirecionado ao formulário
			//trigger_error("O campo nome não foi informado.", E_USER_WARNING);
			//die("Erro fatal");
			echo "<br><br><br>Erro<br>";
			//dead('location:index.php');
		}




		//echo $usrController->daoShowAsId();
		//$usrController->insereDadosCtrl();
