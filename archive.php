<?php
get_header();
?>

<main id="primary" class="site-main se-container">
    <div class="se-archive-content-part">
        <h1 class="page-title"><?php single_cat_title(); ?></h1>
        <?php the_archive_description('<div class="archive-description">', '</div>'); ?>

        <?php if ( have_posts() ) : ?>

            <?php
            $paged = max( 1, get_query_var('paged') );

            // ------------------------------
            // FIRST PAGE
            // ------------------------------
            if ( $paged === 1 ) :

                $counter = 0;

                while ( have_posts() ) : the_post();

                    // ---- FIRST POST ----
                    if ( $counter === 0 ) :

                        get_template_part('template-parts/content-archive-main', get_post_type());

                        echo '<div class="special-archive-section">';

                    
                        if ( is_category() ) :

                            $current_category = get_queried_object();
                            $current_category_slug = $current_category->slug;

                            // Count total posts in this category
                            $total_posts_in_category = new WP_Query(array(
                                'post_type'      => 'post',
                                'posts_per_page' => -1,
                                'category_name'  => $current_category_slug,
                                'fields'         => 'ids',
                            ));
                            
                            if ( $total_posts_in_category->found_posts >= 8 ) :

                                $args_scrolling = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 5,
                                    'offset'         => 3,
                                    'category_name'  => $current_category_slug,
                                    'post__not_in'   => array( get_the_ID() ),
                                );

                                $scrolling_news_query = new WP_Query($args_scrolling);
                                $block_class = 'scrolling_news_block';
                                ?>

                                <div class="<?php echo esc_attr($block_class); ?> se-block">
                                    <div class="se-container">
                                        <div class="se-scrolling-news-container">
                                            <div class="se-scrolling-news-heading">
                                                <span><?= _e('Najnovije vesti','sport-extra'); ?></span>
                                            </div>
                                            <ul class="se-scrolling-news-list">
                                                <?php if ( $scrolling_news_query->have_posts() ) : ?>

                                                    <?php while ( $scrolling_news_query->have_posts() ) : $scrolling_news_query->the_post();
                                                        $time = get_the_time('H:i'); ?>
                                                        <li>
                                                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                                                <span><?php echo esc_html($time); ?></span>
                                                                <span><?php the_title(); ?></span>
                                                            </a>
                                                        </li>
                                                    <?php endwhile; ?>

                                                    <?php
                                                    // Duplicate for scrolling effect
                                                    $scrolling_news_query->rewind_posts();
                                                    while ( $scrolling_news_query->have_posts() ) : $scrolling_news_query->the_post();
                                                        $time = get_the_time('H:i'); ?>
                                                        <li aria-hidden="true">
                                                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                                                <span><?php echo esc_html($time); ?></span>
                                                                <span><?php the_title(); ?></span>
                                                            </a>
                                                        </li>
                                                    <?php endwhile; ?>

                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                wp_reset_postdata(); 

                            endif; // End check for 8 posts

                        endif;


                        // OPEN TOP LIST
                        echo '<div class="se-archive-list-top">';

                    // ---- NEXT 3 POSTS (counters 1–3) ----
                    elseif ( $counter >= 1 && $counter <= 3 ) :

                        get_template_part('template-parts/content-archive-top', get_post_type());

                        if ( $counter === 3 ) :
                            echo '</div><div class="se-archive-list-bottom">';
                        endif;

                    // ---- NEXT 8 POSTS (counters 4–11) ----
                    elseif ( $counter >= 4 && $counter <= 11 ) :

                        get_template_part('template-parts/content-archive-bottom', get_post_type());

                    endif;

                    $counter++;

                endwhile;

                // Close bottom list if opened
                if ( $counter > 4 ) :
                    echo '</div>';
                endif;

            // ------------------------------
            // PAGE 2+ (ALL POSTS BOTTOM)
            // ------------------------------
            else :

                echo '<div class="se-archive-list-bottom secondary">';

                while ( have_posts() ) : the_post();
                    get_template_part('template-parts/content-archive-bottom', get_post_type());
                endwhile;

                echo '</div>'; // close bottom container

            endif;
            ?>

            <?php the_posts_pagination(array(
                'mid_size'  => 10,
                'prev_text' => __('«', 'sport_extra'),
                'next_text' => __('»', 'sport_extra'),
            )); ?>

        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>
    </div>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
