<?php if( have_rows('our_team') ) {
  $count = 1;
?>
<div id="overlay"></div>
<div id="popup-content"></div>
<section id="team" class="repeatable our-team">
    <div class="wrapper">
      <h3 class="text-center">OUR TEAM</h3>
      <div class="flexwrap">
        <?php
          while( have_rows('our_team') ): the_row(); 
            $team = get_sub_field('team');

            $post_id = $team->ID;
            $team_title = get_the_title($post_id);
            $thumbnail_id = get_post_thumbnail_id($post_id);
            $featImage = wp_get_attachment_image_src($thumbnail_id,'large');
            $imageStyle = ($featImage) ? ' style="background-image:url('.$featImage[0].')"':'';
            $position = get_field('title', $post_id);
        ?>
          <div data-postid="<?php echo $post_id; ?>" class="fxcol teamCol team-<?php echo $post_id; ?>">
            <div class="wrap">
              <a href="javascript:void(0)" data-id="<?php echo $post_id; ?>" class="popup-activity">
                <div class="image">
                  <figure<?php echo $imageStyle; ?>>
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/square.png" class="helper" alt="">
                  </figure>
                  <div class="learn-more">LEARN<br/>MORE</div>
                </div>
                <div class="team-info">
                  <h4 class="title"><?php echo esc_html($team_title); ?></h4>
                  <div class="position"><?php echo acf_esc_html( $position ); ?></div>
                </div>
              </a>
            </div>
          </div>
        <?php
            $count++;
          endwhile;

          $header = get_field('team_title');
          $content = get_field('team_content');

          $button = get_field('team_button');
          $button_text = (isset($button['title']) && $button['title']) ? $button['title'] : '';
          $button_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
          $button_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';

          if( $header && $content ){
        ?>
          <div class="fxcol teamCol team-text">
            <div class="wrap">
              <h4 class="header">
                <?php echo esc_html($header); ?>
              </h4>
              <div class="content">
                <?php echo esc_html($content); ?>
              </div>
              <?php if($button_text && $button_url) { ?>
                <span>
                    <a class="button button-element" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                      <?php echo $button_text; ?>
                    </a>
                </span>
              <?php } ?>
            </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </section>
<?php } ?>