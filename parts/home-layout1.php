<?php if( get_row_layout() == 'layout1' ) {
  $text = get_sub_field('text_content');
  $images = get_sub_field('images');
  $has_content = ($text || $images) ? true : false;
  $custom_class = ($ctr==1) ? ' first':'';
  if ($has_content) { ?>
  <section id="repeatable_<?php echo get_row_layout() ?>_<?php echo $ctr ?>" data-group="<?php echo get_row_layout() ?>" class="repeatable repeatable_<?php echo get_row_layout() ?><?php echo $custom_class ?>">
    <div class="wrapper">
      <div class="flexwrap">
        
        <?php if ($text) { ?>
        <div class="fxcol textCol">
          <?php echo anti_email_spam($text); ?>
        </div>
        <?php } ?>

        <?php if ($images) { ?>
        <div class="fxcol imageCol">
          <div class="images">
          <?php foreach ($images as $img) { 
            $imgsrc = $img['image'];
            $imgUrl = (isset($imgsrc['url']) && $imgsrc['url']) ? $imgsrc['url'] : '';
            $link = $img['link'];
            $imgTitle = ( isset($link['title']) && $link['title'] ) ? $link['title'] : '';
            $imgLink = ( isset($link['url']) && $link['url'] ) ? $link['url'] : '';
            $imgTarget = ( isset($link['target']) && $link['target'] ) ? $link['target'] : '';
            if($imgUrl) { ?>
              <figure>
                <?php if ($imgLink && $imgLink!='#') { ?>
                <a href="<?php echo $imgLink ?>" target="<?php echo $imgTarget ?>" class="imagelink">
                  <div class="inner">
                    <?php if ($imgTitle) { ?>
                    <span class="imageText"><?php echo $imgTitle ?></span>  
                    <?php } ?>
                    <img src="<?php echo $imgUrl ?>" alt="<?php echo $imgTitle ?>">
                  </div>
                </a>  
                <?php } else { ?>
                  <div class="inner">
                    <?php if ($imgTitle) { ?>
                    <span class="imageText"><?php echo $imgTitle ?></span>  
                    <?php } ?>
                    <img src="<?php echo $imgUrl ?>" alt="<?php echo $imgTitle ?>">
                  </div>
                <?php } ?>
              </figure>
            <?php } ?>
          <?php } ?>
          </div>
        </div>
        <?php } ?>

      </div>
    </div>  
  </section>
  <?php } ?>
<?php } ?>