<?php
class IndexController{

  public function teste(){
		echo "Ok";
	}
  public function articlesShow()
	{
		$dao = new ArticleDao();
		$query = $dao->showArticles();

		return $query;
	}

  public function articlesShowId($id)
	{
    $model = new ArticleModel();
		$model->showArticle($id);
		return $model;
	}

	public function saveContact($arrayContact)
	{

		$modelMessage = new ModelMessageContact();
		$messageDao = new MessageDao();
		//criar o modelo message
		$modelMessage->createModel($arrayContact);

		//passar valores para o banco
		if ($messageDao->saveMessageUser($modelMessage) === intVal('23000'))
		{
			$messageDao->saveMessage($modelMessage);
		}
	/*	else
		{
			echo "<br />Adicionou novo usuario<br />********<br />";
		}*/

	}


}
