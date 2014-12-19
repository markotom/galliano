<?php

/**
 * -----------------------------------------------------------------------------
 * OptionTree Framework
 * -----------------------------------------------------------------------------
 *
 */

// Hide pages from admin menu
add_filter( 'ot_show_pages', '__return_false' );

// Avoid creating a default layout
add_filter( 'ot_show_new_layout', '__return_false' );

// Turn on theme mode
add_filter( 'ot_theme_mode', '__return_true' );

// Load template
require get_template_directory() . '/option-tree/ot-loader.php';

/**
 * -----------------------------------------------------------------------------
 * Theme Options
 * -----------------------------------------------------------------------------
 *
 */

// Set custom theme options
add_action( 'admin_init', 'custom_theme_options', 1 );

function custom_theme_options() {

  // OptionTree is not loaded yet
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;

  // Get saved settings
  $saved_settings = get_option( ot_settings_id(), array() );

  // Set custom settings
  $custom_settings = array(

    // Contextual help
    'contextual_help' => array(
      'content' => array(
        array(
          'id' => 'information',
          'title' => 'Información',
          'content' => '
            <h1>Cecilia Galliano</h1>
            <p>Tema de Wordpress creado para Cecilia Galliano.</p>
            <hr>
            <p>Desarrollado por <a href="http://about.me/markotom">Marco Godínez</a></p>
          '
        )
      )
    ),

    // Sections
    'sections' => array(
      array(
        'id' => 'general',
        'title' => 'General'
      ),
      array(
        'id' => 'section-1',
        'title' => 'Vida'
      ),
      array(
        'id' => 'section-2',
        'title' => 'Momentos'
      ),
      array(
        'id' => 'section-3',
        'title' => 'Instagram'
      ),
      array(
        'id' => 'section-4',
        'title' => 'Twitter'
      ),
      array(
        'id' => 'section-5',
        'title' => 'Facebook'
      ),
      array(
        'id' => 'section-6',
        'title' => 'Contacto'
      )
    ),

    // Settings
    'settings' => array(

      // Background desktop
      array(
        'id'          => 'background_sm',
        'label'       => 'Background (desktop)',
        'type'        => 'upload',
        'section'     => 'general'
      ),

      // Background mobile
      array(
        'id'          => 'background_xs',
        'label'       => 'Background (mobile)',
        'type'        => 'upload',
        'section'     => 'general'
      ),

      // Logo desktop
      array(
        'id'          => 'logo_sm',
        'label'       => 'Logo (desktop)',
        'type'        => 'upload',
        'section'     => 'general'
      ),

      // Logo navbar
      array(
        'id'          => 'logo_navbar',
        'label'       => 'Logo (navbar)',
        'type'        => 'upload',
        'section'     => 'general'
      ),

      // Logo mobile
      array(
        'id'          => 'logo_xs',
        'label'       => 'Logo (mobile)',
        'type'        => 'upload',
        'section'     => 'general'
      ),

      // Logo mobile (2x)
      array(
        'id'          => 'logo_xs_2x',
        'label'       => 'Logo (retina)',
        'type'        => 'upload',
        'section'     => 'general'
      ),

      // Gallery (Section 1)
      array(
        'id'          => 'galliano_gallery_1',
        'label'       => 'Galería',
        'type'        => 'list-item',
        'section'     => 'section-1',
        'settings'    => array(
          array(
            'id'          => 'image',
            'label'       => 'Imagen (static)',
            'type'        => 'upload'
          ),
          array(
            'id'          => 'image2',
            'label'       => 'Imagen (hover)',
            'type'        => 'upload'
          ),
          array(
            'id'          => 'url',
            'label'       => 'Enlace',
            'type'        => 'upload'
          )
        )
      ),

      // Gallery (Section 2)
      array(
        'id'          => 'galliano_gallery_2',
        'label'       => 'Galería',
        'type'        => 'list-item',
        'section'     => 'section-2',
        'settings'    => array(
          array(
            'id'          => 'image',
            'label'       => 'Imagen (static)',
            'type'        => 'upload'
          ),
          array(
            'id'          => 'image2',
            'label'       => 'Imagen (hover)',
            'type'        => 'upload'
          ),
          array(
            'id'          => 'url',
            'label'       => 'Enlace',
            'type'        => 'upload'
          )
        )
      ),

      // Client ID (Instagram)
      array(
        'id'          => 'instagram-client-id',
        'label'       => 'Client ID',
        'desc'        => 'Añadir el ID de la aplicación de Instagram. <br> <a href="http://instagram.com/developer">Crear aplicación</a>',
        'type'        => 'text',
        'section'     => 'section-3'
      ),

      // Instagram user
      array(
        'id'          => 'instagram-user-id',
        'label'       => 'Usuario',
        'desc'        => 'Añadir el ID del usuario de Instagram. <br> <a href="http://jelled.com/instagram/lookup-user-id">Obtener ID</a>',
        'type'        => 'text',
        'section'     => 'section-3'
      ),

      // Limit of photos
      array(
        'id'          => 'instagram-limit',
        'label'       => 'Límite de fotos',
        'std'         => '13',
        'desc'        => 'Añadir el número de fotos a mostrar.',
        'type'        => 'text',
        'section'     => 'section-3'
      ),

      // Instagram Cache
      array(
        'id'          => 'instagram-cache',
        'label'       => 'Caché (segundos)',
        'std'         => '600',
        'desc'        => '10 minutos = 600 segundos',
        'type'        => 'text',
        'section'     => 'section-3'
      ),

      // Access Token (Twitter)
      array(
        'id'          => 'twitter-access-token',
        'label'       => 'Access Token',
        'desc'        => 'Añadir el <em>access token</em> de la aplicación de Twitter. <br> <a href="https://apps.twitter.com">Crear aplicación</a>',
        'type'        => 'text',
        'section'     => 'section-4'
      ),

      // Access Token Secret (Twitter)
      array(
        'id'          => 'twitter-access-token-secret',
        'label'       => 'Access Token Secret',
        'desc'        => 'Añadir el <em>access token secret</em> de la aplicación de Twitter.',
        'type'        => 'text',
        'section'     => 'section-4'
      ),

      // Consumer Key (Twitter)
      array(
        'id'          => 'twitter-consumer-key',
        'label'       => 'Consumer Key',
        'desc'        => 'Añadir el <em>consumer key</em> de la aplicación de Twitter.',
        'type'        => 'text',
        'section'     => 'section-4'
      ),

      // Consumer Secret (Twitter)
      array(
        'id'          => 'twitter-consumer-secret',
        'label'       => 'Consumer Secret',
        'desc'        => 'Añadir el <em>consumer secret</em> de la aplicación de Twitter.',
        'type'        => 'text',
        'section'     => 'section-4'
      ),

      // Twitter user
      array(
        'id'          => 'twitter-screen-name',
        'label'       => 'Usuario (screen_name)',
        'desc'        => 'Añadir el <em>screen_name</em> del usuario de Twitter.',
        'type'        => 'text',
        'section'     => 'section-4'
      ),

      // Limit of tweets
      array(
        'id'          => 'twitter-limit',
        'label'       => 'Límite de tweets',
        'std'         => '10',
        'desc'        => 'Añadir el número de tweets a mostrar.',
        'type'        => 'text',
        'section'     => 'section-4'
      ),

      // Twitter Cache
      array(
        'id'          => 'twitter-cache',
        'label'       => 'Caché (segundos)',
        'std'         => '600',
        'desc'        => '10 minutos = 600 segundos',
        'type'        => 'text',
        'section'     => 'section-4'
      ),

      // Access Token (Facebook)
      array(
        'id'          => 'facebook-access-token',
        'label'       => 'Access Token',
        'desc'        => 'Añadir el <em>access token</em> de la aplicación de Facebook. <br> <a href="https://developers.facebook.com">Crear aplicación</a>',
        'type'        => 'text',
        'section'     => 'section-5'
      ),

      // Page (Facebook)
      array(
        'id'          => 'facebook-page-id',
        'label'       => 'Page ID',
        'desc'        => 'Añadir el ID de la <em>fan page</em>.',
        'type'        => 'text',
        'section'     => 'section-5'
      ),

      // Limit of statuses
      array(
        'id'          => 'facebook-limit',
        'label'       => 'Límite de estados',
        'std'         => '10',
        'desc'        => 'Añadir el número de estados a mostrar.',
        'type'        => 'text',
        'section'     => 'section-5'
      ),

      // Facebook Cache
      array(
        'id'          => 'facebook-cache',
        'label'       => 'Caché (segundos)',
        'std'         => '600',
        'desc'        => '10 minutos = 600 segundos',
        'type'        => 'text',
        'section'     => 'section-5'
      ),

      // Contact email
      array(
        'id'          => 'contact-to',
        'label'       => 'Correo destinatario',
        'desc'        => 'Añadir dirección de correo del destinatario, si no se añade los mensajes de correo se envían al correo del administrador.',
        'type'        => 'text',
        'section'     => 'section-6'
      ),

      // Contact subject
      array(
        'id'          => 'contact-subject',
        'label'       => 'Asunto',
        'std'         => 'Un mensaje desde el sitio web de Cecilia Galliano',
        'desc'        => 'Añadir asunto del correo.',
        'type'        => 'text',
        'section'     => 'section-6'
      ),

      // Contact success message
      array(
        'id'          => 'contact-success-message',
        'label'       => 'Mensaje de confirmación',
        'std'         => 'Mensaje enviado.',
        'desc'        => 'Mensaje de confirmación cuando se envía el correo.',
        'type'        => 'text',
        'section'     => 'section-6'
      ),

      // Contact error message
      array(
        'id'          => 'contact-error-message',
        'label'       => 'Mensaje de error',
        'std'         => 'No se envió el mensaje.',
        'desc'        => 'Mensaje de error cuando no se envía el correo.',
        'type'        => 'text',
        'section'     => 'section-6'
      ),


    )

  );

  // Save custom settings if are not the same
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings );
  }

}

?>
