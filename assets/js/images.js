jQuery(document).ready(function ($) {

  var setCorrectHeight = function () {

    $('.section-container').height(function () {

      var borderWidth  = $(window).width() - $(this).width(),
          navbarHeight = $('.navbar-fixed-top').height() + borderWidth;

      return $(window).height() - navbarHeight;

    });

  };

  var setBackgroundSizes = function () {
    $('.background').each(function () {
      var background  = $(this),
          aspectRatio = background.width() / background.height();

      if (($(window).width() / $(window).height()) < aspectRatio) {
        background
          .removeClass('background-width')
          .addClass('background-height');
      } else {
        background
          .removeClass('background-height')
          .addClass('background-width');
      }

      background.css('left', function(){
        return -((background.width() - $(window).width()) / 2);
      });
    });
  };

  var setMasonryLayouts = function () {
    if ($(window).width() > 992) {

      $('.grid').masonry({
        itemSelector: '.item',
        columnWidth: '.grid-sizer',
        transitionDuration: 0
      });

    }
  };


  $(window).bind('resize', function () {

    // Set correct height of containers
    setCorrectHeight();

    // Set correct background sizes
    setBackgroundSizes();

    // Build or refresh masonry layouts
    setMasonryLayouts();

  }).trigger('resize');

  $(window).load(function () {

    setTimeout(function () {
      $('#brand .logo-sm').removeClass('hidden').addClass('animated fadeInDown');
    }, 1000);

    setTimeout(function () {
      $('#brand .menu').removeClass('hidden').addClass('animated fadeInUp');
    }, 1500);

    setTimeout(function () {
      $('#brand .next').removeClass('hidden').addClass('animated fadeIn');
    }, 2000);

  });

});
