<?php
//namespace controller;
class Validador
{

	public function validaEmail($email)
	{
		$conta = "/^[a-zA-Z0-9\._-]+@+";
		$dominio = "[a-zA-Z0-9\._-]+.+";
		$extensao = "([a-zA-Z]{2,3})$/";
		$padrao = $conta.$dominio.$extensao;
		//echo $padrao;
		if(!preg_match($padrao, $email))
			{
				return "Erro";
			}else{
				return $email;
			}
	}

	public function validaNome($nome)
		{

			$nome = preg_replace('#[=\"*@$%¨&()-+!\#/_,.,<>:;{}\[\]]#', '',$nome);
			return $nome;
		}

	public function validaContato($contato)
	{
		if(preg_match('/^\([0-9]{2}+\)+\s+[0-9]{4}+([\s-]{1})+([0-9]{4})$/', $contato))
		{
			return $contato;
		}else{
			return "Erro";
		}
	}
}

//'/^\([0-9]{2}+\)+\s+([0-9]{4})+\s|-+([0-9]{4})$/'
