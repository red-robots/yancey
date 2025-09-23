<?php if( get_row_layout() == 'layout1' ) {
  $header = get_sub_field('header');
  $content = get_sub_field('text_content');
  $button = get_sub_field('button');
  $button_text = (isset($button['title']) && $button['title']) ? $button['title'] : '';
  $button_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
  $button_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
  $has_content = ($header || $content) ? true : false;

  if ($has_content) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable first repeatable_<?php echo get_row_layout() ?>">
    <div class="wrapper about-wrapper">
      <div class="flexwrap">
        <div class="fxcol textCol">
          <div class="wrap">
            <div class="header">
              <?php echo anti_email_spam($header); ?>
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
        <div class="fxcol imageCol">
          <div class="wrap content">
            <?php echo anti_email_spam($content); ?>
          </div>
        </div>
        <div class="backgroundColor">
          <span class="stripe"></span>
        </div>
      </div>
    </div>
    
  </section>
  <?php } ?>
<?php } ?>