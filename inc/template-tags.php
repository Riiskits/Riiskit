<?php
/**
 * Custom template tags for Riiskit.
 *
 * @package		Riiskit
 * @subpackage	functions.php
 * @since		1.0.0
 */


if ( ! function_exists( 'riiskit_get_current_url' ) ) :
/**
 * Returns the current URL.
 *
 * No need identifying whether the host is using SSL etc.
 * You can add a trailing slash to it with trailingslashit() if you need to.
 *
 * @since Riiskit 1.0.0
 *
 * @return $cur_url
 */
function riiskit_get_current_url() {
	global $wp;
	$cur_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	return $cur_url;
}
endif;


if ( ! function_exists( 'riiskit_get_term_name' ) ) :
/**
 * Gets the term name of the current post.
 *
 * @since Riiskit 1.0.0
 *
 * @return $term->name
 */
function riiskit_get_term_name() {
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	return $term->name;
}
endif;


if ( ! function_exists( 'riiskit_get_the_terms' ) ) :
/**
 * Gets the post's tags/taxonomies terms.
 *
 * @since Riiskit 1.0.0
 *
 * @return implode(', ', $term_names) / false
 */
function riiskit_get_the_terms($taxonomy = '', $id = '') {
	global $post;

	$id = '' == $id ? $post->ID : $id;

	if ( $taxonomy !== '' ) {
		$terms = wp_get_object_terms( $id, $taxonomy ) ;
	} else {
		$terms = wp_get_post_tags($id);
	}

	if ( ! empty($terms) ){
		foreach ( $terms as $term ) {
			if ( ! is_wp_error($terms) ) {
				$term_names[] = $term->name;
			}
			else {
				continue;
			}
		}

		return implode( ', ', $term_names );
	} else {
		return false;
	}
}
endif;


if ( ! function_exists( 'riiskit_is_custom_post_type' ) ) :
/**
 * Check to see if the current post is a custom post type.
 *
 * @since Riiskit 1.0.0
 *
 * @return bool
 */
function riiskit_is_custom_post_type() {
	global $post;

	if ( ! in_array( $post->post_type , get_post_types( array('_builtin' => true) ) ) ) {
		return true;
 	}
 	return false;
 }
endif;


if ( ! function_exists( 'riiskit_truncate_str' ) ) :
/**
 * Truncates a string to a defined max length.
 *
 * @since Riiskit 1.0.0
 *
 * @param string $string, integer $limit, string $break string $pad
 * @return $string
 */
function riiskit_truncate_str( $string, $limit = 100, $break = " ", $pad = "…" ) {
	// return with no change if string is shorter than $limit
	if ( strlen($string) <= $limit ) {
		return $string;
	}

	// is $break present between $limit and the end of the string?
	if ( false !== ( $breakpoint = strpos($string, $break, $limit) ) ) {
		if ( $breakpoint < strlen($string) - 1 ) {
		  $string = substr($string, 0, $breakpoint) . $pad;
		}
	}

	return $string;
}
endif;


if ( ! function_exists( 'riiskit_the_excerpt' ) ) :
/**
 * Function for displaying excerpts with custom lengths.
 *
 * @since Riiskit 1.0.0
 *
 * @param integer $charlength
*/
function riiskit_the_excerpt($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '&hellip;';
	} else {
		echo $excerpt;
	}
}
endif;


if( ! function_exists( 'riiskit_get_attachment_img' ) ) :
/**
 * Outputs an attachment image.
 *
 * If you need the image to stretch based on the browser window,
 * just set the "div" boolean to true and it will return a div
 * with "background-size: cover;".
 *
 * @param integer $attachment_id, array $options(string 'size', string 'class', boolean 'div')
 * @return image or div with the attachment image src as a string
 *
 * @since Riiskit 1.0.0
 */
function riiskit_get_attachment_img( $attachment_id = '', $options = array() )
{
	$options = array_merge( array(
		'size'			=> 'post-thumbnail',
		'class'			=> '',
		'div'			=> false,
		'return_src'	=> false,
	), $options);

	if ( '' === $attachment_id ) {
		return;
	} else {
		$attachment		= get_post( absint($attachment_id) );
		$alt			= esc_attr( get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) );
		$img			= wp_get_attachment_image_src( $attachment_id, $options['size'] );
		$img_src		= esc_attr( $img[0] );
		$img_width		= absint( $img[1] );
		$img_height		= absint( $img[2] );
		$class			= ! empty($options['class']) ? "class='{$options['class']}'" : '';

		if ( true === $options['div'] ) {
			return "<div $class style='background-image: url($img[0]);'></div>";
		} elseif ( true === $options['return_src'] ) {
			return $img_src;
		} else {
			return "<img $class src='$img_src' width='$img_width' height='$img_height' alt='$alt' />";
		}
	}
}
endif;


if ( ! function_exists( 'riiskit_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * @param array $options(integer id, string size, string class)
 *
 * @since Riiskit 1.0.0
 */
function riiskit_post_thumbnail( $options = array() ) {
	$options = array_merge( array(
		'id'			=> get_the_id(),
		'size'			=> 'post-thumbnail',
		'class'			=> '',
	), $options);

	if ( post_password_required() || is_attachment() || ! has_post_thumbnail($options['id']) ) {
		return;
	}

	echo get_the_post_thumbnail( $options['id'], $options['size'], array( 'class' => $options['class'] ) );
}
endif;


if ( ! function_exists( 'riiskit_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Riiskit 1.0.0
 */
function riiskit_entry_meta() {
	// Dates: published and updated
	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> | %3$s <time class="updated" datetime="%4$s">%5$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			_x( 'Updated', 'Used before updated date.', 'riiskit' ),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on">%1$s %2$s</span>',
			_x( 'Posted on', 'Used before publish date.', 'riiskit' ),
			$time_string
		);
	}

	// Post
	if ( 'post' == get_post_type() ) {
		// author
		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
				_x( 'Author', 'Used before post author name.', 'riiskit' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		// categories
		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'riiskit' ) );
		if ( $categories_list && riiskit_categorized_blog() ) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'riiskit' ),
				$categories_list
			);
		}

		// tags
		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'riiskit' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'riiskit' ),
				$tags_list
			);
		}
	}
}
endif;


/**
 * Determine whether blog/site has more than one category.
 *
 * @since Riiskit 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function riiskit_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'riiskit_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'riiskit_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so riiskit_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so riiskit_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in { @see riiskit_categorized_blog() }.
 *
 * @since Riiskit 1.0
 */
function riiskit_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'riiskit_categories' );
}
add_action( 'edit_category', 'riiskit_category_transient_flusher' );
add_action( 'save_post',     'riiskit_category_transient_flusher' );
