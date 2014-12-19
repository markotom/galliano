<!-- #status-template -->
<script type="text/template" id="status-template">
  <img class="item-user-avatar" src="//graph.facebook.com/<%- from.id %>/picture" width="50" alt="">
  <div class="item-user-username">
    <a href="http://facebook.com/<%- from.id %>"><%- from.name %></a>
  </div>
  <div class="item-text">
    <%= message %>
  </div>

  <% if (picture) { %>
  <div class="item-thumbnail">
    <a href="<%- link %>">
      <img class="img-responsive img-thumbnail" src="<%- picture %>">
    </a>
  </div>
  <% } %>
</script><!-- /#status-template -->

<!-- .section-container -->
<div class="section-container">
  <!-- .btn-social -->
  <a class="btn-social" href="http://facebook.com/<?php echo ot_get_option( 'facebook-page-id' ) ?>">
    <span class="fa fa-facebook"></span>
  </a><!-- /.btn-social -->

  <!-- .facebook.feed -->
  <div class="facebook feed">
    <!-- .spinner -->
    <div class="spinner">
      <i class="fa fa-circle-o-notch fa-spin"></i>
    </div><!-- /.spinner -->
  </div><!-- /.facebook.feed -->
</div><!-- /.section-container -->
