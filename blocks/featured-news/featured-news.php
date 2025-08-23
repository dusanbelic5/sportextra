<?php
/**
 * Featured news Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */


$class_name       = 'featured_news_block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Fields
$post    = get_field('post');
$heading = get_field('heading');
$left_id = get_field('article_on_left');
$middle_id = get_field('article_on_middle');
$right_id = get_field('article_on_right');


$args_left = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'offset'         => empty($left_id) ? 1 : 0,
);

if (!empty($left_id)) {
    $args_left['p'] = $left_id;
}

$args_middle = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'offset'         => empty($middle_id) ? 1 : 0,
);

if (!empty($middle_id)) {
    $args_middle['p'] = $middle_id;
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
$featured_news_query_middle = new WP_Query($args_middle);
$featured_news_query_right = new WP_Query($args_right);
?>
<div class="<?php echo esc_attr( $class_name ); ?> <?php echo preg_replace('/\W+/','',strtolower(strip_tags($heading)))?> se-block">
    <div class="se-container">
        <div class="se-featured-news-block-container">
            <article class="se-featured-news-single">
            <?php if ($featured_news_query_left->have_posts()) : ?>
                <?php while ($featured_news_query_left->have_posts()) : $featured_news_query_left->the_post(); ?>
                <div class="se-featured-news-image-category">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php the_post_thumbnail('full'); ?>
                    </a>
                    <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <span class="se-post-category">
                                <?php
                                foreach ($categories as $category) {
									echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                                    echo esc_html($category->name);
									echo '</a>';
                                    break;
                                }
                                ?>
                            </span>
                    <?php endif; ?>
                </div>
                <div class="featured-news-post-title-content">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <h2>
                        <?php the_title(); ?>
                        </h2>
                    </a>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
            </article>

            <article class="se-featured-news-single">
            <?php if ($featured_news_query_middle->have_posts()) : ?>
                <?php while ($featured_news_query_middle->have_posts()) : $featured_news_query_middle->the_post(); ?>
                <div class="se-featured-news-image-category">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php the_post_thumbnail('full'); ?>
                    </a>
                    <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <span class="se-post-category">
                                <?php
                                foreach ($categories as $category) {
									echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                                    echo esc_html($category->name);
									echo '</a>';
                                    break;
                                }
                                ?>
                            </span>
                    <?php endif; ?>
                </div>
                <div class="featured-news-post-title-content">
                    <h2>
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
            </article>

            <article class="se-featured-news-single">
            <?php if ($featured_news_query_right->have_posts()) : ?>
                <?php while ($featured_news_query_right->have_posts()) : $featured_news_query_right->the_post(); ?>
                <div class="se-featured-news-image-category">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php the_post_thumbnail('full'); ?>
                    </a>
                    <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <span class="se-post-category">
                                <?php
                                foreach ($categories as $category) {
									echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">';
                                    echo esc_html($category->name);
									echo '</a>';
                                    break;
                                }
                                ?>
                            </span>
                    <?php endif; ?>
                </div>
                <div class="featured-news-post-title-content">
                    <h2>
                        <a href="<?php echo esc_url(get_permalink()); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
            </article>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
