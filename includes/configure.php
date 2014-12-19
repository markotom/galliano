<?php

/**
 * -----------------------------------------------------------------------------
 * Configure theme
 * -----------------------------------------------------------------------------
 *
 */

// After setup theme
add_action( 'after_setup_theme', 'galliano_configure_theme', 9 );

// Configure theme
function galliano_configure_theme() {

  // Theme support
  add_action( 'after_setup_theme', 'galliano_theme_support' );

  // Head cleanup
  add_action( 'init', 'galliano_head_cleanup' );

  // Enqueue assets
  add_action( 'wp_enqueue_scripts', 'galliano_enqueue_assets' );

  // Image sizes
  add_action( 'init', 'galliano_image_sizes' );

}

// Theme support
function galliano_theme_support() {

  // Add menus support
  add_theme_support( 'menus' );

}

// Head cleanup
function galliano_head_cleanup() {

  // Rsd link
  remove_action( 'wp_head', 'rsd_link' );

  // Windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );

  // Index link
  remove_action( 'wp_head', 'index_rel_link' );

  // Previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

  // Start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

  // Links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

  // WP version
  remove_action( 'wp_head', 'wp_generator' );

}

// Enqueue assets
function galliano_enqueue_assets() {

  if ( ! is_admin () ) {

    // Asset path format
    $asset_path = get_stylesheet_directory_uri() . '/built/%2$s/%1$s.%2$s';

    // Register "Fjalla One" webfont
    wp_register_style( 'galliano-webfont-fjalla', 'http://fonts.googleapis.com/css?family=Fjalla+One', null, null );
    // Register Font Awesome styles
    wp_register_style( 'galliano-fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css', null, null );
    // Register main styles
    wp_register_style( 'galliano-styles', sprintf( $asset_path, 'styles', 'css' ), array('galliano-webfont-fjalla', 'galliano-fontawesome'), null );

    // Enqueue "Fjalla One" webfont
    wp_enqueue_style( 'galliano-webfont-fjalla' );
    // Enqueue Font Awesome styles
    wp_enqueue_style( 'galliano-fontawesome' );
    // Enqueue main styles
    wp_enqueue_style( 'galliano-styles' );

    // Register vendor scripts
    wp_register_script( 'galliano-vendors', sprintf( $asset_path, 'vendors.min', 'js' ), null, null );
     // Register galliano scripts
    wp_register_script( 'galliano-scripts', sprintf( $asset_path, 'app.min', 'js' ), array( 'galliano-vendors' ), null );

    // Enqueue galliano vendors
    wp_enqueue_script( 'galliano-vendors' );
    // Enqueue galliano scripts
    wp_enqueue_script( 'galliano-scripts' );

    // Contact info
    wp_localize_script( 'galliano-scripts', 'contactform', array(
      'url' => admin_url( 'admin-ajax.php' )
    ) );

    // Instagram options
    $instagram_limit = intval( ot_get_option( 'instagram-limit' ) );
    wp_localize_script( 'galliano-scripts', 'instagram_options', array(
      'url'   => get_site_url() . '/api/photos',
      'limit' => $instagram_limit > 0 ? $instagram_limit : 13
    ) );

    // Twitter options
    $twitter_limit = intval( ot_get_option( 'twitter-limit' ) );
    wp_localize_script( 'galliano-scripts', 'twitter_options', array(
      'url'   => get_site_url() . '/api/tweets',
      'limit' => $twitter_limit > 0 ? $twitter_limit : 10
    ) );

    // Facebook options
    $facebook_limit = intval( ot_get_option( 'facebook-limit' ) );
    wp_localize_script( 'galliano-scripts', 'facebook_options', array(
      'url'   => get_site_url() . '/api/statuses',
      'limit' => $facebook_limit > 0 ? $facebook_limit : 10
    ) );
  }

}

// Images sizes
function galliano_image_sizes() {

  // Add thumb-medium size
  add_image_size( 'thumb-medium', 780, 400, true );

  // Add thumb-large size
  add_image_size( 'thumb-large', 1024, 525, true );

}

?>
