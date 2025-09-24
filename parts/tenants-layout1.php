<?php if( get_row_layout() == 'layout1' ) {
  if( have_rows('resources') ):
    $count = 1;
    $nav = 1;
?>
    <section class="repeatable_layout2 repeatable_layout_resources">
      <div class="wrapper">
          <h3 class="text-center">Resident Resources</h3>
          <div class="nav services-tab" id="services" role="tablist">
              <?php while( have_rows('resources') ): the_row(); 
                  $icon = get_sub_field('icon');
                  $title = get_sub_field('title');
              ?>
                  <div class="service-item service-item-nav <?php echo ($count==1) ? "active" : ""; ?>" id="nav-<?php echo $count; ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $count; ?>" type="button" role="tab" aria-controls="nav-<?php echo $count; ?>" aria-selected="<?php echo ($count==1) ? "true" : "false"; ?>">
                      <?php if( !empty( $icon ) ): ?>
                          <div class="service-icon">
                              <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                          </div>
                      <?php endif; ?>
                      <div class="title"><?php echo acf_esc_html( $title ); ?></div>
                  </div>
              <?php
                  $count++;
                  endwhile;
              ?>
          </div>
          <div class="tab-content services-tab-content" id="nav-services">
              <?php while( have_rows('resources') ): the_row(); 
                  $main_content = get_sub_field('main_content');
                  $content_1 = get_sub_field('content_1');
                  $content_2 = get_sub_field('content_2');
              ?>
                  <div class="tab-pane fade <?php echo ($nav==1) ? "show active" : ""; ?> service-content" id="nav-<?php echo $nav;?>" role="tabpanel" aria-labelledby="nav-<?php echo $nav; ?>-tab">
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
                  $nav++;
                  endwhile;
              ?>
          </div>
      </div><!-- wrapper -->
    </section>
  <?php endif; ?>
<?php } ?>