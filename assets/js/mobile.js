var mobile = false;

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) mobile = true;
if($(window).width() <= 760) mobile = true;

if(mobile){

  $('#mobile').removeClass('desktop').addClass('mobile');
}

$('.oc').click(function(){

  $('nav').slideToggle();
});
