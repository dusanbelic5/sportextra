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
				<?php
				wp_nav_menu(array(
					'theme_location'  => 'footer',
					'menu_id'         => 'footer-menu',
					'menu_class'      => 'menu',
					'container'       => 'div',
					'container_id'    => 'footer-menu-container',
					'container_class' => 'footer-menu-container',
				));
				?>
				<?php
				wp_nav_menu(array(
					'theme_location'  => 'footer-categories',
					'menu_id'         => 'footer-categories',
					'menu_class'      => 'menu',
					'container'       => 'div',
					'container_id'    => 'footer-categories-container',
					'container_class' => 'footer-menu-container',
				));
				?>
			</div>
			<div class="se-footer-bottom">

				<div class="se-site-info">
					© Sport Extra <?= currentYear();?> - <?= esc_html__( 'Sva prava zadržana', 'sport-extra') ?>
				</div>
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
