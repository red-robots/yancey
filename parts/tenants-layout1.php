<?php if( get_row_layout() == 'layout1' ) {
  $resources_title = get_sub_field('resources_title');
  $count = 1;

  if( have_rows('resources') ):
?>
    <section class="repeatable_layout2 repeatable_layout_resources">
      <div class="wrapper">
          <h3 class="text-center header"><?php echo acf_esc_html( $resources_title ); ?></h3>
          <div class="flexwrap resources-content">
              <?php while( have_rows('resources') ): the_row(); 
                  $title = get_sub_field('title');
                  $description = get_sub_field('description');
                  $button = get_sub_field('button_link');
                  $button_text = (isset($button['title']) && $button['title']) ? $button['title'] : '';
                  $button_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
                  $button_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
              ?>
                  <div class="resource-item" id="resource-item-<?php echo $count;?>">
                    <h4 class="title"><?php echo acf_esc_html( $title ); ?></h4>
                        <?php if($description){ ?>
                            <div class="content">
                                <?php echo acf_esc_html( $description ); ?>
                            </div>
                        <?php } ?>
                        <?php if($button_text && $button_url) { ?>
                            <span>
                                <a class="button-text" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>">
                                    <?php echo $button_text; ?>
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </span>
                    <?php } ?>
                  </div>
              <?php
                  $count++;
                  endwhile;
              ?>
          </div>
      </div><!-- wrapper -->
    </section>
  <?php endif; ?>
<?php } ?>