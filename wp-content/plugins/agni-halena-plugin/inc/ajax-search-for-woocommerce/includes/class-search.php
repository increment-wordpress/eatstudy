<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class AGNIDGWT_WCAS_Search {
	/*
	 * Suggestions limit
	 * int
	 */

	private $limit;

	/*
	 * Description limit
	 * int
	 */
	private $desc_limit = 130;

	/*
	 * Empty slots
	 * int
	 */
	private $slots;

	function __construct() {

		$this->limit = absint( AGNIDGWT_WCAS()->settings->get_opt( 'suggestions_limit', 10 ) );
		$this->slots = $this->limit; // Free slots for the results. Default 10

		add_filter( 'posts_search', array( $this, 'search_filters' ), 501, 2 );
		add_filter( 'posts_where', array( $this, 'fix_woo_excerpt_search' ), 100, 2 );
		add_filter( 'posts_distinct', array($this, 'search_distinct'), 501, 2);
		add_filter( 'posts_join', array( $this, 'search_filters_join' ), 501, 2 );
		add_filter( 'pre_get_posts', array( $this, 'change_wp_search_size' ), 500 );
		add_filter( 'pre_get_posts', array( $this, 'set_search_results_query' ), 501 );

		// Search results ajax action
		if ( AGNIDGWT_WCAS_WC_AJAX_ENDPOINT ) {
			add_action( 'wc_ajax_' . AGNIDGWT_WCAS_SEARCH_ACTION, array( $this, 'get_search_results' ) );
		} else {
			add_action( 'wp_ajax_nopriv_' . AGNIDGWT_WCAS_SEARCH_ACTION, array( $this, 'get_search_results' ) );
			add_action( 'wp_ajax_' . AGNIDGWT_WCAS_SEARCH_ACTION, array( $this, 'get_search_results' ) );
		}
	}

	/*
	 * Get search results via ajax
	 */

	public function get_search_results() {
		global $woocommerce;

		if ( !defined( 'AGNIDGWT_WCAS_AJAX' ) ) {
			define( 'AGNIDGWT_WCAS_AJAX', true );
		}

		$output	 = array();
		$results = array();
		$keyword = sanitize_text_field( $_REQUEST[ 'agnidgwt_wcas_keyword' ] );



		// Continue searching in products if there are room in the slots
		/* SEARCH IN PRODUCTS */
		if ( $this->slots > 0 ) {
			$ordering_args = $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );

			$args = array(
				's'						 => $keyword,
				'post_type'				 => AGNIDGWT_WCAS_WOO_PRODUCT_POST_TYPE,
				'post_status'			 => 'publish',
				'ignore_sticky_posts'	 => 1,
				'orderby'				 => $ordering_args[ 'orderby' ],
				'order'					 => $ordering_args[ 'order' ],
				'suppress_filters'		 => false
			);

			// Backward compatibility WC < 3.0
			if ( agnidgwt_wcas_compare_wc_version( '3.0', '<' ) ) {
				$args['meta_query'] = $this->get_meta_query();
			}else{
				$args['tax_query'] = $this->get_tax_query();
			}


			$args = apply_filters('agnidgwt_wcas_products_args', $args);

			$products = get_posts( $args );

			if ( !empty( $products ) ) {

				foreach ( $products as $post ) {
					$product = wc_get_product( $post );

					$r = array(
						'post_id'	 => $product->get_id(),
						'value'		 => html_entity_decode(wp_strip_all_tags($product->get_title())),
						'url'		 => $product->get_permalink(),
					);

					// Get thumb HTML
					$r[ 'thumb_html' ] = $product->get_image( 'shop_catalog' );
					// Get price
					$r[ 'price' ] = $product->get_price_html();

					// Get description
					if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_product_desc' ) === 'on' ) {
						if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_details_box' ) === 'on' ) {
							$this->desc_limit = 60;
						}
						$r[ 'desc' ] = agnidgwt_wcas_get_product_desc( $product->get_id(), $this->desc_limit );
					}

					// Get SKU
					if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_product_sku' ) === 'on' ) {
						$r[ 'sku' ] = $product->get_sku();
					}

					// Is on sale 
					if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_sale_badge' ) === 'on' ) {
						$r[ 'on_sale' ] = $product->is_on_sale();
					}

					// Is featured
					if ( AGNIDGWT_WCAS()->settings->get_opt( 'show_featured_badge' ) === 'on' ) {
						$r[ 'featured' ] = $product->is_featured();
					}

					$results[] = apply_filters( 'agnidgwt_wcas_products_suggestions', $r, $product );
				}
			}
			wp_reset_postdata();
		} /* END SEARCH IN PRODUCTS */



		// Show nothing on empty results
		//@todo show 'No results' as option
		if ( empty( $results ) ) {

			$results[] = array(
				'value' => __( 'No results', 'agni-halena-plugin' ),
			);
		}

		//@todo Add results to the wp cache

		$output[ 'suggestions' ] = $results;

		echo json_encode( $output );
		die();
	}

	/*
	 * Get meta query
	 * For WooCommerce < 3.0
	 * 
	 * return array
	 */

	private function get_meta_query() {

		$meta_query = array();

		$meta_query = array(
			'relation' => 'AND',
			1          => array(
				'key'     => '_visibility',
				'value'   => array( 'search', 'visible' ),
				'compare' => 'IN'
			),
			2          => array(
				'relation' => 'OR',
				array(
					'key'     => '_visibility',
					'value'   => array( 'search', 'visible' ),
					'compare' => 'IN'
				)
			)
		);


		// Exclude out of stock products from suggestions
		if ( AGNIDGWT_WCAS()->settings->get_opt( 'exclude_out_of_stock' ) === 'on' ) {
			$meta_query[] = array(
				'key'     => '_stock_status',
				'value'   => 'outofstock',
				'compare' => 'NOT IN'
			);
		};

		return $meta_query;
	}

	/*
	 * Get tax query
	 * For WooCommerce >= 3.0
	 *
	 * return array
	 */

	private function get_tax_query() {

		$product_visibility_term_ids = wc_get_product_visibility_term_ids();

		$tax_query = array(
			'relation' => 'AND'
		);

		$tax_query[] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'term_taxonomy_id',
			'terms'    => $product_visibility_term_ids['exclude-from-search'],
			'operator' => 'NOT IN',
		);


		 // Exclude out of stock products from suggestions
		if ( AGNIDGWT_WCAS()->settings->get_opt( 'exclude_out_of_stock' ) === 'on' ) {
			$tax_query[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['outofstock'],
				'operator' => 'NOT IN',
			);
		};

		return $tax_query;
	}

	/*
	 * Search for matching category
	 * 
	 * @param string $keyword
	 * 
	 * @return array
	 */

	public function get_categories( $keyword ) {

		$results = array();

		$args = array(
			'taxonomy' => AGNIDGWT_WCAS_WOO_PRODUCT_CATEGORY
		);

		$product_categories = get_terms( AGNIDGWT_WCAS_WOO_PRODUCT_CATEGORY, $args );

// Compare keyword and term name
		$i = 0;
		foreach ( $product_categories as $cat ) {

			if ( $i < $this->limit ) {

				$pos = strpos( strtolower( $cat->name ), strtolower( $keyword ) );

				if ( $pos !== false ) {
					$results[ $i ] = array(
						'term_id'	 => $cat->term_id,
						'taxonomy'	 => AGNIDGWT_WCAS_WOO_PRODUCT_CATEGORY,
						'value'		 => preg_replace( sprintf( "/(%s)/", $keyword ), "$1", $cat->name ),
						'url'		 => get_term_link( $cat, AGNIDGWT_WCAS_WOO_PRODUCT_CATEGORY ),
						'parents'	 => ''
					);


					// Add category parents info
					$parents = $this->get_taxonomy_parent_string( $cat->term_id, AGNIDGWT_WCAS_WOO_PRODUCT_CATEGORY, array(), array( $cat->term_id ) );

					if ( !empty( $parents ) ) {

						$results[ $i ][ 'parents' ] = sprintf( ' <em>%s <b>%s</b></em>', __( 'in', 'agni-halena-plugin' ), mb_substr( $parents, 0, -3 ) );
					}

					$i++;
				}
			}


		}

		return $results;
	}

	/*
	 * Extend research in the Woo tags
	 * 
	 * @param strong $keyword
	 * 
	 * @return array
	 */

	public function get_tags( $keyword ) {

		$results = array();

		$args = array(
			'taxonomy' => AGNIDGWT_WCAS_WOO_PRODUCT_TAG
		);

		$product_tags = get_terms( AGNIDGWT_WCAS_WOO_PRODUCT_TAG, $args );

// Compare keyword and term name
		$i = 0;
		foreach ( $product_tags as $tag ) {

			if ( $i < $this->limit ) {

				$pos = strpos( strtolower( $tag->name ), strtolower( $keyword ) );

				if ( $pos !== false ) {
					$results[ $i ] = array(
						'term_id'	 => $tag->term_id,
						'taxonomy'	 => AGNIDGWT_WCAS_WOO_PRODUCT_TAG,
						'value'		 => preg_replace( sprintf( "/(%s)/", $keyword ), "$1", $tag->name ),
						'url'		 => get_term_link( $tag, AGNIDGWT_WCAS_WOO_PRODUCT_TAG ),
						'parents'	 => ''
					);

					// Add taxonomy parents info
					$parents = $this->get_taxonomy_parent_string( $tag->term_id, AGNIDGWT_WCAS_WOO_PRODUCT_TAG, array(), array( $tag->term_id ) );

					if ( !empty( $parents ) ) {

						$results[ $i ][ 'parents' ] = sprintf( ' <em>%s <b>%s</b></em>', __( 'in', 'agni-halena-plugin' ), mb_substr( $parents, 0, -3 ) );
					}

					$i++;
				}
			}
		}

		return $results;
	}

	/*
	 * Set search product limit
	 */

	public function change_wp_search_size( $query ) {

		if ( $this->is_ajax_search() ) {
			if ( $query->is_search )
				$query->query_vars[ 'posts_per_page' ] = $this->slots;
		}

		return $query;
	}

	/*
	 * Search only in products titles
	 * 
	 * @param string $search SQL
	 * 
	 * @return string prepared SQL
	 */

	public function search_filters( $search, $wp_query ) {
		global $wpdb;

		if ( empty( $search ) || is_admin() ) {
			return $search; // skip processing - there is no keyword
		}

		if ( $this->is_ajax_search() || $this->is_search_page() ) {

			$q = $wp_query->query_vars;

			if ( $q[ 'post_type' ] !== AGNIDGWT_WCAS_WOO_PRODUCT_POST_TYPE ) {
				return $search; // skip processing
			}

			$n = !empty( $q[ 'exact' ] ) ? '' : '%';

			$search		 = $searchand	 = '';

			if ( !empty( $q[ 'search_terms' ] ) ) {
				foreach ( (array) $q[ 'search_terms' ] as $term ) {
					$term = esc_sql( $wpdb->esc_like( $term ) );

					$search .= "{$searchand} (";

					// Search in title
					$search .= "($wpdb->posts.post_title LIKE '{$n}{$term}{$n}')";

					// Search in content
					if ( AGNIDGWT_WCAS()->settings->get_opt( 'search_in_product_content' ) === 'on' ) {
						$search .= " OR ($wpdb->posts.post_content LIKE '{$n}{$term}{$n}')";
					}

					// Search in excerpt
					if ( AGNIDGWT_WCAS()->settings->get_opt( 'search_in_product_excerpt' ) === 'on' ) {
						$search .= " OR ($wpdb->posts.post_excerpt LIKE '{$n}{$term}{$n}')";
					}

					// Search in SKU
					if ( AGNIDGWT_WCAS()->settings->get_opt( 'search_in_product_sku' ) === 'on' ) {
						$search .= " OR (agnidgwt_wcasmsku.meta_key='_sku' AND agnidgwt_wcasmsku.meta_value LIKE '{$n}{$term}{$n}')";
					}

					$search .= ")";

					$searchand = ' AND ';
				}
			}

			if ( !empty( $search ) ) {
				$search = " AND ({$search}) ";
				if ( !is_user_logged_in() )
					$search .= " AND ($wpdb->posts.post_password = '') ";
			}
		}

		return $search;
	}

	/**
	 * @param $where
	 *
	 * @return string
	 */
	public function search_distinct($where) {
		if ( $this->is_ajax_search() || $this->is_search_page() ) {
			return 'DISTINCT';
		}

		return $where;
	}

	/*
	 * Join the postmeta column in the search posts SQL
	 */

	public function search_filters_join( $join, $query ) {
		global $wpdb;

		if ( empty( $query->query_vars[ 'post_type' ] ) || $query->query_vars[ 'post_type' ] !== 'product' ) {
			return $join; // skip processing
		}

		if ( ($this->is_ajax_search() || $this->is_search_page()) && !is_admin() ) {

			if ( AGNIDGWT_WCAS()->settings->get_opt( 'search_in_product_sku' ) === 'on' ) {
				$join .= " INNER JOIN $wpdb->postmeta AS agnidgwt_wcasmsku ON ( $wpdb->posts.ID = agnidgwt_wcasmsku.post_id )";
			}
		}


		return $join;
	}

	/**
	 * Corrects the search by excerpt if necessary.
	 * WooCommerce adds search in excerpt by defaults and this should be corrected.
	 *
	 * @since 1.1.4
	 *
	 * @param string $where
	 * @return string
	 */
	public function fix_woo_excerpt_search($where){
		global $wp_the_query;

		// If this is not a WC Query, do not modify the query
		if ( empty( $wp_the_query->query_vars['wc_query'] ) || empty( $wp_the_query->query_vars['s'] ) ) {
			return $where;
		}

		if ( AGNIDGWT_WCAS()->settings->get_opt( 'search_in_product_excerpt' ) !== 'on' ) {

			$where = preg_replace(
				"/OR \(post_excerpt\s+LIKE\s*(\'\%[^\%]+\%\')\)/",
				"", $where );
		}

		return $where;
	}

	/**
	 * Get taxonomy parent
	 *
	 * @param int $term_id
	 * @param string $taxonomy
	 *
	 * @return string
	 */

	private function get_taxonomy_parent_string( $term_id, $taxonomy, $visited = array(), $exclude = array() ) {

		$chain		 = '';
		$separator	 = ' > ';

		$parent = get_term( $term_id, $taxonomy );

		if ( empty( $parent ) || !isset( $parent->name ) ) {
			return '';
		}

		$name = $parent->name;

		if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
			$visited[] = $parent->parent;
			$chain .= $this->get_taxonomy_parent_string( $parent->parent, $taxonomy, $visited );
		}

		if ( !in_array( $parent->term_id, $exclude ) ) {
			$chain .= $name . $separator;
		}

		return $chain;
	}

	/*
	 * Change default search query on the search results page
	 * 
	 * @since 1.0.3
	 * 
	 * @param object $query
	 * 
	 * @return object
	 */

	public function set_search_results_query( $query ) {
		global $woocommerce;

		if ( !$this->is_ajax_search() && $query->is_search ) {

			if ( $this->is_search_page() ) {

				$query->query_vars[ 'post_type' ] = AGNIDGWT_WCAS_WOO_PRODUCT_POST_TYPE;
				$query->query_vars[ 'ignore_sticky_posts' ] = 1;
				$query->query_vars[ 'suppress_filters' ] = false;

				// Backward compatibility WC < 3.0
				if ( agnidgwt_wcas_compare_wc_version( '3.0', '<' ) ) {
					$query->query_vars[ 'meta_query' ] = $this->get_meta_query();
				}else{
					$query->query_vars[ 'tax_query' ] = $this->get_tax_query();
				}


				$ordering_args = $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );

				$query->query_vars[ 'orderby' ] = $ordering_args[ 'orderby' ];
				$query->query_vars[ 'order' ] = $ordering_args[ 'order' ];

				$query->query_vars = apply_filters('agnidgwt_wcas_products_search_page_args', $query->query_vars);

			}
		}

		return $query;
	}

	/**
	 * Check if is WooCommerce search results page
	 *
	 * @since 1.1.3
	 *
	 * @return bool
	 */
	public function is_search_page() {
		if ( ! empty( $_GET['agnidgwt_wcas'] ) && ! empty( $_GET['s'] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Check if is ajax search processing
	 *
	 * @since 1.1.3
	 *
	 * @return bool
	 */
	public function is_ajax_search() {
		if ( defined( 'AGNIDGWT_WCAS_AJAX' ) && AGNIDGWT_WCAS_AJAX ) {
			return true;
		}

		return false;
	}

}

?>