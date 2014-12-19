jQuery(document).ready(function ($) {

  $('.wrapper.fullpage').fullpage({
    anchors: [
      'home',
      'vida',
      'momentos',
      'instagram',
      'twitter',
      'facebook',
      'contacto'
    ],
    resize: false,
    scrollOverflow: true,
    onLeave: function (lastIndex, index) {

      var navbar = $('.navbar-fixed-top');

      if (index > 1) {
        navbar.addClass('navbar-show');
      } else {
        navbar.removeClass('navbar-show');
      }

    },
    afterLoad: function (anchor, index) {

      var anchors = $('[data-menuanchor]'),
          current = $('[data-menuanchor="' + anchor + '"]');

      anchors.removeClass('active');
      current.addClass('active');

    }
  });

});
