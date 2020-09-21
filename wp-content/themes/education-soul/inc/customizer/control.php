<?php
/**
 * Custom Customizer Controls
 *
 * @package Education_Soul
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Customize Control for Heading.
 *
 * @since 0.1
 *
 * @see WP_Customize_Control
 */
class Education_Soul_Heading_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'heading';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.1
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->value();
		$this->json['link']  = $this->get_link();
		$this->json['id']    = $this->id;
	}

	/**
	 * Content template.
	 *
	 * @since 0.1
	 */
	public function content_template() {
		?>
		<# if ( data.label ) { #>
		<h3><span class="customize-control-title">{{ data.label }}</span></h3>
		<# } #>
		<# if ( data.description ) { #>
		<span class="description customize-control-description">{{ data.description }}</span>
		<# } #>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 0.1
	 */
	public function render_content() {}
}

/**
 * Customize Control for Message.
 *
 * @since 0.1
 *
 * @see WP_Customize_Control
 */
class Education_Soul_Message_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'message';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.1
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->value();
		$this->json['link']  = $this->get_link();
		$this->json['id']    = $this->id;
	}

	/**
	 * Content template.
	 *
	 * @since 0.1
	 */
	public function content_template() {
		?>
		<# if ( data.label ) { #>
		<span class="customize-control-title">{{ data.label }}</span>
		<# } #>
		<# if ( data.description ) { #>
		<span class="description customize-control-description">{{ data.description }}</span>
		<# } #>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 0.1
	 */
	public function render_content() {}
}

/**
 * Customize Control for Taxonomy Select.
 *
 * @since 0.1
 *
 * @see WP_Customize_Control
 */
class Education_Soul_Dropdown_Taxonomies_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'dropdown-taxonomies';

	/**
	 * Taxonomy.
	 *
	 * @access public
	 * @var string
	 */
	public $taxonomy = '';

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$our_taxonomy = 'category';
		if ( isset( $args['taxonomy'] ) ) {
			$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
			if ( true === $taxonomy_exist ) {
				$our_taxonomy = esc_attr( $args['taxonomy'] );
			}
		}
		$args['taxonomy'] = $our_taxonomy;
		$this->taxonomy   = esc_attr( $our_taxonomy );

		$tax_args       = array(
			'hierarchical' => 0,
			'taxonomy'     => $this->taxonomy,
		);
		$all_taxonomies = get_categories( $tax_args );

		$choices    = array();
		$choices[0] = esc_html__( '&mdash; Select &mdash;', 'education-soul' );

		if ( ! empty( $all_taxonomies ) && ! is_wp_error( $all_taxonomies ) ) {
			foreach ( $all_taxonomies as $tax ) {
				$choices[ $tax->term_id ] = $tax->name;
			}
		}

		$this->choices = $choices;

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.1
	 */
	public function to_json() {
		parent::to_json();

		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 0.1
	 */
	public function enqueue() {

		wp_enqueue_style( 'education-soul-customize-controls' );
		wp_enqueue_script( 'education-soul-customize-controls' );

	}

	/**
	 * Content template.
	 *
	 * @since 0.1
	 */
	public function content_template() {
		?>
			<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<select {{{ data.link }}} name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}">
				<# _.each( data.choices, function( label, choice ) { #>

					<option value="{{ choice }}" <# if ( choice === data.value ) { #> selected="selected" <# } #>>{{{ label }}}</option>

				<# } ) #>
			</select>
			</label>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 0.1
	 */
	public function render_content() {}
}

/**
 * Customize Control for Sidebar Select.
 *
 * @since 0.1
 *
 * @see WP_Customize_Control
 */
class Education_Soul_Dropdown_Sidebars_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'dropdown-sidebars';

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		global $wp_registered_sidebars;

		$choices = array();

		$all_sidebars = $wp_registered_sidebars;

		if ( $all_sidebars ) {
			foreach ( $all_sidebars as $key => $sidebar ) {
				$choices[ $key ] = $sidebar['name'];
			}
		}

		$this->choices = $choices;

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.1
	 */
	public function to_json() {
		parent::to_json();

		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 0.1
	 */
	public function enqueue() {

		wp_enqueue_style( 'education-soul-customize-controls' );
		wp_enqueue_script( 'education-soul-customize-controls' );

	}

	/**
	 * Content template.
	 *
	 * @since 0.1
	 */
	public function content_template() {
		?>
			<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<select {{{ data.link }}} name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}">
				<# _.each( data.choices, function( label, choice ) { #>

					<option value="{{ choice }}" <# if ( choice === data.value ) { #> selected="selected" <# } #>>{{{ label }}}</option>

				<# } ) #>
			</select>
			</label>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 0.1
	 */
	public function render_content() {}
}

/**
 * Customize Control for managing section.
 *
 * @since 0.1
 *
 * @see WP_Customize_Control
 */
class Education_Soul_Section_Manager_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'section-manager';

	/**
	 * Arguments.
	 *
	 * @access public
	 * @var array
	 */
	public $args = array();

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 0.1
	 */
	public function enqueue() {

		wp_enqueue_style( 'education-soul-customize-controls' );
		wp_enqueue_script( 'education-soul-customize-controls' );

	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.1
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value']   = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;
	}

	/**
	 * Content template.
	 *
	 * @since 0.1
	 */
	public function content_template() {
		?>
		<# if ( ! data.choices ) {
			return;
		} #>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul class="section-list">
			<# _.each( data.choices, function( item, choice ) { #>
				<li>
					<label>
					<i class="dashicons dashicons-move"></i>
					<span>{{ item.label }}</span>
						<input type="checkbox" class="section-item-checkbox" value="{{ choice }}" <# if ( -1 !== data.value.indexOf( choice ) ) { #> checked="checked" <# } #> />
					</label>
				</li>
			<# } ) #>
		</ul>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 0.1
	 */
	public function render_content() {}

}

/**
 * Upsell section.
 *
 * @since 0.1
 */
class Education_Soul_Customize_Section_Upsell extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since 0.1
	 * @access public
	 * @var    string
	 */
	public $type = 'upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since 0.1
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since 0.1
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.1
	 * @access public
	 * @return string
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since 0.1
	 * @access public
	 * @return void
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
		<?php
	}
}
