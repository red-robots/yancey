<?php
/**
 * Template Name: About
 */

get_header(); ?>
<div class="content-area-full content-default-template about-page">
    <main id="main" class="site-main" role="main">
        <?php if( have_rows('flexible_content') ) { ?>
            <?php $ctr=1; while( have_rows('flexible_content') ): the_row(); ?>
                
                <?php include( locate_template('parts/about-layout1.php') ); ?>
                <?php include( locate_template('parts/about-layout2.php') ); ?>

            <?php $ctr++; endwhile; ?>

        <?php } ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="entry-content wrapper">
                <div class="about-content">
                    <?php the_content() ?>
                </div>
            </div>
        <?php endwhile; ?>

        <?php include( locate_template('parts/our-team.php') ); ?>
    </main>
</div><!-- #primary -->
<?php
get_footer();