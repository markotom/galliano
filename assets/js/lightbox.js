jQuery(document).ready(function ($) {

  $.extend(true, $.magnificPopup.defaults, {
    tClose: 'Cerrar (Esc)',
    tLoading: 'Cargando...',
    mainClass: 'mfp-fade',
    removalDelay: 300,
    type: 'image',
    gallery: {
      enabled: true,
      tPrev: 'Anterior',
      tNext: 'Siguiente',
      tCounter: '%curr% de %total%'
    },
    closeBtnInside: false,
    image: {
      titleSrc: 'data-title',
      tError: '<a href="%url%">La imagen</a> no pudo cargarse.'
    }
  });

  $('#section-1 .lightbox').magnificPopup();
  $('#section-2 .lightbox').magnificPopup();

});
