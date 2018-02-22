<?php
include_once 'Connect.php';
//include_once 'CustomException.php';
//contem as operações nescessárias para manipular os dados dos astigos
//acessa as tabelas
//->users
//->contents
//->articles
//->commentaries
//->categories
//->articlesforcategories

class ArticleDao
{
  public $conf = "dhl-restrict/config.ini";
	private $con = null;

	public function __construct()
	{
		$this->con = new Connect($this->conf);
	}

	public function showArticles()
	{
		try
		{
			$query = $this->con->prepare('SELECT c.name, a.idarticle, a.text FROM contents as c INNER JOIN articles as a ON c.idcontent = a.idcontent;');
			$query->execute();
			return $query;
		}
		catch(PDOException $e)
		{

			throw new MyDatabaseException( $e->getMessage( ) , (int)$e->getCode( ) );
			echo "Erro".$e;
		}

	}

	//faz a seleção das tabelas contents, articles e users
	//responsável por tazer os dados que formarão: titulo, data de postagem, nome do autor
	//e o texto, com essa query já é possível montar uma pagina básica
  public function selectArticlesAsID($idArticle)
  {
    try
		{
					$query = $this->con->prepare('SELECT c.name AS title, c.datepost, a.idarticle, a.text, u.name AS writeby
																				FROM contents AS c
																				INNER JOIN articles AS a ON c.idcontent = a.idcontent
																				INNER JOIN users AS u ON u.iduser = c.iduser
																				WHERE a.idarticle ='.$idArticle);
								$query->execute();
								return $query;
		}
		catch(PDOException $e)
		{
			throw new MyDatabaseException( $e->getMessage( ) , (int)$e->getCode( ) );
			echo "Erro".$e;
		}
  }

	//faz uma seleção nas tabelas commentaries, articles e users
	//deve retornar os comentarios de cada artigo, também deve buscar os autores de cada comentário
	public function selectComments($idarticle)
	{
		try
		{
			$query = $this->con->prepare(
				'SELECT a.idarticle, com.text AS comment FROM articles a
					INNER JOIN commentaries com ON a.idarticle = com.idarticle
				WHERE a.idcontent ='.$idarticle.';');
			$query->execute();
			return $query;
		}
		catch(PDOException $e)
		{
			throw new MyDatabaseException( $e->getMessage( ) , (int)$e->getCode( ) );
			echo "Erro".$e;
		}
	}

	//seleciona as categoriass em que cada artigo se inclui
	public function selectCategories($idarticle)
	{
		try
		{
			$query = $this->con->prepare(
				'SELECT name AS category FROM categoriesarticles AS cat
					INNER JOIN articlesforcategories AS a_c ON a_c.idcategoryarticle = cat.idcategoryarticle
				WHERE a_c.idarticle ='.$idarticle.';');
			$query->execute();
			return $query;
		}
		catch(PDOException $e)
		{
			throw new MyDatabaseException( $e->getMessage( ) , (int)$e->getCode( ) );
			echo "Erro".$e;
		}
	}

}
