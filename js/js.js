$(document).ready(function () {
     $('.menu-anchor').on('click touchstart', function (e) {
          $('html').toggleClass('menu-active');
          e.preventDefault();
     });
})

$(window).scroll(function () {
     nScrollPosition = $(window).scrollTop();
     if (nScrollPosition >= 200) {
          $("#seta").css("display", "block");
     } else {
          $("#seta").css("display", "none");
     }
});