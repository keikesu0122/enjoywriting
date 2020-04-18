/*global $*/
/*global jQuery*/

$(function() {
 
  // 一旦hide()で隠してフェードインさせる
  $('#commons-enpostsindex').hide().fadeIn(1000);
 
});

$(function(){
  var returntop = $('.return_top');
  // ボタン非表示
  returntop.hide();
  // 100px スクロールしたらボタン表示
  $(window).scroll(function () {
     if ($(this).scrollTop() > 100) {
          returntop.fadeIn();
     } else {
          returntop.fadeOut();
     }
  });
  returntop.click(function () {
     $('body, html').animate({ scrollTop: 0 }, 500);
     return false;
  });
});