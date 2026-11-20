<?php
/**
 * Site header.
 *
 * @package HedwigusJournal
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<script>
		(function () {
			try {
				var saved = localStorage.getItem('hedwigus-theme');
				var prefers = window.matchMedia('(prefers-color-scheme: dark)').matches;
				var useDark = saved ? saved === 'dark' : <?php echo (bool) get_theme_mod( 'hedwigus_dark_default', false ) ? 'true' : ( 'prefers' ); ?>;
				if (useDark) document.documentElement.setAttribute('data-theme', 'dark');
			} catch (e) {}
		})();
	</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hedwigus-journal' ); ?></a>

<header class="site-header">
	<div class="wrap header-inner">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<div class="site-logo"><?php the_custom_logo(); ?></div>
			<?php else : ?>
				<span class="site-logo" aria-hidden="true">H</span>
			<?php endif; ?>
			<div>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<span class="site-description"><?php bloginfo( 'description' ); ?></span>
			</div>
		</div>

		<nav class="main-navigation" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'hedwigus-journal' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'fallback_cb'    => 'hedwigus_default_menu',
				'depth'          => 2,
			) );
			?>
		</nav>

		<div class="header-tools">
			<button class="search-toggle" id="searchToggle" type="button" aria-expanded="false" aria-controls="headerSearch">
				<?php esc_html_e( 'Cari', 'hedwigus-journal' ); ?>
			</button>
			<button class="icon-btn" id="themeToggle" type="button" aria-label="<?php esc_attr_e( 'Ubah tema', 'hedwigus-journal' ); ?>" title="<?php esc_attr_e( 'Ubah tema', 'hedwigus-journal' ); ?>">
				<svg class="icon-moon" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M20 14.5A8.5 8.5 0 0 1 9.5 4a8.5 8.5 0 1 0 10.5 10.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
				<svg class="icon-sun" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/><path d="M12 2v2m0 16v2M2 12h2m16 0h2M4.9 4.9l1.4 1.4m11.4 11.4 1.4 1.4M19.1 4.9l-1.4 1.4M6.3 17.7l-1.4 1.4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
			</button>
			<button class="icon-btn menu-toggle" id="menuToggle" type="button" aria-label="<?php esc_attr_e( 'Buka menu', 'hedwigus-journal' ); ?>" aria-expanded="false" aria-controls="primary-nav">
				<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
			</button>
		</div>
	</div>
	<div class="wrap header-search" id="headerSearch">
		<?php get_search_form(); ?>
	</div>
</header>
