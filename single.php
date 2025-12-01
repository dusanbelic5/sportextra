<?php
get_header();
?>

<main id="primary" class="site-main se-container se-single-post">

    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', get_post_type() );

    endwhile;
    ?>

</main>

<?php
get_footer();
?>
