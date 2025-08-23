<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sport Extra
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'sport-extra' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="se-container header">
			<div class="site-branding">
				<a href="<?= home_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/img/Sport-Extra-logo.svg" height="31px" width="500px" alt="<?= get_bloginfo( 'name' ); ?>" class="skip-lazy"/>
				</a>
			</div><!-- .site-branding -->
			<div class="se-mobile-menu-container">
				<button aria-label="Menu" class="menu-toggle icon se-mobile-menu menuu" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( '', 'sport-extra' ); ?>
					<span class="hamburger">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</button>
			</div>
			<nav id="site-navigation" class="main-navigation mobile-nav">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav>
			<nav class="desktop-nav">
				<div class="desktop-only">
					<?php
					wp_nav_menu([
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu-desktop',
						'fallback_cb'    => false,
					]);
					?>
					<div class="se-header-social">
						<a href="" target="_blank" aria-label="Instagram"><img src="<?php echo get_template_directory_uri(); ?>/img/instagram-icon.svg" height="24px" width="24px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
						<a href="" target="_blank" aria-label="Facebook"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook-icon.svg" height="15px" width="32px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
						<a href="" target="_blank" aria-label="YouTube"><img src="<?php echo get_template_directory_uri(); ?>/img/youtube-icon.svg" height="15px" width="32px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
						<a href="" target="_blank" aria-label="TikTok"><img src="<?php echo get_template_directory_uri(); ?>/img/tiktok-icon.svg" height="15px" width="32px" alt="<?= get_bloginfo( 'name' ); ?>" class="style-svg"/></a>
					</div>
				</div>
				<div class="mobile-only">
					<?php
					wp_nav_menu([
						'theme_location' => 'fixed',
						'menu_id'        => 'fixed-menu-mobile',
						'fallback_cb'    => false,
					]);
					?>
				</div>
			</nav>
		</div>
	</header><!-- #masthead -->