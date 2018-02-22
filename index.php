<?php
include_once 'controller/LoadPages.php';
//new LoadPages();

$route = new Route();
//carregar pagina inicial caso a variavel $page esteja vazia
if(empty($page)) $page = 'home.php';
if(isset($_SERVER['REDIRECT_URL']))
{
  $page = $route->defineRoute($_SERVER['REDIRECT_URL']);;
}
  require_once 'header.php';
?>

<div class="main-content">
  <div class="box-left">
    <p>

    </p>
  </div>
  <div class="box-center">
    
      <?php require_once $page;?>


      <footer class="main-footer">
          <span>Dharnos Lima</span>
      </footer>
  </div>
  <div class="box-right">
    <p>

    </p>
  </div>
</div>
</div>
<?php
    require_once 'footer.php';
?>
