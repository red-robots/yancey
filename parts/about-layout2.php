<?php if( get_row_layout() == 'layout2' ) {
  $banner = get_sub_field('banner');
  $banner_text = get_sub_field('banner_text');
  $images = get_sub_field('images');
  $has_content = ($banner_text || $images) ? true : false;

  if ($has_content) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?>">
    <div class="wrapper about-wrapper">
      <div class="flexwrap">
        
        <?php if ($banner_text) { ?>
        <div class="fxcol leftCol bannerCol">
          <?php if( !empty( $banner ) ): ?>
              <div class="banner-img">
                  <img src="<?php echo esc_url($banner['url']); ?>" alt="<?php echo esc_attr($banner['alt']); ?>" />
              </div>
          <?php endif; ?>
          <div class="banner-text"><?php echo anti_email_spam($banner_text); ?></div>
        </div>
        <?php } ?>

        <?php if ($images) { ?>
        <div class="fxcol rightCol">
          <div class="images">
          <?php foreach ($images as $img) {
            //print_r($img);
            $content = $img['content'];
          ?>
            <div class="info">
                <div class="info-icon">
                    <img src="<?php echo esc_url($img['image']['url']); ?>" alt="<?php echo $img['image']['title']; ?>" />
                </div>
                <div class="info-content">
                <?php echo anti_email_spam($content); ?>
                </div>
            </div>
          <?php } ?>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>  
  </section>
  <?php } ?>
<?php } ?>