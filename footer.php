<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sport_Extra
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="se-container">
			<div class="se-footer-top">
				<div class="se-site-info">
					© Sport Extra <?= currentYear();?> - <?= esc_html__( 'Sva prava zadržana', 'sport-extra') ?>
				</div>
			</div>
			<div class="se-footer-bottom">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_id'        => 'footer-menu',
						)
					);
				?>
				<div class="se-footer-social">
					<a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/instagram-icon.svg" height="15px" width="32px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
					<a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook-icon.svg" height="15px" width="32px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
					<a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/youtube-icon.svg" height="15px" width="32px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
					<a href="" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/tiktok-icon.svg" height="15px" width="32px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
