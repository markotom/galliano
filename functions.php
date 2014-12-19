<?php

  if ( ! defined( 'ABSPATH' ) ) exit(500);

  if ( ! isset( $content_width ) )
    $content_width = 1024;

  show_admin_bar( false );

  // Theme Options
  require get_template_directory() . '/includes/theme-options.php';

  // Initialize
  require get_template_directory() . '/includes/configure.php';

  // Functions
  require get_template_directory() . '/includes/functions.php';

  // Content
  require get_template_directory() . '/includes/content.php';

  // APIs
  require get_template_directory() . '/includes/instagram.php';
  require get_template_directory() . '/includes/twitter.php';
  require get_template_directory() . '/includes/facebook.php';

  new Instagram_API_Endpoints();
  new Twitter_API_Endpoints();
  new Facebook_API_Endpoints();

?>
