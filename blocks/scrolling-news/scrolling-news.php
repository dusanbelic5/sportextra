<?php
/**
 * Scrolling news Template
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
$class_name       = 'scrolling_news_block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Fields
$heading = get_field('heading');

$args_scrolling = array(
    'post_type'      => 'post',
    'posts_per_page' => 5,
);

$scrolling_news_query = new WP_Query($args_scrolling);
?>
<div class="<?php echo esc_attr( $class_name ); ?> <?php echo preg_replace('/\W+/','',strtolower(strip_tags($heading)))?> se-block">
    <div class="se-container">
        <div class="se-scrolling-news-container">
        <div class="se-scrolling-news-heading">
            <span><?= $heading ?></span>
        </div>
        <ul class="se-scrolling-news-list">
            <?php if ( $scrolling_news_query->have_posts() ) : ?>

            <?php
            // 1st pass
            while ( $scrolling_news_query->have_posts() ) : $scrolling_news_query->the_post();
                $time = get_the_time('H:i'); ?>
                <li>
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                    <span><?= esc_html( $time ); ?></span>
                    <span><?php the_title(); ?></span>
                    </a>
                </li>
            <?php endwhile; ?>

            <?php
            // 2nd pass (duplicate)
            $scrolling_news_query->rewind_posts();
            while ( $scrolling_news_query->have_posts() ) : $scrolling_news_query->the_post();
                $time = get_the_time('H:i'); ?>
                <li aria-hidden="true">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                    <span><?= esc_html( $time ); ?></span>
                    <span><?php the_title(); ?></span>
                    </a>
                </li>
            <?php endwhile; ?>

            <?php endif; ?>
        </ul>
    </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
