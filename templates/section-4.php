<!-- #tweet-template -->
<script type="text/template" id="tweet-template">
  <img class="item-user-avatar" src="<%- user.profile_image_url %>" width="50" alt="">
  <div class="item-user-username">
    <a href="http://twitter.com/<%- user.screen_name %>"><%- user.name %></a>
  </div>
  <div class="item-user-screename">
    <a href="http://twitter.com/<%- user.screen_name %>">@<%- user.screen_name %></a>
  </div>
  <div class="item-text"><%= text %></div>
</script><!-- /#tweet-template -->

<!-- .section-container -->
<div class="section-container">
  <!-- .btn-social -->
  <a class="btn-social" href="http://twitter.com/ceci_galliano">
    <span class="fa fa-twitter"></span>
  </a><!-- /.btn-social -->

  <!-- .twitter.feed -->
  <div class="twitter feed">
    <!-- .spinner -->
    <div class="spinner">
      <i class="fa fa-circle-o-notch fa-spin"></i>
    </div><!-- /.spinner -->
  </div><!-- /.twitter.feed -->
</div><!-- /.section-container -->
