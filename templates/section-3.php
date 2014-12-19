<script type="text/template" id="photo-template">
  <%
    var source  = type === 'image' ? images.standard_resolution.url : link + '/embed',
        mfpType = type === 'video' ? 'iframe' : 'image';
  %>
  <a
    class="instagram-lightbox mfp-<%- mfpType %>"
    href="<%- link %>"
    data-title="<%- caption.text %>"
    data-likes="<%- likes.count %>"
    data-comments="<%- comments.count %>"
    data-mfp-src="<%- source %>"
    style="background-image: url(<%- images.standard_resolution.url %>)"
  >
  </a>
</script>

<!-- .section-container.instagram -->
<div class="section-container instagram">
  <!-- .spinner.spinner-inverse -->
  <div class="spinner spinner-inverse">
    <i class="fa fa-circle-o-notch fa-spin"></i>
  </div><!-- /.spinner.spinner-inverse -->
</div><!-- /.section-container.instagram -->
