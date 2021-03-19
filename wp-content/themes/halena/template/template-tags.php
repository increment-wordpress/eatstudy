<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Agni Framework
 */

if ( ! function_exists( 'agni_framework_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function agni_framework_post_nav() {
	global $halena_options;
	
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
    	<nav class="post-navigation navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'halena' ); ?></h2>
            <div id="post-nav-links" class="nav-links">
				<?php
					$nav_previous = isset($halena_options['blog-single-prev'])?$halena_options['blog-single-prev']:'Previous';
					$nav_next = isset($halena_options['blog-single-next'])?$halena_options['blog-single-next']:'Next';
                    echo '<div class="nav-inner nav-previous">'; 

                    $previous_post = get_previous_post();
                    if( !empty($previous_post) ){
	                    $previous_post_thumbnail = ( has_post_thumbnail( $previous_post->ID ) )?'<span class="nav-post-thumbnail nav-previous-post-thumbnail">'.get_the_post_thumbnail( $previous_post->ID, 'thumbnail' ).'</span>':'';
	                    $nav_previous_content = '<span class="nav-post-content nav-previous-post-content">
	                    	<span class="nav-next-label">'.$nav_previous.'</span>
	                    	<span class="nav-post-title nav-next-post-title primary-typo">'.$previous_post->post_title.'</span>
	                    </span>';

	                    previous_post_link( '%link', $previous_post_thumbnail.$nav_previous_content );
	                }
                    echo '</div>';

                    echo '<div class="nav-divide"></div>'; 
                    
                    echo '<div class="nav-inner nav-next">'; 
                    $next_post = get_next_post();
                    if( !empty($next_post) ){
	                    $next_post_thumbnail = ( has_post_thumbnail( $next_post->ID ) )?'<span class="nav-post-thumbnail nav-next-post-thumbnail">'.get_the_post_thumbnail( $next_post->ID, 'thumbnail' ).'</span>':'';
	                    $nav_next_content = '<span class="nav-post-content nav-next-post-content">
	                    	<span class="nav-next-label">'.$nav_next.'</span>
	                    	<span class="nav-post-title nav-next-post-title primary-typo">'.$next_post->post_title.'</span>
	                    </span>';

	                    next_post_link( '%link', $nav_next_content.$next_post_thumbnail );
	                }
                    echo '</div>'; 
                ?>
            </div>
     	</nav><!-- .nav-links -->
	<?php
}
endif;

if ( ! function_exists( 'agni_framework_portfolio_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function agni_framework_portfolio_nav() {
	global $halena_options;
	
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
    	<nav class="portfolio-navigation navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e( 'Portfolio navigation', 'halena' ); ?></h2>
            <div id="portfolio-nav-links" class="nav-links">
				<?php
				$nav_previous = isset($halena_options['portfolio-single-prev'])?$halena_options['portfolio-single-prev']:'Previous';
					$nav_next = isset($halena_options['portfolio-single-next'])?$halena_options['portfolio-single-next']:'Next';
                    echo '<div class="nav-inner nav-previous">'; 

                    $previous_post = get_previous_post();
                    if( !empty($previous_post) ){
	                    $previous_post_thumbnail = ( has_post_thumbnail( $previous_post->ID ) )?'<span class="nav-post-thumbnail nav-previous-post-thumbnail">'.get_the_post_thumbnail( $previous_post->ID, 'thumbnail' ).'</span>':'';
	                    $nav_previous_content = '<span class="nav-post-content nav-previous-post-content">
	                    	<span class="nav-next-label">'.$nav_previous.'</span>
	                    	<span class="nav-post-title nav-next-post-title primary-typo">'.$previous_post->post_title.'</span>
	                    </span>';

	                    previous_post_link( '%link', $previous_post_thumbnail.$nav_previous_content );
	                }
                    echo '</div>';

                    echo '<div class="nav-divide"></div>'; 
                    
                    echo '<div class="nav-inner nav-next">'; 
                    $next_post = get_next_post();
                    if( !empty($next_post) ){
	                    $next_post_thumbnail = ( has_post_thumbnail( $next_post->ID ) )?'<span class="nav-post-thumbnail nav-next-post-thumbnail">'.get_the_post_thumbnail( $next_post->ID, 'thumbnail' ).'</span>':'';
	                    $nav_next_content = '<span class="nav-post-content nav-next-post-content">
	                    	<span class="nav-next-label">'.$nav_next.'</span>
	                    	<span class="nav-post-title nav-next-post-title primary-typo">'.$next_post->post_title.'</span>
	                    </span>';

	                    next_post_link( '%link', $nav_next_content.$next_post_thumbnail );
	                }
                    echo '</div>'; 
                ?>
            </div>
     	</nav><!-- .nav-links -->
	<?php
}
endif;

if ( ! function_exists( 'agni_framework_post_date' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time.
 */
function agni_framework_post_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}


	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( get_option('time_format') ) ),
		esc_html( get_the_time( get_option( 'date_format' ) ) ),
		esc_attr( get_the_modified_date( get_option('time_format') ) ),
		esc_html( get_the_modified_date( get_option( 'date_format' ) ) )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'halena' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	return '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'agni_framework_post_author' ) ) :
/**
 * Prints HTML with meta information for the current author.
 */
function agni_framework_post_author() {
	
	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'halena' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	return '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'agni_framework_post_cat' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function agni_framework_post_cat() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( '.', 'halena' ) );
		if ( $categories_list && agni_framework_categorized_blog() ) {
			return '<span class="cat-links">'.$categories_list.'</span>';
		}
	}
}
endif;

if ( ! function_exists( 'agni_framework_post_tag' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function agni_framework_post_tag() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'halena' ) );// comma deleted 
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( '%1$s', 'halena' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'agni_framework_post_comment' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function agni_framework_post_comment() {

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'halena' ), esc_html__( '1 Comment', 'halena' ), esc_html__( '% Comments', 'halena' ) );
		echo '</span>';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function agni_framework_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'agni_framework_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'agni_framework_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so agni_framework_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so agni_framework_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in agni_framework_categorized_blog.
 */
function agni_framework_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'agni_framework_categories' );
}
add_action( 'edit_category', 'agni_framework_category_transient_flusher' );
add_action( 'save_post',     'agni_framework_category_transient_flusher' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function agni_framework_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'agni_framework_body_classes' );
