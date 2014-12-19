<?php if ( isset( $items ) && is_array( $items ) && count( $items ) > 0 ) : ?>
  <!-- .section-container.grid -->
  <div class="section-container grid">
    <!-- .grid-sizer -->
    <div class="grid-sizer"></div><!-- /.grid-sizer -->

    <?php $i = 0; foreach ( $items as $item ) : $i++; ?>
    <?php

      $item['url'] = ! $item['url'] ? $item['image'] : $item['url'] ;

      preg_match('/youtube|vimeo/', $item['url'], $match);
      $type = count( $match ) > 0 ? 'iframe' : 'image';

    ?>
    <!-- .item.item-? -->
    <div class="item item-<?php echo $i; ?>" style="background-image: url('<?php echo $item['image'] ?>')">
      <!-- .lightbox.mfp-(iframe|image) -->
      <a class="lightbox mfp-<?php echo $type ?>" href="<?php echo $item['url'] ?>" data-title="<?php echo $item['title'] ?>">
        <?php if ($type === 'iframe') : ?>
          <span class="play-video"><i class="fa fa-play-circle"></i></span>
        <?php else : ?>
          <?php if ( $item['image2'] ) : ?>
            <img src="<?php echo $item['image2'] ?>" alt="<?php echo $item['title'] ?>">
          <?php else : ?>
            <span class="align-bottom"><?php echo $item['title'] ?></span>
          <?php endif; ?>
        <?php endif; ?>
      </a><!-- /.lightbox.mfp-(iframe|image) -->
    </div><!-- /.item.item-? -->
    <?php endforeach; ?>

  </div><!-- /.section-container.grid -->
<?php endif; ?>
