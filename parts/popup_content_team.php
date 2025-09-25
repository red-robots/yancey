<?php 
$post_id = $post->ID;
$thumbId = get_post_thumbnail_id($post);
$img = wp_get_attachment_image_src($thumbId,'full');
$image_style = ($img) ? ' style="background-image:url('.$img[0].')"':'';
$imgURL = ($img) ? $img[0]:'';
$imgALT = ($img) ? get_the_title($thumbId):'';

$position = get_field('title',$post_id);
$content = apply_filters('the_content', $post->post_content);

if( $img = get_field('tile_image',$post_id) ) {
  $image_style = ($img) ? ' style="background-image:url('.$img['url'].')"':'';
  $imgURL = ($img) ? $img['url']:'';
  $imgALT = ($img) ? $img['title']:'';
}
$phone = get_field('phone',$post_id);
$email = get_field('email',$post_id);
$linkedin_url = get_field('linkedin_url',$post_id);
$instagram_url = get_field('instagram_url',$post_id);
?>
<div class="popup-content activity">
  <a href="javascript:void(0)" id="closeModalBtn"><span>close</span></a>
  <div class="middle-content">
    <div class="flex-wrap member-header">
        <?php if ($imgURL) { ?>
            <div class="photo">
                <figure <?php echo $image_style ?>>
                <img src="<?php echo $img['sizes']['big-square']; ?>" alt="">
                <img src="<?php echo THEMEURI ?>images/image-helper.png" alt="">
            </figure>
            </div>
        <?php } ?>
        <div class="text">
            <h2 class="member-title"><?php echo $post->post_title; ?></h2>
            <div class="member-position"><?php echo $position; ?></div>
            <div class="divider"></div>
            <div class="member-phone">
                <a href="tel:<?php echo format_phone_number($phone) ?>"><?php echo localize_us_number($phone); ?></a>
            </div>
            <div class="member-email"><?php echo anti_email_spam($email); ?></div>
            <?php if($instagram_url || $linkedin_url){ ?>
                <div class="member-socials">
                    <?php if($linkedin_url){ ?>
                        <a href="<?php echo $linkedin_url; ?>" target="_blank">
                            <i class="fa-brands fa-linkedin"></i>
                        </a>
                    <?php } if($instagram_url){ ?>
                        <a href="<?php echo $instagram_url; ?>" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if ( $content ) { ?>
        <div class="member-content"><?php echo $content; ?></div>
    <?php } ?>
  </div>
</div>
