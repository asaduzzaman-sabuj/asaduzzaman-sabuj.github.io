<?php
/**
 * Override parent functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kids_Education_Soul
 */

if ( ! function_exists( 'education_soul_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 0.1
	 * @return string Font URL.
	 */
	function education_soul_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'kids-education-soul' ) ) {
			$fonts[] = 'Open+Sans:300italic,400italic,600italic,700italic,300,400,600,700';
		}

		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Dosis font: on or off', 'kids-education-soul' ) ) {
			$fonts[] = 'Dosis:300,400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

endif;

if ( ! function_exists( 'education_soul_get_slider_details' ) ) :
	/**
	 * Slider details.
	 *
	 * @since 0.1
	 *
	 * @param array $input Slider details.
	 */
	function education_soul_get_slider_details( $input ) {

		$featured_slider_type           = education_soul_get_option( 'featured_slider_type' );
		$featured_slider_number         = education_soul_get_option( 'featured_slider_number' );
		$featured_slider_read_more_text = education_soul_get_option( 'featured_slider_read_more_text' );

		switch ( $featured_slider_type ) {

			case 'demo-slider':
				$slides = array();
				for ( $i = 0; $i <= 1; $i++ ) {
					$img_arr = array(
						0 => get_stylesheet_directory_uri() . '/images/slide' . ( $i + 1 ) . '.jpg',
						1 => 1420,
						2 => 440,
						3 => 0,
					);

					$slides[ $i ]['images']  = $img_arr;
					$slides[ $i ]['title']   = esc_html__( 'Slide Title ', 'kids-education-soul' ) . ( $i + 1 );
					$slides[ $i ]['url']     = esc_url( home_url( '/' ) );
					$slides[ $i ]['excerpt'] = esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis metus scelerisque, faucibus risus eu, luctus est.', 'kids-education-soul' );

				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

				break;

			case 'featured-page':
				$ids = array();

				for ( $i = 1; $i <= $featured_slider_number; $i++ ) {
					$id = education_soul_get_option( 'featured_slider_page_' . $i );
					if ( ! empty( $id ) ) {
						$ids[] = absint( $id );
					}
				}
				// Bail if no valid pages are selected.
				if ( empty( $ids ) ) {
					return $input;
				}

				$qargs = array(
					'posts_per_page' => absint( $featured_slider_number ),
					'no_found_rows'  => true,
					'orderby'        => 'post__in',
					'post_type'      => 'page',
					'post__in'       => $ids,
					'meta_query'     => array(
						array( 'key' => '_thumbnail_id' ), // Show only posts with featured images.
					),
				);

				// Fetch posts.
				$all_posts = get_posts( $qargs );
				$slides    = array();

				if ( ! empty( $all_posts ) ) {

					$cnt = 0;
					foreach ( $all_posts as $key => $post ) {

						if ( has_post_thumbnail( $post->ID ) ) {
							$image_array               = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'education-soul-slider' );
							$slides[ $cnt ]['images']  = $image_array;
							$slides[ $cnt ]['title']   = esc_html( $post->post_title );
							$slides[ $cnt ]['url']     = esc_url( get_permalink( $post->ID ) );
							$slides[ $cnt ]['excerpt'] = education_soul_the_excerpt( apply_filters( 'education_soul_filter_slider_caption_length', 20 ), $post );
							if ( ! empty( $featured_slider_read_more_text ) ) {
								$slides[ $cnt ]['primary_button_text'] = esc_attr( $featured_slider_read_more_text );
								$slides[ $cnt ]['primary_button_url']  = $slides[ $cnt ]['url'];
							}

							$cnt++;
						}
					}
				}
				if ( ! empty( $slides ) ) {
					$input = $slides;
				}

				break;

			default:
				break;
		}
		return $input;

	}
endif;
