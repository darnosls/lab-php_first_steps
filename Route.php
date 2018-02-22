<?php
class Route{

  public function defineRoute($uri)
  {
    //recupera o nome do arquivo ou produto extraindo a primeira barra
    //quando houver redirecionamento
    $redirectURL = substr($uri,1);
    $uri = (file_exists($redirectURL.".php")) ? $redirectURL.'.php' : 'erro.php';

    if(strpos($redirectURL,'/') > 0)
    {
      //explodir a uri para determinar se é um diretório ou arquivo
      $explodeUri = explode('/',$redirectURL);

      header('location: ../'.str_replace(' ', '+',$explodeUri[0]));
      //header('location: ../'.$explodeUri[0]);
    }
    else if(strpos($redirectURL,'.') > 0)
    {
      //captura o id do arquivo e passa para a classe Article.php
      //
      $explodeUri = explode('.',$redirectURL);
      $uri = intVal($explodeUri[1]) ? 'view/Article.php' : 'erro.php';
    }
    return $uri;
  }
}
