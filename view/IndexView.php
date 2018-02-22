<?php
namespace view;
include_once 'controller/LoadPages.php';

class IndexView{
new LoadPages();
private $indexController;

  public function __construct($indexController)
  {
    $this->indexController = $indexController;
  }

  public function showArticles()
  {
    return $this->indexController->teste();
  }

  public function showArticleId()
  {
    return $this->indexController->teste();
  }


}

$view = new IndexView();
