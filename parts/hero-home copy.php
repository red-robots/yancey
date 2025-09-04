<?php 
$hero_type = get_field('hero_type');
$static = get_field('static_image_block');
$add_caption = (isset($static['add_caption'])) ? $static['add_caption'] : '';
$static_image = (isset($static['static_image'])) ? $static['static_image'] : '';
$static_title = (isset($static['title'])) ? $static['title'] : '';
$static_description = (isset($static['description'])) ? $static['description'] : '';
$static_buttons = (isset($static['buttons'])) ? $static['buttons'] : '';
$sliderImages = get_field('slider');

//STATIC IMAGE
if ($hero_type=='static_image') { ?>

  <?php if ($static_image) { ?>
  <section class="hero hero-<?php echo $hero_type ?>">
    <?php 
    $slideTitle = $static_title;
    $slideText = $static_description;
    $slideImage = $static_image;
    ?>
    <div class="static-hero">
      <?php if ($add_caption) { ?>
      
        <?php if ($slideTitle || $slideText) { ?>
        <div class="slideCaption">
          <div class="inside">
          <?php if ($slideTitle) { ?>
            <div class="title"><?php echo $slideTitle ?></div>
          <?php } ?>
          <?php if ($slideText) { ?>
            <div class="text"><?php echo $slideText ?></div>
          <?php } ?>

            <?php if ($static_buttons) { ?>
            <div class="slideButton">
              <?php foreach ($static_buttons as $b) { 
                $btn = $b['button'];
                $btnName = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '';
                if ($btnName && $btnLink) { ?>
                  <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><span><?php echo $btnName ?></span></a>
                <?php } ?>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>

      <?php } ?>
      <figure class="slideImage">
        <!-- <span class="image" style="background-image:url(<?php //echo $slideImage['url'] ?>)"></span> -->
        <img src="<?php echo $slideImage['url'] ?>" role="presentation" alt="">
      </figure>
    </div>
  </section>
  <?php } ?>

  
<?php } else {

  //SLIDESHOW

  if($sliderImages) { $countSlides = count($sliderImages);  ?>
  <section class="hero hero-<?php echo $hero_type ?> count-<?php echo $countSlides ?>">
    <div id="homeSlider" class="swiper-container slideshow">
      <div class="swiper-wrapper">
        <?php foreach ($sliderImages as $s) { 
          $slideImage = $s['slideImage'];
          $slideTitle = $s['slideTitle'];
          $slideText = $s['slideText'];
          $slideButton = $s['slideButton'];
          $btnName = (isset($slideButton['title']) && $slideButton['title']) ? $slideButton['title'] : '';
          $btnLink = (isset($slideButton['url']) && $slideButton['url']) ? $slideButton['url'] : '';
          $btnTarget = (isset($slideButton['target']) && $slideButton['target']) ? $slideButton['target'] : '';
          if($slideImage) { ?>
          <div class="swiper-slide">
            <?php if ($slideTitle || $slideText) { ?>
            <div class="slideCaption">
              <div class="inside">
              <?php if ($slideTitle) { ?>
                <div class="title"><?php echo $slideTitle ?></div>
              <?php } ?>
              <?php if ($slideText) { ?>
                <div class="text"><?php echo $slideText ?></div>
              <?php } ?>
              <?php if ($btnName && $btnLink) { ?>
                <div class="slideButton">
                    <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><span><?php echo $btnName ?></span></a>
                </div>
              <?php } ?>
              </div>
            </div>
            <?php } ?>
            <div class="slideImage" style="background-image:url('<?php echo $slideImage['url'] ?>')"></div>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </section>
  <?php } ?>

<?php } ?>