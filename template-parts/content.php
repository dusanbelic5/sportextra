<?php get_header(); ?>

<main id="primary" class="site-main se-container se-single-post">
    
    <div class="se-single-content-wrapper">
        
        <!-- Main article content -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="se-post-thumbnail">
                    <?php the_post_thumbnail('full', ['class' => 'featured-image']); ?>
                </div>
            <?php endif; ?>
            
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                
                <div class="entry-meta">
                    <span class="se-author"><?php the_author(); ?></span> -
                    <span class="se-date">
                        <?php
                        $timestamp = get_post_time('U');
                        echo date_i18n( 'd.m.Y. H:i', $timestamp );
                        ?>
                    </span>
                </div>
            </header>
            
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            
            <footer class="entry-footer">
                <?php the_tags( '<span class="se-tags">', '', '</span>' ); ?>
            </footer>
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

</main>


