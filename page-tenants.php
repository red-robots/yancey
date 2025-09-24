<?php
/**
 * Template Name: Tenants
 */

get_header(); ?>
<div class="content-area-full content-default-template about-page">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post(); ?>        
            <section class="repeatable repeatable_layout1 first first-section services-content">
                <div class="wrapper text-center">
                    <?php the_content() ?>
                </div>
                <?php if( have_rows('buttons') ): ?>
                    <div class="button-float-bottom">
                        <?php while( have_rows('buttons') ): the_row(); 
                            $explore_button = get_sub_field('button');
                            $explore_button_text = (isset($explore_button['title']) && $explore_button['title']) ? $explore_button['title'] : '';
                            $explore_button_url = (isset($explore_button['url']) && $explore_button['url']) ? $explore_button['url'] : '';
                            $explore_button_target = (isset($explore_button['target']) && $explore_button['target']) ? $explore_button['target'] : '_self';

                            if($explore_button_text && $explore_button_url) {
                        ?>
                            <a class="button button-element" href="<?php echo $explore_button_url; ?>" target="<?php echo $explore_button_target; ?>">
                                <?php echo $explore_button_text; ?>
                                <span class="icon-open-link">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14 9.83333V14.8333C14 15.2754 13.8244 15.6993 13.5118 16.0118C13.1993 16.3244 12.7754 16.5 12.3333 16.5H3.16667C2.72464 16.5 2.30072 16.3244 1.98816 16.0118C1.67559 15.6993 1.5 15.2754 1.5 14.8333V5.66667C1.5 5.22464 1.67559 4.80072 1.98816 4.48816C2.30072 4.17559 2.72464 4 3.16667 4H8.16667M11.5 1.5H16.5M16.5 1.5V6.5M16.5 1.5L7.33333 10.6667" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </a>
                        <?php
                                }
                            endwhile;
                        ?>
                    </div>
                <?php endif; ?>
            </section>

            <?php if( have_rows('flexible_content') ) { ?>
                <?php $ctr=1; while( have_rows('flexible_content') ): the_row(); ?>
                    
                    <?php include( locate_template('parts/tenants-layout1.php') ); ?>
                    <?php include( locate_template('parts/home-layout2.php') ); ?>

                <?php $ctr++; endwhile; ?>

            <?php } ?>
        <?php endwhile; ?>
    </main>
</div><!-- #primary -->
<?php
get_footer();