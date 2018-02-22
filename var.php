
<div class="box-center-content">
<?php
include_once 'controller/LoadPages.php';

$article = new IndexController();

$array = $article->articlesShowId(5);

echo "<pre>";
 print_r($array->getDatePost());
echo "</pre>";
echo "</div>";
