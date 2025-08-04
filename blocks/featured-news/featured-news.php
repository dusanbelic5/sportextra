<?php
/**
 * Hero Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Create class attribute allowing for custom "className".
$class_name       = 'featured_news_block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Fields
$post    = get_field('post');
$heading = get_field('heading');
$left_id = get_field('news_on_left');
$right_id = get_field('news_on_right');


$args_left = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'offset'         => empty($left_id) ? 1 : 0,
);

if (!empty($left_id)) {
    $args_left['p'] = $left_id;
}

$args_right = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'offset'         => empty($right_id) ? 2 : 0,
);

if (!empty($right_id)) {
    $args_right['p'] = $right_id;
}

$featured_news_query_left = new WP_Query($args_left);
$featured_news_query_right = new WP_Query($args_right);
?>
<div class="<?php echo esc_attr( $class_name ); ?> <?php echo preg_replace('/\W+/','',strtolower(strip_tags($heading)))?> se-block">
    <div class="se-container">
        <div class="se-featured-news-block-container">
            <div class="se-featured-news-left">
            <?php if ($featured_news_query_left->have_posts()) : ?>
                <?php while ($featured_news_query_left->have_posts()) : $featured_news_query_left->the_post(); ?>
                    <?php the_post_thumbnail('full'); ?>

                    <div class="featured-news-post-title-content">
                        <h2>
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            </div>

            <div class="se-featured-news-right">
                <?php if ($featured_news_query_right->have_posts()) : ?>
                    <?php while ($featured_news_query_right->have_posts()) : $featured_news_query_right->the_post(); ?>
                        <?php the_post_thumbnail('full'); ?>

                        <div class="featured-news-post-title-content">
                            <h2>
                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
