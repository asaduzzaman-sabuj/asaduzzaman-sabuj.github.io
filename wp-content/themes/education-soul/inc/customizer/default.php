<?php
/**
 * Default theme options
 *
 * @package Education_Soul
 */

if ( ! function_exists( 'education_soul_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 0.1
	 *
	 * @return array Default theme options.
	 */
	function education_soul_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['show_ticker']           = false;
		$defaults['ticker_title']          = esc_html__( 'News:', 'education-soul' );
		$defaults['ticker_category']       = 0;
		$defaults['ticker_number']         = 3;
		$defaults['contact_number']        = '';
		$defaults['contact_email']         = '';
		$defaults['contact_address']       = '';
		$defaults['show_social_in_header'] = false;
		$defaults['search_in_header']      = true;
		$defaults['buy_button_text']       = esc_html__( 'Buy Now', 'education-soul' );
		$defaults['buy_button_url']        = '';

		// Layout.
		$defaults['global_layout']           = 'right-sidebar';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'large';
		$defaults['archive_image_alignment'] = 'center';
		$defaults['single_image']            = 'large';
		$defaults['single_image_alignment']  = 'center';

		// Pagination.
		$defaults['pagination_type'] = 'numeric';

		// Footer.
		$defaults['copyright_text']        = esc_html__( 'Copyright &copy; All rights reserved.', 'education-soul' );
		$defaults['show_social_in_footer'] = false;
		$defaults['go_to_top']             = true;

		// Blog.
		$defaults['excerpt_length']     = 40;
		$defaults['read_more_text']     = esc_html__( 'Read more', 'education-soul' );
		$defaults['exclude_categories'] = '';

		// Breadcrumb.
		$defaults['breadcrumb_type'] = 'simple';

		// Homepage Sections.
		$defaults['homepage_sections'] = array( 'featured-slider', 'call-to-action', 'news-and-events', 'latest-news' );

		// Homepage Call To Action.
		$defaults['cta_title']                 = esc_html__( 'Welcome To Our University', 'education-soul' );
		$defaults['cta_description']           = esc_html__( 'Every undergraduate student is eligible to receive a fellowship of up to $10,000 for a summer internship or faculty-mentored research project. Find your opportunity, make your case for how it fits your academic plans, and we will help fund it.', 'education-soul' );
		$defaults['cta_primary_button_text']   = esc_html__( 'Learn More', 'education-soul' );
		$defaults['cta_primary_button_url']    = '#';
		$defaults['cta_secondary_button_text'] = esc_html__( 'Online Tour', 'education-soul' );
		$defaults['cta_secondary_button_url']  = '#';
		$defaults['cta_background_image']      = '';

		// Homepage News and Events.
		$defaults['news_and_events_ntitle']    = esc_html__( 'News', 'education-soul' );
		$defaults['news_and_events_nnumber']   = 4;
		$defaults['news_and_events_ncategory'] = 0;
		$defaults['news_and_events_etitle']    = esc_html__( 'Events', 'education-soul' );
		$defaults['news_and_events_enumber']   = 4;
		$defaults['news_and_events_ecategory'] = 0;

		// Homepage Services.
		$defaults['services_title']  = esc_html__( 'Services', 'education-soul' );
		$defaults['services_number'] = 6;
		$defaults['services_column'] = 3;

		// Homepage Latest News.
		$defaults['latest_news_title']          = esc_html__( 'Latest News', 'education-soul' );
		$defaults['latest_news_layout']         = 1;
		$defaults['latest_news_category']       = 0;
		$defaults['latest_news_number']         = 4;
		$defaults['latest_news_column']         = 4;
		$defaults['latest_news_featured_image'] = 'education-soul-thumb';
		$defaults['latest_news_excerpt_length'] = 20;

		// Slider Options.
		$defaults['featured_slider_transition_effect']   = 'fadeout';
		$defaults['featured_slider_transition_delay']    = 3;
		$defaults['featured_slider_transition_duration'] = 1;
		$defaults['featured_slider_enable_caption']      = true;
		$defaults['featured_slider_caption_alignment']   = 'left';
		$defaults['featured_slider_enable_arrow']        = true;
		$defaults['featured_slider_enable_pager']        = true;
		$defaults['featured_slider_enable_autoplay']     = true;
		$defaults['featured_slider_type']                = 'demo-slider';
		$defaults['featured_slider_number']              = 2;
		$defaults['featured_slider_read_more_text']      = esc_html__( 'Read More', 'education-soul' );

		// Pass through filter.
		$defaults = apply_filters( 'education_soul_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;
