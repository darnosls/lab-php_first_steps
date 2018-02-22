<div class="box-center-content">
<?php
//renderiza a home do site
   $viewIndex = new IndexController();
   foreach ($viewIndex->articlesShow() as $article => $valor) {
   ?>
   <div class="prev-article">
   <h1>
     <?=$valor['name'] ?>
   </h1>

      <p>
        <?=$valor['text'] ?>
      <br />
      <a href="<?=str_replace(' ','-',$valor['name']).".".$valor['idarticle'] ?>">Leia mais...</a>
      </p>
      <hr class="hr-prev-article"/>
   </div>
   <?php
 }
 ?>
</div>
