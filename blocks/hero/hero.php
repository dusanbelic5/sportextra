<?php
/**
 * Hero Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */


$class_name       = 'hero_block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Fields
$post    = get_field('post');
$heading = get_field('heading');

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
);

if (!empty($post)) {
    $args['p'] = $post; // Override offset with specific post ID
}

$hero_query = new WP_Query($args);
?>
<div class="<?php echo esc_attr( $class_name ); ?> <?php echo preg_replace('/\W+/','',strtolower(strip_tags($heading)))?> se-block">
    <div class="se-container">
        <div class="se-hero-block-container">
            <?php if ($hero_query->have_posts()) : ?>
                <?php while ($hero_query->have_posts()) : $hero_query->the_post(); ?>
                    <?php the_post_thumbnail('full'); ?>
                    <div class="hero-post-title-content">
                        <?php
                        $categories = get_the_category();
                        if (!empty($categories)) :
                        ?>
                            <span class="post-category">
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
                        <span class="h1">
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <?php the_title(); ?>
                            </a>
                        </span>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
