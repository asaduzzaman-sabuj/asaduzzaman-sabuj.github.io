<?php
/**
 * Theme functions and definitions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Education_Soul
 */

if ( ! function_exists( 'education_soul_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function education_soul_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'education-soul', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'education-soul-thumb', 400, 300 );

		// Register nav menu locations.
		register_nav_menus(
			array(
				'primary'  => esc_html__( 'Primary Menu', 'education-soul' ),
				'footer'   => esc_html__( 'Footer Menu', 'education-soul' ),
				'social'   => esc_html__( 'Social Menu', 'education-soul' ),
				'notfound' => esc_html__( '404 Menu', 'education-soul' ),
			)
		);

		/*
		 * Switch default core markup to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'education_soul_custom_background_args',
				array(
					'default-color' => 'f6f6f6',
					'default-image' => '',
				)
			)
		);

		// Enable support for selective refresh of widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable support for custom logo.
		add_theme_support( 'custom-logo' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Add WooCommerce Support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );

		// Load Supports.
		require get_template_directory() . '/inc/support.php';
	}

endif;

add_action( 'after_setup_theme', 'education_soul_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function education_soul_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'education_soul_content_width', 640 );
}

add_action( 'after_setup_theme', 'education_soul_content_width', 0 );

/**
 * Register widget area.
 */
function education_soul_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'education-soul' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'education-soul' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Secondary Sidebar', 'education-soul' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here to appear in your Secondary Sidebar.', 'education-soul' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'education_soul_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function education_soul_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'education-soul-font-awesome', get_template_directory_uri() . '/third-party/font-awesome/css/all' . $min . '.css', '', '5.9.0' );

	$fonts_url = education_soul_fonts_url();

	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'education-soul-google-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_style( 'jquery-slick', get_template_directory_uri() . '/third-party/slick/css/slick' . $min . '.css', '', '1.8.1' );

	wp_enqueue_style( 'education-soul-style', get_stylesheet_uri(), array(), '1.0.0' );

	$custom_css = '';

	$cta_background_image = education_soul_get_option( 'cta_background_image' );

	if ( ! empty( $cta_background_image ) ) {
		$custom_css .= '.home-section-call-to-action{background-image:url(' . esc_url( $cta_background_image ) . ');}';
	}

	if ( ! empty( $custom_css ) ) {
		wp_add_inline_style( 'education-soul-style', $custom_css );
	}

	wp_enqueue_script( 'education-soul-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'education-soul-navigation', get_template_directory_uri() . '/js/navigation' . $min . '.js', array( 'jquery' ), '1.0.0', true );

	wp_localize_script(
		'education-soul-navigation',
		'educationSoulScreenReaderText',
		array(
			'expand'   => esc_html__( 'expand child menu', 'education-soul' ),
			'collapse' => esc_html__( 'collapse child menu', 'education-soul' ),
		)
	);

	wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.6', true );

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/third-party/slick/js/slick' . $min . '.js', array( 'jquery' ), '1.8.1', true );

	wp_enqueue_script( 'jquery-easy-ticker', get_template_directory_uri() . '/third-party/ticker/jquery.easy-ticker' . $min . '.js', array( 'jquery' ), '2.0', true );

	wp_enqueue_script( 'education-soul-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), '1.0.0', true );

	$custom_args = array(
		'go_to_top_status' => ( true === education_soul_get_option( 'go_to_top' ) ) ? 1 : 0,
	);

	wp_localize_script( 'education-soul-custom', 'educationSoulCustomOptions', $custom_args );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'education_soul_scripts' );

/**
 * Enqueue admin scripts and styles.
 *
 * @since 0.1
 *
 * @param string $hook Hook name.
 */
function education_soul_admin_scripts( $hook ) {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_style( 'education-soul-metabox', get_template_directory_uri() . '/css/metabox' . $min . '.css', '', '1.0.0' );
		wp_enqueue_script( 'education-soul-custom-admin', get_template_directory_uri() . '/js/admin' . $min . '.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs' ), '1.0.0', true );
	}

	if ( 'widgets.php' === $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_media();
		wp_enqueue_style( 'education-soul-custom-widgets-style', get_template_directory_uri() . '/css/widgets' . $min . '.css', array(), '1.0.0' );
		wp_enqueue_script( 'education-soul-custom-widgets', get_template_directory_uri() . '/js/widgets' . $min . '.js', array( 'jquery' ), '1.0.0', true );
	}

}

add_action( 'admin_enqueue_scripts', 'education_soul_admin_scripts' );

/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';
