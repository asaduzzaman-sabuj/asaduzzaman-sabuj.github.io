<?php
/**
 * Admin functions
 *
 * @package Education_Soul
 */

add_action( 'admin_menu', 'education_soul_admin_menu_page' );

/**
 * Register admin page.
 *
 * @since 0.1
 */
function education_soul_admin_menu_page() {

	$theme = wp_get_theme();

	add_theme_page(
		$theme->display( 'Name' ),
		$theme->display( 'Name' ),
		'manage_options',
		'education-soul',
		'education_soul_do_admin_page'
	);

}

/**
 * Render admin page.
 *
 * @since 0.1
 */
function education_soul_do_admin_page() {
	$theme = wp_get_theme( get_template() );
	?>
	<div class="wrap wt-wrap">
		<h1><?php echo esc_html( $theme->display( 'Name' ) ); ?></h1>
		<div class="two-columns">

			<div class="col theme-details">
				<?php
				$description_raw  = $theme->display( 'Description' );
				$main_description = explode( 'Official', $description_raw );
				?>
				<?php echo wp_kses_post( $main_description[0] ); ?>
				<p><?php esc_html_e( 'Version', 'education-soul' ); ?>:&nbsp;<?php echo esc_html( $theme->display( 'Version' ) ); ?></p>
			</div><!-- .col -->

			<div class="col theme-img">
				<a href="<?php echo esc_url( $theme->display( 'ThemeURI' ) ); ?>" target="_blank"><img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" alt="<?php echo esc_attr( $theme->display( 'Name' ) ); ?>" /></a>
			</div><!-- .col -->

		</div><!-- .two-columns -->
		<div class="four-columns">

			<div class="col">

				<h3><i class="dashicons dashicons-admin-customizer"></i><?php esc_html_e( 'Theme Options', 'education-soul' ); ?></h3>

				<p>
					<?php esc_html_e( 'We have used Customizer API for theme options which will help you preview your changes live and fast.', 'education-soul' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( wp_customize_url() ); ?>" ><?php esc_html_e( 'Customize', 'education-soul' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-book-alt"></i><?php esc_html_e( 'Theme Instructions', 'education-soul' ); ?></h3>
				<p>
					<?php esc_html_e( 'We have prepared detailed theme instructions which will help you to customize theme as you prefer.', 'education-soul' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/theme-instructions/education-soul/' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'education-soul' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-sos"></i><?php esc_html_e( 'Help &amp; Support', 'education-soul' ); ?></h3>

				<p>
					<?php esc_html_e( 'If you have any question/feedback regarding theme, please post in our official support forum.', 'education-soul' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="<?php echo esc_url( 'https://themepalace.com/forum/education-soul/' ); ?>" target="_blank"><?php esc_html_e( 'Get Support', 'education-soul' ); ?></a>
				</p>

			</div><!-- .col -->

			<div class="col">

				<h3><i class="dashicons dashicons-admin-network"></i><?php esc_html_e( 'Upgrade to Pro', 'education-soul' ); ?></h3>
				<p>
					<?php esc_html_e( 'Want additional features in theme? Please upgrade to pro version of the theme.', 'education-soul' ); ?>
				</p>

				<p>
					<a class="button button-primary" href="https://themepalace.com/downloads/education-soul/" ><?php esc_html_e( 'Buy Pro', 'education-soul' ); ?></a>
				</p>

			</div><!-- .col -->

		</div><!-- .four-columns -->

	</div><!-- .wrap -->
	<?php

}

/**
 * Load admin scripts.
 *
 * @since 0.1
 *
 * @param string $hook Current page hook.
 */
function education_soul_load_admin_scripts( $hook ) {
	if ( 'appearance_page_education-soul' === $hook ) {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'education-soul-admin', get_template_directory_uri() . '/css/admin' . $min . '.css', false, '1.0.0' );
	}
}

add_action( 'admin_enqueue_scripts', 'education_soul_load_admin_scripts' );
