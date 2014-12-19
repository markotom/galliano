<!-- .section-container -->
<div class="section-container">
  <div class="cf-response hide">
    <!-- .spinner -->
    <div class="spinner spinner-inverse message">
      <i class="fa fa-circle-o-notch fa-spin"></i>
    </div><!-- /.spinner -->
  </div>

  <!-- .form-horizontal -->
  <form class="form-horizontal" id="contactform" action="#" role="form">
    <!-- .form-group -->
    <div class="form-group">
      <!-- .col-sm-4 -->
      <div class="col-sm-4">
        <input class="form-control" id="name" name="name" type="text" placeholder="Nombre" required>
      </div><!-- /.col-sm-4 -->

      <!-- .col-sm-4 -->
      <div class="col-sm-4">
        <input class="form-control" id="email" name="email" type="email" placeholder="Correo" required>
      </div><!-- /.col-sm-4 -->
    </div><!-- /.form-group -->

    <!-- .form-group -->
    <div class="form-group">
      <!-- .col-sm-12 -->
      <div class="col-sm-12">
        <textarea class="form-control" id="message" name="message" placeholder="Mensaje" required></textarea>
      </div><!-- /.col-sm-12 -->
    </div><!-- /.form-group -->

    <input type="hidden" name="action" value="contactform_action">
    <?php echo wp_nonce_field('contactform_action', '_cf_nonce', true, false); ?>

    <button class="btn btn-lg btn-default" type="submit">Enviar</button>
  </form><!-- /.form-horizontal -->
</div><!-- /.section-container -->
