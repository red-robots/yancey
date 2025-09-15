<?php
/**
 * Template Name: Contact
 */

get_header(); ?>
<div id="primary" class="content-area-full content-default-template contact-page">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <section class="contact-wrapper repeatable_layout2 repeatable">
                <div class="wrapper">
                    <div class="flexwrap">
                        <?php
                            $address = get_field('address');
                            $address_title = get_field('address_title');

                            if( $address && have_rows('management') ){
                        ?>
                            <div class="fxcol contactCol">
                                <div class="address">
                                    <div><?php echo $address_title; ?></div>
                                    <div><?php echo $address; ?></div>
                                </div>
                                <?php while(have_rows('management')): the_row();
                                        $name = get_sub_field('name');
                                        $position = get_sub_field('position');

                                        if($name || $position) {
                                    ?>
                                        <div class="info">
                                            <div class="name"><?php echo $name; ?></div> 
                                            <div class="position"><?php echo $position; ?></div>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php } ?>
                        <?php if( $contact_form = get_field("contact_form_shortcode") ){ ?>
                            <div class="fxcol formCol">
                                <div class="wrap">
                                    <?php echo $contact_form; ?>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="backgroundColor">
                            <span class="stripe"></span>
                        </div>
                    </div>
                </div>
            </section>
        <?php endwhile; ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();