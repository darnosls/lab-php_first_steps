<?php
class Article
{
  public function renderArticle($id)
  {
    //instancia IndexController() que é responsável por criar o model article

    $viewIndex = new IndexController();
    $render = $viewIndex->articlesShowId(intVal($id));

    //trecho onde será renderizado a página do artigo representada pela
    //variavel $render que é o modelarticle
    echo '<div class="article box-center-content">
            <div class="header-article ">
                <h1 class="child-header-article">'.$render->getTitle().'</h1>
                <span class="writer-article child-header-article">Por: '.$render->getWriteBy().'</span>
                <span class="date-post-article child-header-article">Data da postagem: '.$render->getDatePost().'</span>
            </div>
            <div class="text-article">
                <p>'
                    .$render->getTextArticle().
               '</p>
            </div>
          <div class="categories-article">';

          foreach ($render->getCategories() as $key => $value)
          {
            echo '<span>'. $value.'</span>';
          }

          echo '</div>
            <div class="section-comments">
                <div id="disqus_thread"></div>
                <script>
                    /**
                   *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                   *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                   /*
                     var disqus_config = function () {
                     this.page.url = PAGE_URL;  // Replace PAGE_URL with your page`s canonical URL variable
                     this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page`s unique identifier variable
                     };
                   */
                      (function() { // DON`T EDIT BELOW THIS LINE
                      var d = document, s = d.createElement("script");
                      s.src = "//www-dharnoslima-com-br.disqus.com/embed.js";
                      s.setAttribute("data-timestamp", +new Date());
                      (d.head || d.body).appendChild(s);
                      })();
                </script>
                <noscript>
                    Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
                </noscript>
            </div>
            </div>';
  }

}



if(isset($_SERVER['REDIRECT_URL']))
{
  $idArticle = explode('.',$_SERVER['REDIRECT_URL']);
  $article = new Article();
  echo $article->renderArticle($idArticle[1]);
}
else
{
  $returnTo = explode('/',$_SERVER['REQUEST_URI']);
  $article = new Article();
}
