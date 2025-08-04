<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sport Extra
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="se-container">
	<header class="entry-header">
		<?php $tags = get_tags(); ?>
		<div class="entry/tags">
			Topics:
		<?php foreach ( $tags as $tag ) { ?>
			<a href="<?php echo get_tag_link( $tag->term_id ); ?> " rel="tag"><?php echo $tag->name; ?></a>
		<?php } ?>
		</div>
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			echo '<div class="ea-post-category">'.$firstCategory."</div>";
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		if ( 'post' === get_post_type() ) :

			?>
			<div class="entry-meta">

			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

<?php do_shortcode("[no_toc]"); ?>
	<div class="entry-content">
		<div class="ea-blog-single-main">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'sport-extra' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sport-extra' ),
				'after'  => '</div>',
			)
		);
		?>
	<div class="ea-post-author">
	<?php $author_id = get_the_author_meta('ID');
$author_image = get_field('author_image', 'user_'. $author_id );
if($author_image){ ?>
			<div class="ea-post-author-left">
				<div class="ea-post-author-photo">
    <img src="<?php echo esc_url($author_image['url']); ?>" alt="<?php echo esc_attr($author_image['alt']); ?>" width="<?php echo esc_attr($author_image['width']); ?>" height="<?php echo esc_attr($author_image['height']); ?>" />

</div>
			</div>
			<?php } ?>
			<div class="ea-post-author-right">
				<h3 class="ea-post-author-name"><?php the_author_meta('display_name'); ?></h3>
				<p class="ea-post-author-description"><?php echo nl2br( get_the_author_meta('description') ); ?></p>
			</div>
		</div>
		<?php

$postSources = get_field( 'post_sources' );
if ( $postSources ) {
	?>
	<div class="block block-section block-section-sources">
		<div class="container">
			<div class="block-inner">
				<div class="block-header">
					<h2 class="block-title">
						<?php _e( 'Quellenangaben', 'sport-extra' ); ?>
					</h2>
				</div>
				<div class="block-body">
					<ul class="list-unstyled list-sources">
						<?php
						foreach ( $postSources as $k => $v ) {
							if ( ! $v['url'] ) {
								continue;
							}
							?>
							<li>
								<em>[<?= $k + 1 ?>]</em> <a href="<?= $v['url'] ?>" target="_blank" rel="nofollow noopener"><?= $v['text'] ?></a>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php
}?>
	</div><!-- .entry-content -->
	<div class="sidebar">
	<?php get_sidebar(); ?>
	</div>
	</div>

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->