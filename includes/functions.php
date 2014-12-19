<?php

  function contactform_action_callback() {
    if ( isset( $_POST['_cf_nonce'] ) && wp_verify_nonce( $_POST['_cf_nonce'], $_POST['action'] ) ) {
      $name     = sanitize_text_field($_POST['name']);
      $email    = sanitize_email($_POST['email']);
      $subject  = ! ot_get_option( 'contact-subject' ) ? 'Un mensaje desde el sitio web de Cecilia Galliano' : ot_get_option( 'contact-subject' );
      $message  = wp_kses_data($_POST['message']);
      $to       = ! ot_get_option( 'contact-to' ) ? get_option( 'admin_email' ) : ot_get_option( 'contact-to' );
      $headers  = 'From: ' . $name . ' <' . $email . '>' . PHP_EOL;
      $headers .= 'Content-type: text/html' . PHP_EOL;
      $headers .= 'Reply-To: ' . $email . PHP_EOL;

      if ( wp_mail( $to, $subject, $message, $headers ) ) {
        $status  = 'success';
        $message = ! ot_get_option( 'contact-success-message' ) ? 'Mensaje enviado.' : ot_get_option( 'contact-success-message' );
      } else {
        $status  = 'error';
        $message = ! ot_get_option( 'contact-error-message' ) ? 'No se envió el mensaje.' : ot_get_option( 'contact-error-message' );
      }

      $response = array( 'status' => $status, 'message' => $message );
      header( 'Content-Type: application/json; charset=utf-8' );

      echo json_encode( $response );
    }

    die();
  }

  add_action( 'wp_ajax_contactform_action', 'contactform_action_callback' );
  add_action( 'wp_ajax_nopriv_contactform_action', 'contactform_action_callback' );

?>
