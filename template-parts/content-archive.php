<?php get_header(); ?>
<?php

?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <!-- Featured Image -->
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="se-post-thumbnail">
                    <a href="<?php echo esc_url(get_permalink()); ?>">
                        <?php the_post_thumbnail('full', ['class' => 'featured-image']); ?>
                    </a>
                </div>
            <?php endif; ?>
            
            <header class="entry-header">
                <span class="h3"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></span>
                <div class="se-post-entry-meta">
                    <div class="se-meta-author-image-part">
                    </div>
                    <div class="se-meta-info-part">
                        <span class="se-date">
                            <?php
                            $timestamp = get_post_time('U');
                            echo date_i18n( 'd.m.Y', $timestamp ) .' - '.date_i18n('H:i', $timestamp);
                            ?>
                        </span>
                    </div>
                </div>
            </header>
            

        </article>


