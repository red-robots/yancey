<?php 
$hero = get_field('static_image');
$hero_mobile = get_field('static_image_mobile');

$static_image = (isset($hero)) ? $hero : '';
$static_image_mobile = (isset($hero_mobile)) ? $hero_mobile : '';

if ($static_image) { ?>
  <section class="hero hero-static_image hero-internal">
    <div class="imageCaption">
      <div class="inside">
        <div class="title"><?php the_title(); ?></div>
      </div>
    </div>
    <div class="static-hero">
      <figure class="image">
        <img src="<?php echo $static_image['url'] ?>" role="presentation" alt="" class="image-desktop">
        <?php if ($static_image_mobile) { ?>
        <img src="<?php echo $static_image_mobile['url'] ?>" role="presentation" alt="" class="image-mobile">
        <?php } ?>
      </figure>
    </div>
  </section>
<?php } ?>