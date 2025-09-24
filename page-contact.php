<?php
/**
 * Template Name: Contact
 */

get_header(); ?>
<div id="overlay"></div>
<div id="popup-content"></div>
<div id="primary" class="content-area-full content-default-template contact-page">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <section class="contact-wrapper repeatable_layout2 repeatable">
                <div class="wrapper">
                    <div class="flexwrap">
                        <?php
                            $address = get_field('address');
                            $address_title = get_field('address_title');
                            $contact_form_title = get_field("contact_form_title");
                            $contact_form = get_field("contact_form_shortcode");

                            if( $address && have_rows('management') ){
                        ?>
                            <div class="fxcol contactCol">
                                <div class="address">
                                    <div><?php echo $address_title; ?></div>
                                    <div><?php echo $address; ?></div>
                                </div>
                                <?php while(have_rows('management')): the_row();
                                        $team = get_sub_field('team');
                                        $post_id = $team->ID;
                                        $name = get_the_title($post_id);
                                        $position = get_field('title', $post_id);

                                        if($name || $position) {
                                    ?>
                                        <div class="info" data-postid="<?php echo $post_id; ?>" class="fxcol teamCol team-<?php echo $post_id; ?>">
                                            <a href="javascript:void(0)" data-id="<?php echo $post_id; ?>" class="popup-activity">
                                                <div class="name"><?php echo $name; ?></div> 
                                                <div class="position"><?php echo $position; ?></div>
                                            </a>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                            <?php if( $contact_form ){ ?>
                                <div class="fxcol formCol">
                                    <div class="wrap">
                                        <h3><?php echo $contact_form_title; ?></h3>
                                        <?php echo $contact_form; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="backgroundColor">
                                <span class="stripe"></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();