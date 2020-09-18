<?php
/**
 * WooCommerce support class
 *
 * @package Education_Soul
 */

/**
 * Woocommerce support class.
 *
 * @since 0.1
 */
class Education_Soul_Woocommerce {

	/**
	 * Construcor.
	 *
	 * @since 0.1
	 */
	function __construct() {

		$this->setup();
		$this->init();

	}

	/**
	 * Initial setup.
	 *
	 * @since 0.1
	 */
	function setup() {
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 0.1
	 */
	function init() {

		// Register widgets.
		add_action( 'widgets_init', array( $this, 'register_woo_sidebars' ) );

		// Wrapper.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', array( $this, 'woo_wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content', array( $this, 'woo_wrapper_end' ), 10 );

		// Breadcrumb.
		add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'custom_woocommerce_breadcrumbs_defaults' ) );
		add_action( 'wp', array( $this, 'hooking_woo' ) );

		// Sidebar.
		add_action( 'woocommerce_sidebar', array( $this, 'add_secondary_sidebar' ), 11 );

		// Sidebar filter.
		add_filter( 'education_soul_filter_default_sidebar_id', array( $this, 'sidebar_defaults' ), 10, 2 );

		// Customizer options.
		add_action( 'customize_register', array( $this, 'customizer_fields' ) );

		// Add default options.
		add_filter( 'education_soul_filter_default_theme_options', array( $this, 'default_options' ) );

		// Modify global layout.
		add_filter( 'education_soul_filter_theme_global_layout', array( $this, 'modify_global_layout' ), 15 );
	}

	/**
	 * Default options.
	 *
	 * @param  array $input Passed default options.
	 * @return array Modified default options.
	 */
	function default_options( $input ) {

		$input['woo_page_layout']       = 'right-sidebar';
		$input['woo_sidebar_primary']   = '';
		$input['woo_sidebar_secondary'] = '';
		return $input;

	}

	/**
	 * Hooking Woocommerce.
	 *
	 * @since 0.1
	 */
	function hooking_woo() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		if ( 'disabled' !== education_soul_get_option( 'breadcrumb_type' ) && is_woocommerce() ) {
			if ( ! is_shop() ) {
				add_action( 'education_soul_action_before_content', 'woocommerce_breadcrumb', 7 );
			}
			remove_action( 'education_soul_action_before_content', 'education_soul_add_breadcrumb', 7 );
		}

		// Fixing primary sidebar.
		$global_layout = education_soul_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_soul_filter_theme_global_layout', $global_layout );
		if ( in_array( $global_layout, array( 'no-sidebar' ) ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}

		// Fix front page widget.
		add_filter( 'education_soul_filter_front_page_widget_status', array( $this, 'front_page_widget_status' ), 15 );

		// Hide page title.
		add_filter( 'woocommerce_show_page_title', '__return_false' );

		// Remove product title in single.
		remove_filter( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

	}

	/**
	 * Modify front page widget status.
	 *
	 * @since 0.1
	 */
	function front_page_widget_status( $input ) {

		if ( is_front_page() && is_shop() ) {
			$input = true;
		}

		return $input;

	}

	/**
	 * Modify global layout.
	 *
	 * @since 0.1
	 */
	function modify_global_layout( $layout ) {

		$woo_page_layout = education_soul_get_option( 'woo_page_layout' );

		if ( is_woocommerce() && ! empty( $woo_page_layout ) ) {
			$layout = esc_attr( $woo_page_layout );
		}

		// Fix for shop page.
		if ( is_shop() && ( $shop_id = absint( wc_get_page_id( 'shop' ) ) ) > 0 ) {
			$post_options = get_post_meta( $shop_id, 'education_soul_theme_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$layout = esc_attr( $post_options['post_layout'] );
			}
		}

		return $layout;

	}

	/**
	 * Add extra customizer options for WooCommerce.
	 *
	 * @since 0.1
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function customizer_fields( $wp_customize ) {

		$default = education_soul_get_default_theme_options();

		// WooCommerce Section.
		$wp_customize->add_section(
			'section_theme_woocommerce',
			array(
				'title'       => esc_html__( 'WooCommerce Options', 'education-soul' ),
				'description' => esc_html__( 'Settings specific to WooCommerce. Note: WooCommerce Page means shop page, product page and product archive page.', 'education-soul' ),
				'priority'    => 100,
				'capability'  => 'edit_theme_options',
				'panel'       => 'theme_option_panel',
			)
		);
		// Setting - woo_page_layout.
		$wp_customize->add_setting(
			'theme_options[woo_page_layout]',
			array(
				'default'           => $default['woo_page_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'education_soul_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'theme_options[woo_page_layout]',
			array(
				'label'   => esc_html__( 'Content Layout', 'education-soul' ),
				'section' => 'section_theme_woocommerce',
				'type'    => 'select',
				'choices' => education_soul_get_global_layout_options(),
			)
		);
		// Setting - woo_sidebar_primary.
		$wp_customize->add_setting(
			'theme_options[woo_sidebar_primary]',
			array(
				'default'           => $default['woo_sidebar_primary'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key',
			)
		);
		$wp_customize->add_control(
			new Education_Soul_Dropdown_Sidebars_Control(
				$wp_customize,
				'theme_options[woo_sidebar_primary]',
				array(
					'label'       => esc_html__( 'Primary Sidebar', 'education-soul' ),
					'description' => esc_html__( 'Choose Primary Sidebar for WooCommerce pages. If not selected default sidebar will be displayed.', 'education-soul' ),
					'section'     => 'section_theme_woocommerce',
					'settings'    => 'theme_options[woo_sidebar_primary]',
				)
			)
		);
		// Setting - woo_sidebar_secondary.
		$wp_customize->add_setting(
			'theme_options[woo_sidebar_secondary]',
			array(
				'default'           => $default['woo_sidebar_secondary'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_key',
			)
		);
		$wp_customize->add_control(
			new Education_Soul_Dropdown_Sidebars_Control(
				$wp_customize,
				'theme_options[woo_sidebar_secondary]',
				array(
					'label'       => esc_html__( 'Secondary Sidebar', 'education-soul' ),
					'description' => esc_html__( 'Choose Secondary Sidebar for WooCommerce pages. If not selected default sidebar will be displayed.', 'education-soul' ),
					'section'     => 'section_theme_woocommerce',
					'settings'    => 'theme_options[woo_sidebar_secondary]',
				)
			)
		);

	}

	/**
	 * Register Woocommerce sidebars.
	 *
	 * @since 0.1
	 */
	function register_woo_sidebars() {

		register_sidebar(
			array(
				'name'          => __( 'WooCommerce Primary', 'education-soul' ),
				'id'            => 'sidebar-woocommerce-primary',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'WooCommerce Secondary', 'education-soul' ),
				'id'            => 'sidebar-woocommerce-secondary',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

	}

	/**
	 * Add secondary sidebar in Woocommerce.
	 *
	 * @since 0.1
	 */
	function add_secondary_sidebar() {

		$global_layout = education_soul_get_option( 'global_layout' );
		$global_layout = apply_filters( 'education_soul_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
				break;

			default:
				break;
		}

	}

	/**
	 * Woocommerce content wrapper start.
	 *
	 * @since 0.1
	 */
	function woo_wrapper_start() {
		echo '<div id="primary">';
		echo '<main role="main" class="site-main" id="main">';
	}

	/**
	 * Woocommerce content wrapper end.
	 *
	 * @since 0.1
	 */
	function woo_wrapper_end() {
		echo '</main><!-- #main -->';
		echo '</div><!-- #primary -->';
	}

	/**
	 * Woocommerce breadcrumb defaults
	 *
	 * @since 0.1
	 */
	function custom_woocommerce_breadcrumbs_defaults() {

		return array(
			'delimiter'   => ' &gt; ',
			'wrap_before' => '<div id="breadcrumb" itemprop="breadcrumb"><div class="container"><div id="crumbs">',
			'wrap_after'  => '</div></div></div>',
			'before'      => '',
			'after'       => '',
			'home'        => get_bloginfo( 'name', 'display' ),
		);
	}

	/**
	 * Modify woo sidebar id defaults.
	 *
	 * @param  string $id       Sidebar ID.
	 * @param  string $location Sidebar position.
	 * @return string           Modified default sidebar id.
	 */
	function sidebar_defaults( $id, $location ) {
		if ( ! is_woocommerce() ) {
			return $id;
		}
		switch ( $location ) {
			case 'primary':
				$woo_sidebar_primary = education_soul_get_option( 'woo_sidebar_primary' );
				if ( ! empty( $woo_sidebar_primary ) ) {
					$id = esc_attr( $woo_sidebar_primary );
				}
				break;
			case 'secondary':
				$woo_sidebar_secondary = education_soul_get_option( 'woo_sidebar_secondary' );
				if ( ! empty( $woo_sidebar_secondary ) ) {
					$id = esc_attr( $woo_sidebar_secondary );
				}
				break;

			default:
				break;
		}
		return $id;
	}

} // End class.

// Initialize.
$education_soul_woocommerce = new Education_Soul_Woocommerce();
