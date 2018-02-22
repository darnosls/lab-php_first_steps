<?php
//include '../controller/LoadPages.php';


class ArticleModel implements iContentModel
{
  private $idArticle;
  private $title;
  private $writeBy;
  private $datePost;
  private $textArticle;
  private $commentaries = array();
  private $categories = array();
  private $commentators = array();



  public function getIdArticle()
  {
    return $this->idArticle;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function getWriteBy()
  {
    return $this->writeBy;
  }
  public function getDatePost()
  {
    return $this->datePost;
  }

  public function setDatePost($date)
  {
    //tratamento para exibir apenas a data sem hora da postagem

    $date = explode(' ', $date);
    //tratar a data para exibir no formato 00/00/0000
    $date = explode('-', $date[0]);
    $this->datePost = $date[2].'/'.$date[1].'/'.$date[0];
  }

  public function getTextArticle()
  {
    return $this->textArticle;
  }
  public function getCommentaries()
  {
    return $this->commentaries;
  }
  public function getCategories()
  {
    return $this->categories;
  }
  public function getCommentators()
  {
    return $this->commentators;
  }



  public function show(){

    return 'Mostrar todos';
  }

  public function showByIdContent($id)
  {
    return 'Mostar o artigo cod. '.$id;
  }
  public function delete($id)
  {
    return 'Destruir o artigo cod. '.$id;
  }
  public function update($id)
  {
    return 'Alterar o artigo cod. '.$id;
  }

  public function showArticle($idarticle){
    $dao = new ArticleDao();
    $article = $dao->selectArticlesAsID($idarticle);
    $category = $dao->selectCategories($idarticle);

    foreach ($article as $key => $value) {
           $this->title = $value['title'];
           $this->writeBy = $value['writeby'];
           $this->setDatePost($value['datepost']);
           $this->textArticle = $value['text'];
    }

    foreach ($category as $key => $value) {
      $this->categories[] = $value['category'];
    }

  }
}
