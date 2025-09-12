<?php get_header(); ?>
<?php
$author_id = get_the_author_meta('ID');
$author_image = get_field('author_image', 'user_'. $author_id );
if(!$author_image){
    $author_image = get_template_directory_uri().'/img/author-image.jpg';
}
?>
    <div class="se-single-archive-main">
        
        <!-- Main article content -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="se-post-thumbnail">
                    <?php the_post_thumbnail('full', ['class' => 'featured-image']); ?>
                </div>
            <?php endif; ?>
            
            <div class="entry-header">
                <span class="h1"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></span>
                <div class="se-post-entry-meta">
                    <div class="se-meta-author-image-part">
                         <a href="<?php echo get_author_posts_url( $post->post_author); ?>"><img src="<?= $author_image ?>"/></a>
                    </div>
                    <div class="se-meta-info-part">
                        <span class="se-author"><a href="<?php echo get_author_posts_url( $post->post_author); ?>"><?php the_author(); ?></a></span>
                        <span class="se-date">
                            <?php
                            $timestamp = get_post_time('U');
                            echo date_i18n( 'd.m.Y', $timestamp ) .' - '.date_i18n('H:i', $timestamp);
                            ?>
                        </span>
                    </div>
                </div>
            </div>

        </article>
        
    </div><!-- .content-wrapper -->