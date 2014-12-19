<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <!-- Wordpress titles -->
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <!-- Set encoding -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- X-UA-Compatible -->
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <!-- Mobile support -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <!-- Wordpress head -->
    <?php wp_head(); ?>

    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if (gte IE 6) & (lte IE 8)]>
      <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js" type="text/javascript"></script>
    <![endif]-->
  </head>

  <body <?php body_class(); ?>>
    <!-- .navbar.navbar-fixed-top -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <?php if ( $logo_navbar = ot_get_option( 'logo-navbar' ) ) : ?>
      <div data-menuanchor="home">
        <a href="<?php echo home_url() ?>" rel="home">
          <img class="logo logo-sm" src="<?php echo $logo_navbar ?>" alt="<?php bloginfo( 'sitename' ) ?>">
        </a>
      </div>
      <?php endif; ?>

      <!-- .nav.navbar-nav -->
      <ul class="nav navbar-nav">
        <li data-menuanchor="home"><a class="fa fa-home" href="#home"></a></li>
        <li data-menuanchor="vida"><a class="fa fa-heart" href="#vida"></a></li>
        <li data-menuanchor="momentos"><a class="fa fa-star" href="#momentos"></a></li>
        <li data-menuanchor="instagram"><a class="fa fa-instagram" href="#instagram"></a></li>
        <li data-menuanchor="twitter"><a class="fa fa-twitter" href="#twitter"></a></li>
        <li data-menuanchor="facebook"><a class="fa fa-facebook" href="#facebook"></a></li>
        <li data-menuanchor="contacto"><a class="fa fa-envelope" href="#contacto"></a></li>
      </ul><!-- /.nav.navbar-nav -->
    </nav><!-- /.navbar.navbar-fixed-top -->

    <?php if ( $background_xs = ot_get_option( 'background_xs' ) ) : ?>
    <img class="background background-xs" src="<?php echo $background_xs ?>" alt="">
    <?php endif; ?>

    <?php if ( $background_sm = ot_get_option( 'background_sm' ) ) : ?>
    <img class="background background-sm" src="<?php echo $background_sm ?>" alt="">
    <?php endif; ?>

    <!-- .wrapper.fullpage -->
    <div class="wrapper fullpage">
