<?php
/**
 * Theme Name:      IMN
 * Theme Author:    Rob Butz
 * Theme URI:       https://github.com/oxygensmith/imn-spectra-2
 * Author URI:      https://github.com/oxygensmith/
 * File:            header.php
 * @package spectra
 * @since 1.0.0
 */

// Get options
$spectra_opts = spectra_opts();

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<?php 
$intro_type_class = '';
$page_id = '0';

if ( isset( $wp_query ) && isset( $post ) ) {
	$page_id = $wp_query->post->ID;
   	$intro_type_class = get_post_meta( $wp_query->post->ID, '_intro_type', true );
	if ( $intro_type_class === 'gmap' ) {
		$intro_type_class = 'intro-light';
   	}
}
?>
<body <?php body_class( esc_attr( $intro_type_class ) ) ?> data-page_id="<?php echo esc_attr( $page_id ) ?>" data-wp_title="<?php esc_attr( wp_title( '|', true, 'right' ) ) ?>">
	
<?php if ( ! is_customize_preview() ) : ?>
	<?php echo spectra_wpal_show_loader(); ?>
<?php endif; ?>

<?php 
	// Show or hide navigation on intro section
	$show_nav = $spectra_opts->get_option( 'show_navigation' );
	if ( ! $show_nav || $show_nav === 'off' ) {
		$show_nav = 'hide-navigation';
	} else {
		$show_nav = 'show-navigation';
	}
 ?>

<div id="site" class="site <?php echo esc_attr( $show_nav ) ?>">

	<header id="header" class="sticky <?php echo esc_attr( $show_nav ); ?>">

		<div id="search-wrap">
			<?php get_search_form(); ?>
			<span class="close-search"></span>
		</div>
		<!-- #search-wrap -->

	   	<div class="nav-container">

		   	<a href="<?php echo esc_url( home_url() ) ?>/#site" id="logo" data-offset="-65">
		   		<?php
	   			// Get Theme Logo
	   			$logo = $spectra_opts->get_option( 'logo' );
	   			$logo = $spectra_opts->get_image( $logo );
		   		?>
		   		<?php if ( $logo ) : ?>
                    <div class="navbar-brand">    
                        <img class="logo" src="<?php echo esc_url( $logo ); ?>" alt="<?php echo get_bloginfo('name'); ?>">
                    </div>
		   		<?php else : ?>
                   <div class="navbar-brand">    
                        <?php echo get_bloginfo('name'); ?>
                   </div>
		   		<?php endif; ?>
		   	</a>
		   	<!-- #logo -->

			<nav id="icon-nav">
				<ul>
					<?php if ( ! $spectra_opts->get_option( 'show_icon_up' ) || $spectra_opts->get_option( 'show_icon_up' ) === 'on' ) : ?>
						<li><a href="#site" id="nav-up" class="smooth-scroll" data-offset="-65"><span class="icon icon-arrow-up"></span></a></li>
					<?php endif; ?>
					<?php if ( ! $spectra_opts->get_option( 'show_icon_search' ) || $spectra_opts->get_option( 'show_icon_search' ) === 'on' ) : ?>
						<li><a href="#" id="nav-search"><span class="icon icon-search"></span></a></li>
					<?php endif; ?>
					<?php if ( $spectra_opts->get_option( 'slide_sidebar' ) && $spectra_opts->get_option( 'slide_sidebar' ) === 'on' ) : ?>
						<li><a href="#" id="nav-slidebar"><span class="icon icon-lightning"></span></a></li><?php endif; ?>
					<?php if ( ! $spectra_opts->get_option( 'show_icon_cart' ) || $spectra_opts->get_option( 'show_icon_cart' ) === 'on' ) : ?>
						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		                    <?php 
	                        $count = WC()->cart->get_cart_contents_count();
	                        $wc_link = wc_get_cart_url();
							if ( $spectra_opts->get_option( 'cart_link' ) === 'shop' ) {
								$wc_link = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
							} 
		                    ?>
                    
	                    	<li><a href="<?php echo esc_url( $wc_link ) ?>" id="shop-link"><span class="icon icon-cart"></span><?php if ( $count > 0 ) { echo "<span class='shop-items-count'>" . esc_attr( $count ) . "</span>"; } ?></a></li>
	                	<?php endif ?>
                	<?php endif ?>
					<li><a href="#" id="nav-slidemenu"><span class="icon icon-menu2"></span></a></li>
				</ul>
			</nav>
			<!-- #icon-nav -->

			<?php
			$defaults = array(
				'theme_location'  => 'primary',
				'menu'            => '',
				'container'       => false,
				'container_class' => '',
				'menu_class'      => 'menu',
				'fallback_cb'     => 'wp_page_menu',
				'depth'           => 3
			);				
			?>
			<nav id="nav" class="one-page-nav">
				<?php 
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu( $defaults );
				} else {
					esc_html_e( 'The main menu has not selected location or does not exist. Go to Wordpress > Appearance > Menus and set your menu.', 'spectra' );
				}
				?>
			</nav>
			<!-- #nav -->
	   	</div>
	</header>
	<!-- #header -->

	<div id="slidemenu">
		<header>
			<a href="#" id="slidemenu-close"><?php esc_html_e( 'CLOSE', 'spectra' ) ?> <span class="icon icon-close"></span></a>
		</header>
		<div id="slidemenu-content" class="clearfix">
			<div>
				<?php 
				///////////////////////////
				// RESPONSIVE NAVIGATION //
				///////////////////////////
			 	?>
			</div>
		</div>

	</div>
	<!-- #slidemenu -->
	<div id="slidemenu-layer"></div>

	<div id="ajax-container">
		<div id="ajax-content">