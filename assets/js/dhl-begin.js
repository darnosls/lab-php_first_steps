window.onload = function() // Quando a página estiver carregada
{
  if(document.attachEvent)
  {
      //
  }
  else if(document.addEventListener)
  {
    document.addEventListener('scroll',menuFixed);
  }
}



function menuFixed(){
  var menu = document.getElementById('main-navbar');
  var logo = document.getElementById('logo');

    var containerTop = document.getElementById('container').getBoundingClientRect().top;
    if(containerTop < -160){
      menu.style.position = 'fixed';
      menu.style.width = '100%';
      menu.style.left = '0px';
      menu.style.top = '0px';
      menu.style.backgroundColor = 'rgb(192,167,187)';
      logo.style.position = 'fixed';
      logo.style.zIndex = '15';
      //logo.style.left = '-1em';
      logo.style.top = '-1em';
      logo.style.backgroundSize = '12em';
    }else if(containerTop > -160){
      menu.style.position = 'static';
      menu.style.backgroundColor = 'rgba(172,147,167,0.8)';
      logo.style.position = 'static';
      logo.style.backgroundSize = '17em';
    }
}
