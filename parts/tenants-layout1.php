<?php if( get_row_layout() == 'layout1' ) {
  if( have_rows('resources') ):
    $count = 1;
?>
    <section class="repeatable_layout2 repeatable_layout_resources">
      <div class="wrapper">
          <h3 class="text-center">Resident Resources</h3>
          <div class="services-tab-content resources-content">
              <?php while( have_rows('resources') ): the_row(); 
                  $main_content = get_sub_field('main_content');
                  $content_1 = get_sub_field('content_1');
                  $content_2 = get_sub_field('content_2');
              ?>
                  <div class="service-content resources-content" id="resource-item-<?php echo $count;?>">
                      <div class="main-content"><?php echo acf_esc_html( $main_content ); ?></div>
                      <?php if($content_1){ ?>
                          <div class="sub-content <?php echo (!empty($content_2)) ? "half" : "full"; ?>">
                              <div class="sub-content-1">
                                  <?php echo acf_esc_html( $content_1 ); ?>
                              </div>
                              <?php if($content_2){ ?>
                                  <div class="sub-content-2">
                                      <?php echo acf_esc_html( $content_2 ); ?>
                                  </div>
                              <?php } ?>
                          </div>
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