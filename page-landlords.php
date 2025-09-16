<?php
/**
 * Template Name: Landlords
 */

get_header(); ?>
<div class="content-area-full content-default-template landlords-page">
    <main id="main" class="site-main" role="main">
        <?php if( have_rows('flexible_content') ) { ?>
            
            <?php $ctr=1; while( have_rows('flexible_content') ): the_row(); ?>
            
            <?php include( locate_template('parts/home-layout1.php') ); ?>
            <?php include( locate_template('parts/home-layout2.php') ); ?>
            
            <?php $ctr++; endwhile; ?>

        <?php } else { ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="entry-content">
                <?php the_content() ?>
            </div>
            <?php endwhile; ?>
        <?php } ?>
    </main>
</div><!-- #primary -->
<?php
get_footer();