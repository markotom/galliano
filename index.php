<?php get_header(); ?>

      <!-- .section.section-0 -->
      <div class="section active" id="section-0">
        <!--.brand -->
        <div id="brand">
          <h1>
            <a href="<?php echo home_url() ?>" rel="home">
              <?php if ( $logo_xs = ot_get_option( 'logo_xs' ) ) : ?>
              <?php if ( $logo_xs_2x = ot_get_option( 'logo_xs_2x' ) ) : ?>
              <img class="logo logo-xs" src="<?php echo $logo_xs ?>" data-at2x="<?php echo $logo_xs_2x ?>" alt="<?php bloginfo( 'sitename' ) ?>">
              <?php else :?>
              <img class="logo logo-xs" src="<?php echo $logo_xs ?>" alt="<?php bloginfo( 'sitename' ) ?>">
              <?php endif; ?>
              <?php endif; ?>

              <?php if ( $logo_sm = ot_get_option( 'logo_sm' ) ) : ?>
              <img class="logo logo-sm hidden" src="<?php echo $logo_sm ?>" alt="<?php bloginfo( 'sitename' ) ?>">
              <?php endif; ?>
            </a>
          </h1>

          <!-- .menu -->
          <ul class="menu hidden">
            <li data-menuanchor="vida"><a class="fa fa-heart" href="#vida"></a></li>
            <li data-menuanchor="momentos"><a class="fa fa-star" href="#momentos"></a></li>
            <li data-menuanchor="instagram"><a class="fa fa-instagram" href="#instagram"></a></li>
            <li data-menuanchor="twitter"><a class="fa fa-twitter" href="#twitter"></a></li>
            <li data-menuanchor="facebook"><a class="fa fa-facebook" href="#facebook"></a></li>
            <li data-menuanchor="contacto"><a class="fa fa-envelope" href="#contacto"></a></li>
          </ul><!-- /.menu -->

          <div class="next hidden" data-menuanchor="vida">
            <a href="#vida"><span class="fa fa-angle-down"></span></a>
          </div>
        </div><!-- /.brand -->
      </div><!-- /.section.section-0 -->

      <!-- .section.section-1 -->
      <div class="section" id="section-1">
        <?php $items = ot_get_option( 'galliano_gallery_1' ); ?>
        <?php include( locate_template( 'templates/gallery.php' ) ); ?>
      </div><!-- /.section.section-1 -->

      <!-- .section.section-2 -->
      <div class="section" id="section-2">
        <?php $items = ot_get_option( 'galliano_gallery_2' ); ?>
        <?php include( locate_template( 'templates/gallery.php' ) ); ?>
      </div><!-- /.section.section-2 -->

      <!-- .section.section-3 -->
      <div class="section" id="section-3">
        <?php get_template_part( 'templates/section', 3 ); ?>
      </div><!-- /.section.section-3 -->

      <!-- .section.section-4 -->
      <div class="section" id="section-4">
        <?php get_template_part( 'templates/section', 4 ); ?>
      </div><!-- /.section.section-4 -->

      <!-- .section.section-5 -->
      <div class="section" id="section-5">
        <?php get_template_part( 'templates/section', 5 ); ?>
      </div><!-- /.section.section-5 -->

      <!-- .section.section-6 -->
      <div class="section" id="section-6">
        <?php get_template_part( 'templates/section', 6 ); ?>
      </div><!-- /.section.section-6 -->

<?php get_footer(); ?>
