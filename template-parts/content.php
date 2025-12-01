<?php get_header(); ?>
<?php
$author_id = get_the_author_meta('ID');
$author_image = get_field('author_image', 'user_'. $author_id );
if(!$author_image){
    $author_image = get_template_directory_uri().'/img/author-image.jpg';
}
?>

    
    <div class="se-single-content-wrapper">
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="se-post-thumbnail">
                    <?php the_post_thumbnail('full', ['class' => 'featured-image']); ?>
                </div>
            <?php endif; ?>
            
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
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
            </header>
            
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            
            <?php the_tags( '<span class="se-tags">', '', '</span>' ); ?>
            <?php
                // Comments go here, only on single posts
                if ( is_singular() && ( comments_open() || get_comments_number() ) ) :
                    echo '<div class="se-comments-wrapper">';
                    comments_template();
                    echo '</div>';
                endif;
            ?>
            <div class="se-container">
			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Prethodna vest:', 'sport-extra' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Sledeća vest:', 'sport-extra' ) . '</span> <span class="nav-title">%title</span>',
				)
			);
			?>
			</div>
        </article>
        
        <!-- Sidebar -->
        <?php if ( is_active_sidebar( 'single-sidebar' ) ) : ?>
            <aside class="sidebar">
                <?php dynamic_sidebar( 'single-sidebar' ); ?>
            </aside>
        <?php endif; ?>
        
    </div><!-- .content-wrapper -->

