<?php
class ViewMessageContact
{
  public function sendContact($dataForm)
  {
    $controllerContact = new IndexController();
    $controllerContact->saveContact($dataForm);

  }
}

if($_SERVER['REQUEST_URI'] === '/view/ViewMessageContact.php')
{
  header('location:erro.php');
}
