<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Sport_Extra
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found se-container">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Nažalost, stranica koju tražite nije pronađena', 'sport-extra' ); ?></h1>
			</header><!-- .page-header -->

			<div>
				<p class="h2"><?php esc_html_e( 'Pogledajte naše najnovije vesti', 'sport-extra' ); ?></p>
<?php

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
];

$query = new WP_Query($args);
?>

<div class="se-block posts_featured_block se-posts-featured-4">
        <div class="se-posts-featured-list">

            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post();

                    $img_id = get_post_thumbnail_id(get_the_ID());
                    $full   = wp_get_attachment_image_src($img_id, 'posts_featured_image');
                    $thumb  = wp_get_attachment_image_src($img_id, 'image_lazy');
                ?>
                    <article class="se-posts-featured-single">

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="se-posts-featured-single-image">
                                <a href="<?php the_permalink(); ?>">
                                    <img
                                        src="<?php echo esc_url($thumb[0]); ?>"
                                        data-src="<?php echo esc_url($full[0]); ?>"
                                        width="<?php echo esc_attr($full[1]); ?>"
                                        height="<?php echo esc_attr($full[2]); ?>"
                                        class="lazy-blur"
                                        alt="<?php the_title_attribute(); ?>"
                                    >
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="se-posts-featured-single-content">
                            <span class="h4">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </span>
                        </div>

                    </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

        </div>
</div>

</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
