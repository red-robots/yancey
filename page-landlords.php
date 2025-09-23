<?php
/**
 * Template Name: Landlords
 */

get_header(); ?>
<div class="content-area-full content-default-template landlords-page">
    <main id="main" class="site-main" role="main">
        <?php while ( have_posts() ) : the_post(); ?>
            <section class="repeatable repeatable_layout1 first first-section services-content">
                <div class="wrapper text-center">
                    <?php the_content() ?>
                </div>
                <?php
                    $explore_button = get_field('button');
                    $explore_button_text = (isset($explore_button['title']) && $explore_button['title']) ? $explore_button['title'] : '';
                    $explore_button_url = (isset($explore_button['url']) && $explore_button['url']) ? $explore_button['url'] : '';
                    $explore_button_target = (isset($explore_button['target']) && $explore_button['target']) ? $explore_button['target'] : '_self';

                    if($explore_button_text && $explore_button_url) {
                ?>
                    <span class="button-float-bottom">
                        <a class="button button-element" href="<?php echo $explore_button_url; ?>" target="<?php echo $explore_button_target; ?>">
                            <?php echo $explore_button_text; ?>
                            <span class="icon-open-link">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 9.83333V14.8333C14 15.2754 13.8244 15.6993 13.5118 16.0118C13.1993 16.3244 12.7754 16.5 12.3333 16.5H3.16667C2.72464 16.5 2.30072 16.3244 1.98816 16.0118C1.67559 15.6993 1.5 15.2754 1.5 14.8333V5.66667C1.5 5.22464 1.67559 4.80072 1.98816 4.48816C2.30072 4.17559 2.72464 4 3.16667 4H8.16667M11.5 1.5H16.5M16.5 1.5V6.5M16.5 1.5L7.33333 10.6667" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </span>
                <?php } ?>
            </section>
            <section class="repeatable_layout2">
                <div class="wrapper">
                    <?php
                        if( have_rows('services') ):
                            $count = 1;
                            $nav = 1;
                    ?>
                        <div class="nav services-tab" id="services" role="tablist">
                            <div class="service-item">
                                <div class="service-title">Let Us Handle It</div>
                            </div>
                            <?php while( have_rows('services') ): the_row(); 
                                $icon = get_sub_field('icon');
                                $title = get_sub_field('title');
                            ?>
                                <div class="service-item service-item-nav <?php echo ($count==1) ? "active" : ""; ?>" id="nav-<?php echo $count; ?>-tab" data-bs-toggle="tab" data-bs-target="#nav-<?php echo $count; ?>" type="button" role="tab" aria-controls="nav-<?php echo $count; ?>" aria-selected="<?php echo ($count==1) ? "true" : "false"; ?>">
                                    <?php if( !empty( $icon ) ): ?>
                                        <div class="service-icon">
                                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                                        </div>
                                    <?php endif; ?>
                                    <div class="title"><?php echo acf_esc_html( $title ); ?></div>
                                </div>
                            <?php
                                $count++;
                                endwhile;
                            ?>
                        </div>
                        <div class="tab-content services-tab-content" id="nav-services">
                            <?php while( have_rows('services') ): the_row(); 
                                $main_content = get_sub_field('main_content');
                                $content_1 = get_sub_field('content_1');
                                $content_2 = get_sub_field('content_2');
                            ?>
                                <div class="tab-pane fade <?php echo ($nav==1) ? "show active" : ""; ?> service-content" id="nav-<?php echo $nav;?>" role="tabpanel" aria-labelledby="nav-<?php echo $nav; ?>-tab">
                                    <div class="main-content"><?php echo acf_esc_html( $main_content ); ?></div>
                                    <?php if($content_1){ ?>
                                        <div class="sub-content <?php echo (!empty($content_2)) ? "half" : "full"; ?>">
                                            <div class="sub-content-1">
                                                <?php echo acf_esc_html( $content_1 ); ?>
                                            </div>
                                            <?php if($content_2){ ?>
                                                <div class="sub-content-2">
                                                    <?php echo acf_esc_html( $content_2 ); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php
                                $nav++;
                                endwhile;
                            ?>
                        </div>

                    <?php endif; ?>
                </div><!-- wrapper -->
            </section>

        <?php endwhile; ?>
    </main>
</div><!-- #primary -->
<?php
get_footer();