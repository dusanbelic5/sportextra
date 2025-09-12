<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sport_Extra
 */

get_header();
?>

<main id="primary" class="site-main se-container">
        <div class="se-archive-content-part">
        <h1 class="page-title"><?php single_cat_title(); ?></h1>
        <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

        <?php if ( have_posts() ) : ?>

            <?php
            $counter = 0;
            while ( have_posts() ) : the_post();
                if ( $counter === 0 ) {
                    // First post (special template)
                    get_template_part( 'template-parts/content-archive-main', get_post_type() );
                    echo '<div class="se-archive-list">';
                } else {
                    // Normal posts
                    get_template_part( 'template-parts/content-archive', get_post_type() );
                }
                $counter++;
            endwhile;
            echo '</div>'; // close se-archive-list
            ?>

            <?php
            the_posts_pagination( array(
                'mid_size'  => 10,
                'prev_text' => __( '«', 'sport_extra' ),
                'next_text' => __( '»', 'sport_extra' ),
            ) );
            ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>
        </div>
            <?php if ( is_active_sidebar( 'single-sidebar' ) ) : ?>
            <aside class="sidebar">
                <?php dynamic_sidebar( 'single-sidebar' ); ?>
            </aside>
        <?php endif; ?>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
