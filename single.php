<?php
get_header();
?>

<main id="primary" class="site-main se-container se-single-post">

    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', get_post_type() );


		var_dump(comments_template());
		
        // Only display comments on single posts
        if ( comments_open() || get_comments_number() ) :
            echo '<div class="se-comments-wrapper">';
            comments_template();
            echo '</div>';
        endif;

    endwhile;
    ?>

</main>

<?php
get_footer();
?>
