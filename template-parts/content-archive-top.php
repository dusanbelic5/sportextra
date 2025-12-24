<?php get_header(); ?>        

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    
    
    <?php if ( has_post_thumbnail() ) : 
        $img_id = get_post_thumbnail_id();
        $full   = wp_get_attachment_image_src($img_id, 'featured_news_image');
        $thumb  = wp_get_attachment_image_src($img_id, 'image_lazy');
    ?>
        <div class="se-post-thumbnail">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <img
                    src="<?php echo esc_url($thumb[0]); ?>"
                    data-src="<?php echo esc_url($full[0]); ?>"
                    width="<?php echo esc_attr($full[1]); ?>"
                    height="<?php echo esc_attr($full[2]); ?>"
                    class="lazy-blur featured-image"
                    alt="<?php echo esc_attr(get_the_title()); ?>"
                >
            </a>
        </div>
    <?php endif; ?>
    
    <div class="entry-header">
        <span class="h3"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></span>
        <div class="se-post-entry-meta">
            <div class="se-meta-author-image-part">
            </div>
            <div class="se-meta-info-part">
                <span class="se-date">
                    <?php
                    $timestamp = get_post_time('U');
                    echo date_i18n('d.m.Y', $timestamp) . ' - ' . date_i18n('H:i', $timestamp);
                    ?>
                </span>
            </div>
        </div>
    </div>

</article>
