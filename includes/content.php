<?php

/**
 * -----------------------------------------------------------------------------
 * Content
 * -----------------------------------------------------------------------------
 *
 */

// Added titles
add_filter( 'wp_title', 'galliano_wp_title', 10, 2 );

function galliano_wp_title( $title, $separator ) {
  global $paged, $page;

  if ( is_feed() ) {
    return $title;
  }

  $title .= get_bloginfo( 'name' );

  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $separator $site_description";
  }

  if ( $paged >= 2 || $page >= 2 ) {
    $title = sprintf( 'Página %s', max( $paged, $page ) ) . " $separator $title";
  }

  return $title;
}

  // Redirect to home in every case
  add_filter( 'request', 'galliano_redirect' );

  function galliano_redirect( $request ) {
    $query = new WP_Query();
    $query->parse_query( $request );

    if ( ! $query->is_home() ) {
      wp_redirect( home_url() );
      exit;
    }

    return $request;
  }

?>
