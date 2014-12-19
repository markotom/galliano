jQuery(document).ready(function ($) {

  $.extend($.validator.messages, {
    required: "Este campo es obligatorio.",
    remote: "Por favor, rellena este campo.",
    email: "Por favor, escribe una dirección de correo válida",
    url: "Por favor, escribe una URL válida.",
    date: "Por favor, escribe una fecha válida.",
    number: "Por favor, escribe un número entero válido.",
    digits: "Por favor, escribe sólo dígitos.",
    equalTo: "Por favor, escribe el mismo valor de nuevo."
  });

  $('#contactform').validate({
    rules: {
      name: 'required',
      email: {
        required: true,
        email: true
      },
      message: 'required'
    },
    submitHandler: function (form) {
      $(form).hide();

      var response = $('.cf-response').removeClass('hide');

      $.ajax({
        type: 'POST',
        url: contactform.url,
        data: $(form).serialize(),
        success: function (res) {
          if (res.status === 'success') {
            response.find('.message').text(res.message);
          } else {
            $(form).show();
          }
        }
      });
    }
  });

});