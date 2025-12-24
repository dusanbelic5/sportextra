<?php get_header(); ?>        

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>

<?php
if ( has_post_thumbnail() ) {
    $img_id = get_post_thumbnail_id();
    $full   = wp_get_attachment_image_src( $img_id, 'posts_featured_image' );
    $thumb  = wp_get_attachment_image_src( $img_id, 'image_lazy' );

    $img_src    = $thumb[0];
    $img_data   = $full[0];
    $img_width  = $full[1];
    $img_height = $full[2];
} else {
    // fallback image from theme
    $img_src    = get_theme_file_uri( 'img/default-thumbnail-44-25.webp' );
    $img_data   = get_theme_file_uri( 'img/default-thumbnail-324-182.webp' );
    $img_width  = 324;
    $img_height = 182;
}
?>

    <div class="se-post-thumbnail">
        <a href="<?php echo esc_url( get_permalink() ); ?>">
            <img
                src="<?php echo esc_url( $img_src ); ?>"
                data-src="<?php echo esc_url( $img_data ); ?>"
                width="<?php echo esc_attr( $img_width ); ?>"
                height="<?php echo esc_attr( $img_height ); ?>"
                class="lazy-blur featured-image"
                alt="<?php echo esc_attr( get_the_title() ); ?>"
            >
        </a>
    </div>

    <div class="entry-header">
        <span class="h4">
            <a href="<?php echo esc_url( get_permalink() ); ?>">
                <?php the_title(); ?>
            </a>
        </span>

        <div class="se-post-entry-meta">
            <div class="se-meta-author-image-part"></div>

            <div class="se-meta-info-part">
                <span class="se-date">
                    <?php
                    $timestamp = get_post_time( 'U' );
                    echo date_i18n( 'd.m.Y', $timestamp ) . ' - ' . date_i18n( 'H:i', $timestamp );
                    ?>
                </span>
            </div>
        </div>
    </div>

</article>
