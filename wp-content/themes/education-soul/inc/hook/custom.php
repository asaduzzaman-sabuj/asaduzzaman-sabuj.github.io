<?php
/**
 * Custom theme functions
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package Education_Soul
 */

if ( ! function_exists( 'education_soul_skip_to_content' ) ) :
	/**
	 * Add Skip to content.
	 *
	 * @since 0.1
	 */
	function education_soul_skip_to_content() {
		?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-soul' ); ?></a>
		<?php
	}
endif;

add_action( 'education_soul_action_before', 'education_soul_skip_to_content', 15 );

if ( ! function_exists( 'education_soul_site_branding' ) ) :

	/**
	 * Site branding.
	 *
	 * @since 0.1
	 */
	function education_soul_site_branding() {
		?>
		<div class="site-branding">

			<?php education_soul_the_custom_logo(); ?>

			<?php $show_title = education_soul_get_option( 'show_title' ); ?>
			<?php $show_tagline = education_soul_get_option( 'show_tagline' ); ?>
			<?php if ( true === $show_title || true === $show_tagline ) : ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( true === $show_tagline ) : ?>
						<p class="site-description"><?php bloginfo( 'description' ); ?></p>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
		</div><!-- .site-branding -->
		<?php
	}

endif;

add_action( 'education_soul_action_header', 'education_soul_site_branding' );

if ( ! function_exists( 'education_soul_header_top_content' ) ) :

	/**
	 * Add primary navigation.
	 *
	 * @since 0.1
	 */
	function education_soul_add_primary_navigation() {
		?>
		<div class="main-right-header pull-right">

			<div id="main-nav">
				<button id="menu-toggle" class="menu-toggle"><i class="fas fa-bars"></i><?php esc_html_e( 'Menu', 'education-soul' ); ?></button>
				<div id="site-header-menu" class="site-header-menu clear-fix">
					<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'education-soul' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_class'     => 'primary-menu',
									'fallback_cb'    => 'education_soul_primary_navigation_fallback',
								)
							);
						?>
					</nav><!-- .main-navigation -->
				</div><!-- #site-header-menu -->
			</div><!-- .main-nav -->

			<div class="head-right pull-right">
				<?php
				$buy_button_text = education_soul_get_option( 'buy_button_text' );
				$buy_button_url  = education_soul_get_option( 'buy_button_url' );
				?>
				<?php if ( ! empty( $buy_button_text ) && ! empty( $buy_button_url ) ) : ?>
					<a href="<?php echo esc_url( $buy_button_url ); ?>" class="custom-button button-secondary header-link-button"><?php echo esc_html( $buy_button_text ); ?></a>
				<?php endif; ?>

				<?php $search_in_header = education_soul_get_option( 'search_in_header' ); ?>
				<?php if ( true === $search_in_header ) : ?>
					<div class="header-search-box">
						<a href="#" class="search-icon"><i class="fas fa-search"></i><span class="screen-reader-text"><?php esc_html_e( 'Search', 'education-soul' ); ?></span></a>
						<a href="#" class="search-close-icon"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e( 'Search Close', 'education-soul' ); ?></span></a>
						<div class="search-box-wrap">
							<?php get_search_form(); ?>
						</div><!-- .search-box-wrap -->
					</div><!-- .header-search-box -->
				<?php endif; ?>
			</div><!-- .head-right -->
		</div><!-- .main-right-header -->

		<?php
	}
endif;

add_action( 'education_soul_action_header', 'education_soul_add_primary_navigation', 15 );

if ( ! function_exists( 'education_soul_header_top_content' ) ) :

	/**
	 * Header Top.
	 *
	 * @since 0.1
	 */
	function education_soul_header_top_content() {
		$tophead_status = apply_filters( 'education_soul_filter_tophead_status', false );
		if ( true !== $tophead_status ) {
			return;
		}
		?>
		<div id="tophead">
			<div class="container">
				<?php $show_ticker = education_soul_get_option( 'show_ticker' ); ?>
				<?php if ( true === $show_ticker ) : ?>
					<div class="top-news">
						<span class="top-news-title">
							<?php $ticker_title = education_soul_get_option( 'ticker_title' ); ?>
							<?php echo ( ! empty( $ticker_title ) ) ? esc_html( $ticker_title ) : '&nbsp;'; ?>
						</span>
						<?php echo education_soul_get_news_ticker_content(); ?>
					</div> <!-- #top-news -->
				<?php endif; ?>

				<?php
				$contact_number  = education_soul_get_option( 'contact_number' );
				$contact_email   = education_soul_get_option( 'contact_email' );
				$contact_address = education_soul_get_option( 'contact_address' );
				?>
				<div id="quick-contact">
					<ul>
						<?php if ( ! empty( $contact_number ) ) : ?>
							<li class="quick-call">
								<a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D+/', '', $contact_number ) ); ?>"><?php echo esc_html( $contact_number ); ?></a>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $contact_email ) ) : ?>
							<li class="quick-email">
								<a href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>"><?php echo esc_html( antispambot( $contact_email ) ); ?></a>
							</li>
						<?php endif; ?>
						<?php if ( ! empty( $contact_address ) ) : ?>
							<li class="quick-address">
								<?php echo esc_html( $contact_address ); ?>
							</li>
						<?php endif; ?>
					</ul>
				</div> <!-- #quick-contact -->

				<?php if ( true === education_soul_get_option( 'show_social_in_header' ) && has_nav_menu( 'social' ) ) : ?>
					<div id="header-social">
						<?php the_widget( 'Education_Soul_Social_Widget' ); ?>
					</div><!-- #header-social -->
				<?php endif; ?>

			</div> <!-- .container -->
		</div><!--  #tophead -->
		<?php
	}

endif;

add_action( 'education_soul_action_before_header', 'education_soul_header_top_content', 5 );

if ( ! function_exists( 'education_soul_check_tophead_status' ) ) :

	/**
	 * Check status of top head.
	 *
	 * @since 0.1
	 *
	 * @param bool $input Status.
	 */
	function education_soul_check_tophead_status( $input ) {

		// Ticker.
		$show_ticker = education_soul_get_option( 'show_ticker' );

		// Address.
		$contact_number  = education_soul_get_option( 'contact_number' );
		$contact_email   = education_soul_get_option( 'contact_email' );
		$contact_address = education_soul_get_option( 'contact_address' );

		// Social.
		$show_social_in_header = education_soul_get_option( 'show_social_in_header' );

		if ( true === $show_ticker || ! empty( $contact_number ) || ! empty( $contact_email ) || ! empty( $contact_address ) || ( true === $show_social_in_header && has_nav_menu( 'social' ) ) ) {
			$input = true;
		}

		return $input;
	}

endif;

add_filter( 'education_soul_filter_tophead_status', 'education_soul_check_tophead_status' );

if ( ! function_exists( 'education_soul_footer_copyright' ) ) :

	/**
	 * Footer copyright.
	 *
	 * @since 0.1
	 */
	function education_soul_footer_copyright() {

		// Check if footer is disabled.
		$footer_status = apply_filters( 'education_soul_filter_footer_status', true );
		if ( true !== $footer_status ) {
			return;
		}

		// Footer Menu.
		$footer_menu_content = wp_nav_menu(
			array(
				'theme_location' => 'footer',
				'container'      => 'div',
				'container_id'   => 'footer-navigation',
				'depth'          => 1,
				'fallback_cb'    => false,
				'echo'           => false,
			)
		);

		// Copyright content.
		$copyright_text = education_soul_get_option( 'copyright_text' );
		$copyright_text = apply_filters( 'education_soul_filter_copyright_text', $copyright_text );
		if ( ! empty( $copyright_text ) ) {
			$copyright_text = wp_kses_data( $copyright_text );
		}

		// Powered by content.
		$powered_by_text = sprintf( esc_html__( 'Education Soul by %s', 'education-soul' ), '<a target="_blank" rel="designer" href="https://wenthemes.com/">' . esc_html__( 'WEN Themes', 'education-soul' ) . '</a>' );

		$show_social_in_footer = education_soul_get_option( 'show_social_in_footer' );
		?>

		<div class="colophon-inner">
			<div class="colophon-top clear-fix">
				<?php if ( true === $show_social_in_footer && has_nav_menu( 'social' ) ) : ?>
					<div class="colophon-column">
						<div class="footer-social">
							<?php the_widget( 'Education_Soul_Social_Widget' ); ?>
						</div><!-- .footer-social -->
					</div><!-- .colophon-column -->
				<?php endif; ?>
			</div><!-- .colophon-top -->
			<div class="colophon-mid clear-fix">
				<?php if ( ! empty( $footer_menu_content ) ) : ?>
					<div class="colophon-column">
						<?php echo $footer_menu_content; ?>
					</div><!-- .colophon-column -->
				<?php endif; ?>
			</div><!-- .colophon-mid -->
			<div class="colophon-bottom clear-fix">
				<?php if ( ! empty( $copyright_text ) ) : ?>
					<div class="colophon-column">
						<div class="copyright">
							<?php echo $copyright_text; ?>
						</div><!-- .copyright -->
					</div><!-- .colophon-column -->
				<?php endif; ?>

				<?php if ( ! empty( $powered_by_text ) ) : ?>
					<div class="colophon-column">
						<div class="site-info">
							<?php echo $powered_by_text; ?>
						</div><!-- .site-info -->
					</div><!-- .colophon-column -->
				<?php endif; ?>
			</div><!-- .colophon-bottom -->
		</div><!-- .colophon-inner -->

		<?php
	}

endif;

add_action( 'education_soul_action_footer', 'education_soul_footer_copyright', 10 );

if ( ! function_exists( 'education_soul_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 0.1
	 */
	function education_soul_add_sidebar() {

		global $post;

		$global_layout = education_soul_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_soul_filter_theme_global_layout', $global_layout );

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}
		// Include Secondary sidebar.
		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
				break;

			default:
				break;
		}

	}

endif;

add_action( 'education_soul_action_sidebar', 'education_soul_add_sidebar' );

if ( ! function_exists( 'education_soul_custom_posts_navigation' ) ) :
	/**
	 * Posts navigation.
	 *
	 * @since 0.1
	 */
	function education_soul_custom_posts_navigation() {

		$pagination_type = education_soul_get_option( 'pagination_type' );

		switch ( $pagination_type ) {

			case 'default':
				the_posts_navigation();
				break;

			case 'numeric':
				the_posts_pagination();
				break;

			default:
				break;
		}
	}

endif;

add_action( 'education_soul_action_posts_navigation', 'education_soul_custom_posts_navigation' );

if ( ! function_exists( 'education_soul_add_image_in_single_display' ) ) :

	/**
	 * Add image in single post.
	 *
	 * @since 0.1
	 */
	function education_soul_add_image_in_single_display() {

		global $post;

		if ( has_post_thumbnail() ) {

			$values = get_post_meta( $post->ID, 'education_soul_theme_settings', true );

			$education_soul_theme_settings_single_image           = isset( $values['single_image'] ) ? esc_attr( $values['single_image'] ) : '';
			$education_soul_theme_settings_single_image_alignment = isset( $values['single_image_alignment'] ) ? esc_attr( $values['single_image_alignment'] ) : '';

			if ( ! $education_soul_theme_settings_single_image ) {
				$education_soul_theme_settings_single_image = education_soul_get_option( 'single_image' );
			}
			if ( ! $education_soul_theme_settings_single_image_alignment ) {
				$education_soul_theme_settings_single_image_alignment = education_soul_get_option( 'single_image_alignment' );
			}

			if ( 'disable' !== $education_soul_theme_settings_single_image ) {
				$args = array(
					'class' => 'align' . esc_attr( $education_soul_theme_settings_single_image_alignment ),
				);
				the_post_thumbnail( esc_attr( $education_soul_theme_settings_single_image ), $args );
			}
		}

	}

endif;

add_action( 'education_soul_single_image', 'education_soul_add_image_in_single_display' );

if ( ! function_exists( 'education_soul_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 0.1
	 */
	function education_soul_add_breadcrumb() {

		// Bail if Breadcrumb disabled.
		$breadcrumb_type = education_soul_get_option( 'breadcrumb_type' );
		if ( 'disabled' === $breadcrumb_type ) {
			return;
		}

		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"><div class="container">';

		switch ( $breadcrumb_type ) {
			case 'simple':
				education_soul_simple_breadcrumb();
				break;

			default:
				break;
		}

		echo '</div><!-- .container --></div><!-- #breadcrumb -->';
	}

endif;

add_action( 'education_soul_action_before_content', 'education_soul_add_breadcrumb', 7 );

if ( ! function_exists( 'education_soul_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 0.1
	 */
	function education_soul_footer_goto_top() {
		$go_to_top = education_soul_get_option( 'go_to_top' );

		if ( true !== $go_to_top ) {
			return;
		}

		echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fas fa-angle-up"></i></a>';
	}

endif;

add_action( 'education_soul_action_after', 'education_soul_footer_goto_top', 20 );

if ( ! function_exists( 'education_soul_add_front_page_home_sections' ) ) :

	/**
	 * Add Front Page widget sections.
	 *
	 * @since 0.1
	 */
	function education_soul_add_front_page_home_sections() {

		$section_status = apply_filters( 'education_soul_filter_front_page_home_sections_status', false );

		if ( true !== $section_status ) {
			return;
		}

		$active_sections = education_soul_get_active_homepage_sections();

		if ( ! empty( $active_sections ) ) {
			echo '<div id="front-page-home-sections" class="widget-area">';
			foreach ( $active_sections as $section ) {
				get_template_part( $section['template'] );
			}
			echo '</div><!-- #front-page-home-sections -->';
		}

	}
endif;

add_action( 'education_soul_action_before_content', 'education_soul_add_front_page_home_sections', 6 );

if ( ! function_exists( 'education_soul_check_front_homepage_section_status' ) ) :

	/**
	 * Check status of front homepage section.
	 *
	 * @since 0.1
	 *
	 * @param bool $input Status.
	 */
	function education_soul_check_front_homepage_section_status( $input ) {

		if ( true === is_page_template( 'tpl-frontpage.php' ) ) {
			$input = true;
		}

		return $input;
	}

endif;

add_filter( 'education_soul_filter_front_page_home_sections_status', 'education_soul_check_front_homepage_section_status' );
