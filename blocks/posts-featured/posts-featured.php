<?php
/**
 * Posts featured Template.
 */

$class_name = 'posts_featured_block';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Fields
$heading         = get_field('heading');
$featured_style  = get_field('featured_style');
$post_to_display = get_field('posts_to_display');
$link_learn_more = get_field('link_learn_more');
if ($link_learn_more && !is_wp_error($link_learn_more)) {
    $learn_more_url= get_term_link($link_learn_more);
}
?>
<div class="<?php echo esc_attr( $class_name ); ?> <?php echo preg_replace('/\W+/','',strtolower(strip_tags($heading))) ?> se-block <?php echo ($featured_style == "5") ? 'se-posts-featured-5' : 'se-posts-featured-4'; ?>">
    <div class="se-container">
        <?php if($heading){ ?>
            <div class="se-posts-featured-top-section"><div class="se-posts-featured-heading"><h3><?= $heading ?></h3></div><span class="h4"><a href="<?= esc_url($learn_more_url) ?>"><?= esc_html__('Pročitaj sve','sport-extra') ?></span></a></div>
            <?php } ?>
        <div class="se-posts-featured-list">
        <?php
        if ($post_to_display) {
            $count = 0;
            foreach ($post_to_display as $selected_post) {
                setup_postdata($selected_post);
                $count++;
                // First post wrapper (style 5 only)
                if ($featured_style == "5" && $count == 1) {
                    echo '<div class="se-posts-featured-first">';
                }

                // Other posts wrapper opening (style 5 only)
                if ($featured_style == "5" && $count == 2) {
                    echo '<div class="se-posts-featured-others">';
                }
                ?>
                <article class="se-posts-featured-single">
                        <?php
                        if (has_post_thumbnail($selected_post)) { ?>
                        <div class="se-posts-featured-single-image">
                            <a href="<?php echo esc_url( get_permalink($selected_post) ); ?>">
                                <?= get_the_post_thumbnail($selected_post, 'full'); ?>
                            </a>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="se-posts-featured-single-content">
                            <h4 class="<?php if($featured_style == "5")echo'h3'?>">
                                <a href="<?php echo esc_url( get_permalink($selected_post) ); ?>">
                                    <?= esc_html( get_the_title($selected_post) ); ?>
                                </a>
                            </h4>
                        </div>

                </article>
                <?php
                // Close first post wrapper
                if ($featured_style == "5" && $count == 1) {
                    echo '</div>'; // closes .se-posts-featured-first
                }

                // Close other posts wrapper at last post
                if ($featured_style == "5" && $count == count($post_to_display) && $count > 1) {
                    echo '</div>'; // closes .se-posts-featured-others
                }
            }
            wp_reset_postdata();
        }
        ?>
        </div>
    </div>
</div>
