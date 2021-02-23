<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Log_Lolla
 */


 if (! function_exists( 'log_lolla_sticky_post_text' ) ) {
   /**
    * Returns a text / HTML for a sticky post
    *
    * @return string
    */
   function log_lolla_sticky_post_text() {
     /* translators: sticky post text. */
     return esc_html_x( 'Featured', 'sticky post text', 'log-lolla' );
   }
 }


if (! function_exists( 'log_lolla_word_count' ) ) {
  /**
   * Count words in a text
   *
   * @link http://www.thomashardy.me.uk/wordpress-word-count-function
   *
   * @return integer
   */
  function log_lolla_word_count( $text ) {
    return str_word_count( $text );
  }
}



if ( ! function_exists( 'log_lolla_get_post_first_image_url' ) ) {
  /**
  * Get the first image from each post and resize it.
  * Returns an URL
  *
  * @link https://css-tricks.com/snippets/wordpress/get-the-first-image-from-a-post/
  *
  * @return string $first_img.
  *
  */
 function log_lolla_get_post_first_image_url() {
 	global $post;
 	$first_img = '';
 	preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', do_shortcode( $post->post_content, 'gallery' ), $matches );
  $first_img = isset( $matches[1][0] ) ? $matches[1][0] : null;

 	if ( empty( $first_img ) ) {
 		return get_template_directory_uri() . '/assets/images/empty.png'; // path to default image.
 	}

	return $first_img;
 }
}


 if ( ! function_exists( 'log_lolla_add_arrow_to_link_title' ) ) {
   /**
    * Add arrow after the link title
    *
    * @return string
    */
   function log_lolla_add_arrow_to_link_title( $title ) {
    $arrow = log_lolla_get_arrow_html( 'right' );

    return $title . $arrow;
   }
 }



if ( ! function_exists( 'log_lolla_post_has_link' ) ) {
 /**
 * Return true if post has link
 *
 * @return boolen
 */
function log_lolla_post_has_link() {
  $has_title = the_title_attribute( 'echo=0');

  return ( ! empty( $has_title ) );
 }
}



if ( ! function_exists( 'log_lolla_get_link_title_for_link_post_format' ) ) {
  /**
  * Return link title for the link post format
  * Returns either the post title, or url where it points
  *
  * @return string
  */
 function log_lolla_get_link_title_for_link_post_format( $url ) {
   $has_title = the_title_attribute( 'echo=0');

   return ( ! empty( $has_title ) ) ? $has_title : $url;
  }
}


if ( ! function_exists( 'log_lolla_post_link_is_external' ) ) {
  /**
   * Return true is the post link is external
   *
   * @return boolean
   */
  function log_lolla_post_link_is_external() {
    $url = log_lolla_get_link_from_content();
    return ($url === apply_filters( 'the_permalink', get_permalink() ));
  }
}


if ( ! function_exists( 'log_lolla_get_link_from_content_class' ) ) {
  /**
   * Return a class for the link post format
   *
   * @return string
   */
  function log_lolla_get_link_from_content_class( $url ) {
    return ($url === apply_filters( 'the_permalink', get_permalink() )) ? 'local-link' : 'external-link';
  }
}


if ( ! function_exists( 'log_lolla_get_link_from_content' ) ) {
  /**
   * Return link from post content for the link post format
   * Returns either the link, or the post permalink if the link cannot be get
   *
   * @return string
   */
  function log_lolla_get_link_from_content() {
    $content = get_the_content();
  	$has_url = get_url_in_content( $content );

  	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
  }
}


if ( ! function_exists( 'log_lolla_post_class' ) ) {
  /**
   * Returns a custom post class
   *
   * @return string
   */
   function log_lolla_post_class() {
     // Changing the post grid based on how long a post & it's excerpt is
     $max_word_count = 50;

     $post_word_count = log_lolla_word_count( strip_tags( get_the_content() ) );
     $grid = ( $post_word_count < $max_word_count ) ? ' display-horizontal' : ' display-vertical';
     $klass = '';

     if ( has_excerpt() ) {
       $excerpt_word_count = log_lolla_word_count( strip_tags( get_the_excerpt() ) );
       $grid = ( $excerpt_word_count < $max_word_count ) ? ' display-horizontal' : ' display-vertical';
       $klass .= ' has-excerpt';
     }

     if ( has_post_thumbnail() ) {
       $klass .= ' has-thumbnail';
     }

     return $grid . $klass;
  }
}


if ( ! function_exists( 'log_lolla_header_class' ) ) {
  /**
   * Returns a custom header class
   *
   * @return string
   */
   function log_lolla_header_class() {
     $header_image = get_header_image() ? ' with-header-image' : ' without-header-image';
     $logo = has_custom_logo() ? ' with-logo' : ' without-logo';
     $header_text = display_header_text() ? ' with-header-text' : ' without-header-text';
     $header_menu = function_exists( 'log_lolla_header_menu_contents' ) ? ' with-header-menu' : ' without-header-menu';

     return $header_image . $logo . $header_text . $header_menu;
  }
}


 if ( ! function_exists( 'log_lolla_hamburger_icon' ) ) {
   /**
    * Return HTML markup for hamburger icon
    *
    * @return string
    *
    */
    function log_lolla_hamburger_icon() {
    	echo '<span class="icon">&#x2630;</span>';
    }
 }


 if ( ! function_exists( 'log_lolla_hamburger_icon_x' ) ) {
   /**
    * Return HTML markup for hamburger icon X
    *
    * @return string
    */
    function log_lolla_hamburger_icon_x() {
   	 echo '<span class="icon">&times;</span>';
    }
 }


if ( ! function_exists( 'log_lolla_get_arrow_html' ) ) {
 /**
  * Return HTML markup for an arrow
  *
  * @param [string] $direction the arrow direction liek top, left, right, bottom
  *
  * @return string
  */
 function log_lolla_get_arrow_html( $direction ) {
   return '<span class="arrow-with-triangle arrow-with-triangle--' . $direction . '">
 					  	<span class="arrow-with-triangle__line"></span>
 					  	<span class="triangle triangle-- arrow-with-triangle__triangle"></span>
 						</span>';
 }
}



if ( ! function_exists( 'log_lolla_header_menu_contents' ) ) {
  /**
  * What goes into the header menu
  * If this function is removed the header menu won't be displayed
  *
  * Example code for Header Menu
  *
  * <a href="#sidebar">
     	<span class="text">Archives</span>
     	<div class="arrows" style="display:flex;flex-wrap:wrap">
     		<span class="arrow-with-triangle arrow-with-triangle--bottom">
      					  	<span class="arrow-with-triangle__line"></span>
      					  	<span class="triangle triangle-- arrow-with-triangle__triangle"></span>
      						</span>
     		<span class="arrow-with-triangle arrow-with-triangle--bottom">
      					  	<span class="arrow-with-triangle__line"></span>
      					  	<span class="triangle triangle-- arrow-with-triangle__triangle"></span>
      						</span>
     		<span class="arrow-with-triangle arrow-with-triangle--bottom">
      					  	<span class="arrow-with-triangle__line"></span>
      					  	<span class="triangle triangle-- arrow-with-triangle__triangle"></span>
      						</span>
     	</div>
     </a>
  *
  * @return string
  *
  */
  function log_lolla_header_menu_contents() {
    if ( is_active_sidebar( 'sidebar-2' ) ) {
      dynamic_sidebar( 'sidebar-2' );
    } else {
      /* translators: empty header menu text. */
      echo esc_html_x( 'Use the `Header Menu` widget to define what content goes here', 'empty header menu text', 'log-lolla' );
    }
  }
}


if ( ! function_exists( 'log_lolla_post_permalink' ) ) {
  /**
   * Prints HTML with meta information for the current post link
   *
   */
  function log_lolla_post_permalink() {
    printf(
      '<div class="permalink"><a class="link" href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0') . '">%s</a></div>',
      /* translators: %s: post permalink. */
      esc_html_x( '&infin;', 'post permalink', 'log-lolla' )
    );
  }
}


if ( ! function_exists( 'log_lolla_post_author_linking_to_post' ) ) {
  /**
   * Prints HTML with meta information for the current post author
   *
   */
  function log_lolla_post_author_linking_to_post() {
    printf(
      '<div class="byline"><span class="author vcard"><a class="link" href="' . esc_url( get_permalink() ) . '" title="' . the_title_attribute( 'echo=0') . '">%s' . esc_html( get_the_author() ) . '</a></span></div>',
      /* translators: %s: status update by. */
      esc_html_x( 'status update by ', 'status update by', 'log-lolla' )
    );
  }
}



if ( ! function_exists( 'log_lolla_post_author' ) ) {
  /**
   * Prints HTML with meta information for the current post author
   *
   */
  function log_lolla_post_author() {
    printf(
      '<div class="byline">%s <span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></div>',
			/* translators: %s: post author. */
			esc_html_x( 'by', 'post author', 'log-lolla' )
		);
  }
}


if ( ! function_exists( 'log_lolla_post_date_and_time' ) ) {
  /**
   * Prints HTML with meta information for the current post-date/time
   *
   * The date format is set on the admin interface
   * Preferably to 'M j, y'
   */
  function log_lolla_post_date_and_time() {
    printf(
			'<div class="posted-on"><time class="date published" datetime="%1$s">%2$s</time></div>',
			esc_attr( get_the_date( 'c' ) . ', ' .  get_the_time( 'c' ) ),
			esc_html( get_the_date() . ', ' . get_the_time() )
		);
  }
}



if ( ! function_exists( 'log_lolla_post_date' ) ) {
  /**
   * Prints HTML with meta information for the current post-date/time
   *
   * The date format is set on the admin interface
   * Preferably to 'M j, y'
   */
  function log_lolla_post_date() {
    printf(
			'<div class="posted-on"><time class="date published" datetime="%1$s">%2$s</time></div>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
  }
}


if (! function_exists( 'log_lolla_post_categories' ) ) {
  /**
   * Prints HTML with meta information for the categories
   */
  function log_lolla_post_categories() {
    $categories_list = get_the_category_list( esc_html__( ', ', 'log-lolla' ) );

    if ( $categories_list ) {
      /* translators: 1: list of categories. */
      printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s. ', 'log-lolla' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }
  }
}


if (! function_exists( 'log_lolla_post_tags' ) ) {
  /**
   * Prints HTML with meta information for the tags
   */
  function log_lolla_post_tags() {
    $categories_list = get_the_category_list( esc_html__( ', ', 'log-lolla' ) );

    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'log-lolla' ) );
    if ( $tags_list ) {
      /* translators: 1: list of tags. */
      printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s. ', 'log-lolla' ) . '</span>', $tags_list ); // WPCS: XSS OK.
    }
  }
}


if (! function_exists( 'log_lolla_post_edit_link' ) ) {
  /**
   * Prints HTML with meta information for the edit link
   */
  function log_lolla_post_edit_link() {
    edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'log-lolla' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
  }
}
?>
