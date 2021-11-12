<?php
/**
 * KantinS15 functions and definitions.
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * function prefix  --> kantin_
 * option prefix    --> kantin-
 * package name     --> KantinS15
 * textdomain name  --> kantins15
 *
 * @package KantinS15
 */

$theme_opts = array();

$updirs = wp_upload_dir();
/* -----------------------------------------------------------------------------
$updirs = array ( [path]    => C:\path\to\wordpress\wp-content\uploads\2010\05
                  [url]     => http://example.com/wp-content/uploads/2010/05
                  [subdir]  => /2010/05
                  [basedir] => C:\path\to\wordpress\wp-content\uploads
                  [baseurl] => http://example.com/wp-content/uploads
                  [error]   =>
                 )
-------------------------------------------------------------------------------- */

// Sets up theme constants
define('WPTHEME_TEXT_DOMAIN', 'kantins15');

define('THEME_URL', get_template_directory_uri() . '/'); 
define('THEME_IMG_URL', get_template_directory_uri() . '/images/'); 
define('THEME_CSS_URL', get_template_directory_uri() . '/uikit/css/'); 
define('THEME_JS_URL', get_template_directory_uri() . '/uikit/js/'); 

require_once get_template_directory() . '/includes/daniy-image-manager/image-manager.php';
require_once get_template_directory() . '/includes/instagram.php';
require_once get_template_directory() . '/includes/social-media.php';


/**
 * Sets up the content width value based on the theme's design and stylesheet.
 * This setting will also set the width and height attribute generated from 
 * get_the_post_thumbnail() function
 */
if ( ! isset( $content_width ) )
  $content_width = 1200;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * KantinS15 Theme supports.
 */
add_action( 'after_setup_theme', 'kantin_setup' );
function kantin_setup() { 

  // Adds RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );

  add_theme_support( 'title-tag' );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'top', 'Top Menu' );
  register_nav_menu( 'footer', 'Footer Menu' );

  // This theme uses a custom image size for featured images, displayed on "standard" posts.
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array( 'aside', 'status' ) );
  // set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop


  
}


add_action('after_switch_theme', 'kantin_setup_theme');
function kantin_setup_theme() {
  global $db, $pagenow;
  
  if( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
  }

}


/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
add_filter( 'excerpt_length', 'kantin_excerpt_length' );
function kantin_excerpt_length( $length ) {
  return 25;
}

/**
 * Returns a "Continue Reading" link for excerpts
 */
add_filter('excerpt_more', 'kantin_continue_reading_link');
function kantin_continue_reading_link() {
  return ' <a href="'. esc_url( get_permalink() ) . '">' . __( '&raquo;', WPTHEME_TEXT_DOMAIN ) . '</a>';
}


/**
 * Add meta tags into <head> part 
 */
add_action('wp_head', 'kantin_wp_head', 99);
function kantin_wp_head() {
  global $theme_opts, $post, $wp_query;

  //----- custom favicons -----//  
  if( isset ($theme_opts['custom_favicon']) && 
      strlen($theme_opts['custom_favicon']) > 5 ) {

    echo '<link rel="icon" href="' . $theme_opts['custom_favicon'] . '" />' . "\n";
    echo '<link rel="shortcut icon" href="' . $theme_opts['custom_favicon'] . '" />' . "\n";

  } else {

    echo '<link rel="icon" href="' . get_template_directory_uri() . '/lib/img/favicon.png" />' . "\n";
    echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/lib/img/favicon.png" />' . "\n";

  }  

  //----- meta robots -----//
  if( is_search() || is_404() ) {
    echo '<meta name="robots" content="noindex,follow"/>' . "\n";
  }

  //----- meta descriptions -----//
  if( is_attachment() ) {

    $posttags   = get_the_tags( $post->post_parent );
    $tag_terms  = array();
    if ($posttags) {
      foreach($posttags as $tag) {
        $tag_terms[] = $tag->name;
      }
    }
    echo '<meta name="description" content="' . get_the_title() . ' ' . implode(", ", $tag_terms) . '" />' . "\n";

  } elseif( is_single() ) {

    $content = apply_filters('the_content', $post->post_content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = wp_strip_all_tags( $content );

    $excerpt = wp_strip_all_tags(get_the_excerpt(), true);

    echo '<meta name="description" content="' . $excerpt . '" />' . "\n";

  } elseif( is_home() ) {

    $excerpt = get_bloginfo('name') . ' - ' . get_bloginfo('description');
    echo '<meta name="description" content="' . $excerpt . '" />' . "\n";

  } elseif( is_category() || is_tag() ) {

    global $posts;

    $cur_terms = $wp_query->get_queried_object();

    $post_titles = ucwords( strtolower( $cur_terms->name ) ) . ' ';
    if( $posts ) {
    foreach ($posts as $num => $tpost) {
      $post_titles .= $tpost->post_title . ' '; 
    }
    }

    echo '<meta name="description" content="' . $post_titles . '" />' . "\n";    

  }

  //----- meta descriptions -----//
  if( $theme_opts['custom_css'] ) {
    echo '<style type="text/css">';
    echo stripslashes( $theme_opts['custom_css'] );
    echo '</style>';
  }

}


add_action('wp_footer', 'kantin_wp_footer', 99);
function kantin_wp_footer() {
  global $theme_opts;

  echo stripslashes($theme_opts['wp_footer_script']);
}



/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
add_filter( 'wp_title', 'kantin_wp_title', 999, 2 );
function kantin_wp_title( $title, $sep ) {
  global $paged, $page, $post, $posts;

  $blog_title = get_bloginfo( 'name' );

  if ( is_feed() ) {
    return $title;
  }

  if( is_attachment() ) {
    $parent_title = get_the_title( $post->post_parent );
    $ttl_att = ucwords( strtolower($title) );
    $ttl_prt = ucwords( strtolower($parent_title) );
    return "{$ttl_att} {$ttl_prt} {$sep} {$blog_title}";
  }

  if( is_single() ) {
    $ttl_single = ucwords( strtolower(get_the_title( $post->ID )) );
    return "{$ttl_single} {$sep} {$blog_title}";
  }

  if( is_tag() ) {
    $first_title = $posts[0]->post_title;
    return ucwords($title) . " $first_title on $blog_title";
  } 

  // do this if WPSEO Plugin isn't installed
  if( ! function_exists('wpseo_activate') ) {  
    // Add the site name.
    $title .= $blog_title;

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
      $title = "$title $sep $site_description";
    }
  }

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 ) {
    $title = "$title $sep " . sprintf( __( 'Page %s', WPTHEME_TEXT_DOMAIN ), max( $paged, $page ) );
  }

  return $title;
}



/**
 * Create the breadcrumb HTML for a post
 *
 * @global object $post
 * @return string
 */
if( !function_exists('kantin_breadcrumb') ) {
function kantin_breadcrumb() {

  $delimiter = '&nbsp;/&nbsp;';
  $name = __('Home',WPTHEME_TEXT_DOMAIN);
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>'; 
  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
    global $post;
    $home = home_url();
    echo '<span typeof="v:Breadcrumb"><a href="' . $home . '" rel="v:url nofollow" property="v:title">' . $name . '</a></span> ' . $delimiter . ' ';

    if ( is_category() ) {

      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
        
        $parentcat = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
        $src_rep = array(
          '<a '   => '<span typeof="v:Breadcrumb"><a ',
          '</a>'  => '</a></span>',
          'href=' => 'rel="v:url nofollow" property="v:title" href=',
          );
        echo str_replace(array_keys($src_rep), array_values($src_rep), $parentcat);

      }
      echo $currentBefore . '';
      single_cat_title();
      echo '' . $currentAfter;
    
    } elseif ( is_day() ) {
      echo '<span typeof="v:Breadcrumb"><a href="' . get_year_link(get_the_time('Y')) . '" rel="v:url nofollow" property="v:title">' . get_the_time('Y') . '</a></span> ' . $delimiter . ' ';
      echo '<span typeof="v:Breadcrumb"><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '" rel="v:url nofollow" property="v:title">' . get_the_time('F') . '</a></span> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
    
    } elseif ( is_month() ) {
      echo '<span typeof="v:Breadcrumb"><a href="' . get_year_link(get_the_time('Y')) . '" rel="v:url nofollow" property="v:title">' . get_the_time('Y') . '</a></span> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
    
    } elseif ( is_year() ) {
      echo '<span typeof="v:Breadcrumb">';
      echo $currentBefore . get_the_time('Y') . $currentAfter;
      echo '</span>';
    
    } else if ( is_single() && !is_attachment() ) {
      $cat = get_the_category(); $cat = $cat[0]; 

      $parentcat = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      $src_rep = array(
        '<a '   => '<span typeof="v:Breadcrumb"><a ',
        '</a>'  => '</a></span>',
        'href=' => 'rel="v:url nofollow" property="v:title" href=',
        );
      echo str_replace(array_keys($src_rep), array_values($src_rep), $parentcat);

      echo $currentBefore;
      $ttl_single = ucwords( strtolower($post->post_title) );
      _e($ttl_single,WPTHEME_TEXT_DOMAIN);
      echo $currentAfter;
    
    } else if ( is_attachment() ) {

      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      
      $parentcat = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      $src_rep = array(
        '<a '   => '<span typeof="v:Breadcrumb"><a ',
        '</a>'  => '</a></span>',
        'href=' => 'rel="v:url nofollow" property="v:title" href=',
        );
      echo str_replace(array_keys($src_rep), array_values($src_rep), $parentcat);

      $ttl_parent = ucwords( strtolower($parent->post_title) );
      echo '<span typeof="v:Breadcrumb"><a href="' . get_permalink($parent) . '" rel="v:url nofollow" property="v:title">' . $ttl_parent . '</a></span> ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    
    } else if ( is_page() && !$post->post_parent ) {

      echo $currentBefore;
      _e($post->post_title, WPTHEME_TEXT_DOMAIN);
      echo $currentAfter;
    
    } else if ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<span typeof="v:Breadcrumb"><a href="' . get_permalink($page->ID) . '" rel="v:url nofollow" property="v:title">' . get_the_title($page->ID) . '</a></span> ';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      _e($post->post_title,WPTHEME_TEXT_DOMAIN);
      echo $currentAfter;
    
    } else if ( is_search() ) {
      echo $currentBefore . __('Search Results',WPTHEME_TEXT_DOMAIN) . $currentAfter;
    
    } else if ( is_tag() ) {
      echo $currentBefore . __('Posts tagged &#39;',WPTHEME_TEXT_DOMAIN);
      single_tag_title();
      echo '&#39;' . $currentAfter;
    
    } else if ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . __('Articles posted by ',WPTHEME_TEXT_DOMAIN) . $userdata->display_name . $currentAfter;
    
    } else if ( is_404() ) {
      echo $currentBefore . __('Error 404',WPTHEME_TEXT_DOMAIN) . $currentAfter;

    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page',WPTHEME_TEXT_DOMAIN) . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
  }
}

}


if ( ! function_exists( 'kantin_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return void
 */
function kantin_the_attached_image() {
  $post                = get_post();
  /**
   * Filter the default Twenty Fourteen attachment size.
   *
   * @since Twenty Fourteen 1.0
   *
   * @param array $dimensions {
   *     An array of height and width dimensions.
   *
   *     @type int $height Height of the image in pixels. Default 810.
   *     @type int $width  Width of the image in pixels. Default 810.
   * }
   */
  $attachment_size     = apply_filters( 'twentyfourteen_attachment_size', array( 3000, 3000 ) );
  $next_attachment_url = wp_get_attachment_url();

  /*
   * Grab the IDs of all the image attachments in a gallery so we can get the URL
   * of the next adjacent image in a gallery, or the first image (if we're
   * looking at the last image in a gallery), or, in a gallery of one, just the
   * link to that image file.
   */
  $attachment_ids = get_posts( array(
    'post_parent'    => $post->post_parent,
    'fields'         => 'ids',
    'numberposts'    => -1,
    'post_status'    => 'inherit',
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'order'          => 'ASC',
    'orderby'        => 'menu_order ID',
  ) );

  // If there is more than 1 attachment in a gallery...
  if ( count( $attachment_ids ) > 1 ) {
    foreach ( $attachment_ids as $attachment_id ) {
      if ( $attachment_id == $post->ID ) {
        $next_id = current( $attachment_ids );
        break;
      }
    }

    // get the URL of the next image attachment...
    if ( $next_id ) {
      $next_attachment_url = get_attachment_link( $next_id );
    }

    // or get the URL of the first image attachment.
    else {
      $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
    }
  }

  printf( '<a href="%1$s" rel="attachment">%2$s</a>',
    esc_url( $next_attachment_url ),
    wp_get_attachment_image( $post->ID, $attachment_size, 0, array('class'=>"img-responsive large-atttachment",) )
  );
}
endif;



/**
 * Split the content into 2-columns layout like newspapers and magazine does.
 * Default column separator is '<!--colsep-->', can be defined independently if you'd like to.
 *
 * If there's no '<!--colsep-->' tag found inside $content, this function will
 * automatically count total words separated by </p> tag, split them into two
 * and then rejoined them into left and right column divs
 * 
 * @param string $content
 * @param string $column_separator_tag
 * @return string
 */
add_filter('the_content', 'kantin_split_2cols', 50);
function kantin_split_2cols( $content, $column_separator_tag = '<!--colsep-->' ) {
  
  global $post;
  
  // On custom post types, refrain from dividing into two columns
  if( $post->post_type != 'post' && $post->post_type != 'page' )
    return $content;
  
  // On certain user defined post meta, refrain from dividing into two columns
  $nc_stat = get_post_meta( $post->ID, 'kantin_no_col_split', true );
  if( $nc_stat == '1' )
    return $content;

  $col_box  = '<div class="row">';
  $col_box .= '<div class="col-md-6">%s</div>';
  $col_box .= '<div class="col-md-6">%s</div>';
  $col_box .= '</div>';
  $pos = strpos($content, $column_separator_tag);

  if( $pos !== FALSE && $column_separator_tag != '' ) {

    $contents = explode( $column_separator_tag, $content );
    $split_content = sprintf($col_box, trim($contents[0]), trim($contents[1]));
    
    $split_content = str_replace('<p></p>', '', $split_content);

    return $split_content;

  } else {

    //----- explode $content by '</p>' count and divide by two to get proportional 'left-right' amount of words -----//
    $contents = explode('</p>', $content);
    $mid = ceil( count($contents) / 2 );
    $mid = $mid - 3; // hack the middle value

    //----- iterate and put corresponding content on left and right variable -----//
    $left  = '';
    $right = '';
    foreach ($contents as $k => $v) {

      if( $k <= $mid ) {
        $left  .= $v . '</p>';
      } else {
        $right .= $v . '</p>';
      }

    }

    $split_content = sprintf($col_box, $left, $right);

    return $split_content;

  }
  
}



if(!function_exists('is_localhost')) {
function is_localhost() {
  if( $_SERVER['SERVER_NAME'] == 'localhost' )
    return TRUE;

  else
    return FALSE;
}
}



/**
 * Add rel="nofollow" to all links on the sidebar and menus
 * 
 * @param   string  $text
 * @return  string  $text
 */
function wmcf_nofollow_links( $text ) {
  $text = stripslashes($text);
  $text = preg_replace_callback('|<a (.+?)>|i', 'wp_rel_nofollow_callback', $text);
  return $text;
}
add_filter( 'wp_nav_menu', 'wmcf_nofollow_links' );
add_filter( 'wp_list_pages', 'wmcf_nofollow_links' );
add_filter( 'wp_list_categories', 'wmcf_nofollow_links' );


/**
 * Display the post date
 * 
 * @global object $post 
 * @param string $format // date format
 */
function the_time_ID( $format='' ) {
  global $post;

  $format = ( $format ) ? $format : 'l, j F Y g:i A';

  $df = get_the_time( $format, $post );

  //change to ID date format
  $translate = array(
    // days
    'Sunday'    => 'Minggu',
    'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis',
    'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu',

    // months
    'January'   => 'Januari',
    'February'  => 'Februari',
    'March'     => 'Maret',
    'April'     => 'April',
    'May'       => 'Mei',
    'June'      => 'Juni',
    'July'      => 'Juli',
    'August'    => 'Agustus',
    'September' => 'September',
    'October'   => 'Oktober',
    'November'  => 'November',
    'December'  => 'Desember',
    );
  $df = str_replace(array_keys($translate), array_values($translate), $df);
  echo $df;
}



/**
 * wp_enqueue_script ( $handle, $src, $deps, $ver, $in_footer );
 * wp_register_script( $handle, $src, $deps, $ver, $in_footer );
 * wp_register_style( $handle, $src, $deps, $ver, $media );
 */
add_action('wp_enqueue_scripts', 'kantin_enqueue_scripts');
function kantin_enqueue_scripts() {
  
  // JavaScripts
  // wp_register_script('twitter-bootstrap',  TGC_JS_URL.'bootstrap.min.js', 'jQuery', '1.0', true);
  // wp_enqueue_script( 'twitter-bootstrap' );
  
  // Cascading Stylesheets
  wp_register_style('font-awesome', THEME_URL . 'uikit/fonts/font-awesome/font-awesome.css', FALSE, '4.3.0', 'screen');
  wp_enqueue_style('font-awesome');

}



function the_content_limit($max_char, $more_link_text = '[&#8230;]', $use_post_excerpt = FALSE) {
  
  global $post;
  
  if( $use_post_excerpt && strlen($post->post_excerpt) > 5 ) {
    $content = get_the_excerpt();
    echo $content;
    return;
  }  
  
  $content = get_the_content();
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = wp_strip_all_tags($content);
  
  if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {

    $content = substr($content, 0, $espacio);
    $content = $content;
    echo $content . " {$more_link_text}";

  } else {
    echo $content . " {$more_link_text}";

  }
  
  return;
}



function the_string_limit( $string, $max_char ) {
  
  if ((strlen($string)>$max_char) && ($espacio = strpos($string, " ", $max_char ))) {

    $string = substr($string, 0, $espacio);
    echo $string;

  } else {
    echo $string;

  }

  
  return;
}


/**
 * Check the $n is the multiples result of $multiplier
 *
 * Useful in a foreach iteration to output thumbnail images.
 * If you have a set of thumbnails inside a container of certain width,
 * each images has 10px margin-right which need to be reset after 4 times in a row
 * To calculate which image needed to be reset, this function
 * is a great help, saves you two lines of code
 *
 * @author  Murdani Eko
 * @param   int   $n
 * @param   int   $multiplier
 * @return  bool
 */
if( !function_exists('is_multiples_of') ) {
function is_multiples_of($n, $multiplier) {

  $modulus = ($n + 1) % $multiplier;
  if( $modulus == 0 ) return TRUE;
  return FALSE;


}
}



/**
 * Check if the number given is an odd number. Usually used to check $n value within a foreach loop
 * 
 * @param   int   $n 
 * @param   bool  $start_zero   this function usually used in foreach where items starts from zero rather than one
 */
if( !function_exists('is_list_odd') ) {
function is_list_odd($n, $start_zero = TRUE) {
  if( $start_zero ) 
    $n = $n + 1;

  $modulus = $n % 2;
  if( $modulus == 0 ) return FALSE;
  return TRUE;
}
}


/**
 * Adds a more advanced paging navigation to your WordPress blog
 * 
 * @author    Lester 'GaMerZ' Chan
 * @link      http://lesterchan.net/portfolio/programming/php/
 * @version   2.30
 * 
 * Copyright 2008  Lester Chan  (email : lesterchan@gmail.com)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */
function kantin_pagenavi($before = '', $after = '') {
  global $wpdb, $wp_query;
  
  if ( ! is_single() ) {
    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    
    $pagenavi_options = array();
    $pagenavi_options['pages_text']     = __('Page %CURRENT_PAGE% of %TOTAL_PAGES%','wp-pagenavi');
    $pagenavi_options['current_text']   = '%PAGE_NUMBER%';
    $pagenavi_options['page_text']      = '%PAGE_NUMBER%';
    $pagenavi_options['first_text']     = __('&laquo; First','wp-pagenavi');
    $pagenavi_options['last_text']      = __('Last &raquo;','wp-pagenavi');
    $pagenavi_options['next_text']      = __('&raquo;','wp-pagenavi');
    $pagenavi_options['prev_text']      = __('&laquo;','wp-pagenavi');
    $pagenavi_options['dotright_text']  = __('...','wp-pagenavi');
    $pagenavi_options['dotleft_text']   = __('...','wp-pagenavi');
    $pagenavi_options['style']          = 1;
    $pagenavi_options['num_pages']      = 5;
    $pagenavi_options['always_show']    = 0;
    
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;
    /*
    $numposts = 0;
    if(strpos(get_query_var('tag'), " ")) {
        preg_match('#^(.*)\sLIMIT#siU', $request, $matches);
        $fromwhere = $matches[1];      
        $results = $wpdb->get_results($fromwhere);
        $numposts = count($results);
    } else {
      preg_match('#FROM\s*+(.+?)\s+(GROUP BY|ORDER BY)#si', $request, $matches);
      $fromwhere = $matches[1];
      $numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
    }
    $max_page = ceil($numposts/$posts_per_page);
    */
    if(empty($paged) || $paged == 0) {
      $paged = 1;
    }
    $pages_to_show = intval($pagenavi_options['num_pages']);
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
      $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
      $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
      $start_page = $max_page - $pages_to_show_minus_1;
      $end_page = $max_page;
    }
    if($start_page <= 0) {
      $start_page = 1;
    }
    if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
      $pages_text = str_replace("%CURRENT_PAGE%", $paged, $pagenavi_options['pages_text']);
      $pages_text = str_replace("%TOTAL_PAGES%", $max_page, $pages_text);
      echo $before.'<div class="pagination-centered">'."\n";
      switch(intval($pagenavi_options['style'])) {
        case 1:
          echo '<ul class="pagination">';
          
          if(!empty($pages_text)) {
            //echo '<span class="pages">'.$pages_text.'</span>';
          }          
          if ($start_page >= 2 && $pages_to_show < $max_page) {
            $first_page_text = str_replace("%TOTAL_PAGES%", $max_page, $pagenavi_options['first_text']);
            echo '<li><a href="'.esc_url(get_pagenum_link()).'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
            if(!empty($pagenavi_options['dotleft_text'])) {
              echo '<li class="extend disabled"><a>'.$pagenavi_options['dotleft_text'].'</a></li>';
            }
          }
          echo '<li>';
          previous_posts_link($pagenavi_options['prev_text']);
          echo '</li>';
          for($i = $start_page; $i  <= $end_page; $i++) {            
            if( $i == $paged ) {
              $current_page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['current_text']);
              echo '<li class="current disabled"><a>'.$current_page_text.'</a></li>';
            } else {
              $page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['page_text']);
              echo '<li><a href="'.esc_url(get_pagenum_link($i)).'" title="'.$page_text.'">'.$page_text.'</a></li>';
            }
          }
          echo '<li>';
          next_posts_link($pagenavi_options['next_text'], $max_page);
          echo '</li>';
          if ($end_page < $max_page) {
            if(!empty($pagenavi_options['dotright_text'])) {
              echo '<li class="extend disabled"><a>'.$pagenavi_options['dotright_text'].'</a></li>';
            }
            $last_page_text = str_replace("%TOTAL_PAGES%", $max_page, $pagenavi_options['last_text']);
            echo '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
          }
          
          echo '</ul>';
          break;
        case 2;
          echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">'."\n";
          echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";
          for($i = 1; $i  <= $max_page; $i++) {
            $page_num = $i;
            if($page_num == 1) {
              $page_num = 0;
            }
            if($i == $paged) {
              $current_page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['current_text']);
              echo '<option value="'.esc_url(get_pagenum_link($page_num)).'" selected="selected" class="current">'.$current_page_text."</option>\n";
            } else {
              $page_text = str_replace("%PAGE_NUMBER%", $i, $pagenavi_options['page_text']);
              echo '<option value="'.esc_url(get_pagenum_link($page_num)).'">'.$page_text."</option>\n";
            }
          }
          echo "</select>\n";
          echo "</form>\n";
          break;
      }
      echo '</div>'.$after."\n";
    }
  }
}


if( ! function_exists('show_field') ) {
function show_field( $array, $key, $no_value_sign='') {
  if( isset($array[$key]) ) {
    
    if( empty( $array[$key] ) && !empty( $no_value_sign ) ) {
      echo $no_value_sign;
    
    } else {
      echo trim($array[$key]);
    }
  
  } else {
    echo '';
    
  }
}
}


if( ! function_exists('form_is_selected') ) {
function form_is_selected( $checked_value, $matched_value ) {
  if( $checked_value == $matched_value )
    echo 'selected="selected"';
}
}


if( ! function_exists('form_is_checked') ) {
function form_is_checked( $checked_value, $matched_value ) {
  if( $checked_value == $matched_value )
    echo 'checked="checked"';
}
}


/**
 * 'var_dump' a variable with tree structure, far better than var_dump
 *
 * @link http://www.php.net/manual/en/function.var-dump.php#80288
 * @param mixed $var
 * @param string $var_name
 * @param string $indent
 * @param string $reference
 */
if( ! function_exists('tree_dump') ) {
function tree_dump(&$var, $var_name = NULL, $indent = NULL, $reference = NULL)  {

    $tree_dump_indent = "<span style='color:#eeeeee;'>|</span> &nbsp;&nbsp; ";
    $reference = $reference.$var_name;
    $keyvar = 'the_tree_dump_recursion_protection_scheme'; $keyname = 'referenced_object_name';

    if (is_array($var) && isset($var[$keyvar]))
    {
        $real_var = &$var[$keyvar];
        $real_name = &$var[$keyname];
        $type = ucfirst(gettype($real_var));
        echo "$indent$var_name <span style='color:#a2a2a2'>$type</span> = <span style='color:#e87800;'>&amp;$real_name</span><br>";
    }
    else
    {
        $var = array($keyvar => $var, $keyname => $reference);
        $avar = &$var[$keyvar];

        $type = ucfirst(gettype($avar));
        if($type == "String") $type_color = "<span style='color:green'>";
        elseif($type == "Integer") $type_color = "<span style='color:red'>";
        elseif($type == "Double"){ $type_color = "<span style='color:#0099c5'>"; $type = "Float"; }
        elseif($type == "Boolean") $type_color = "<span style='color:#92008d'>";
        elseif($type == "NULL") $type_color = "<span style='color:black'>";

        if(is_array($avar))
        {
            $count = count($avar);
            echo "$indent" . ($var_name ? "$var_name => ":"") . "<span style='color:#a2a2a2'>$type ($count)</span><br>$indent(<br>";
            $keys = array_keys($avar);
            foreach($keys as $name)
            {
                $value = &$avar[$name];
                tree_dump($value, "['$name']", $indent.$tree_dump_indent, $reference);
            }
            echo "$indent)<br>";
        }
        elseif(is_object($avar))
        {
            echo "$indent$var_name <span style='color:#a2a2a2'>$type</span><br>$indent(<br>";
            foreach($avar as $name=>$value) tree_dump($value, "$name", $indent.$tree_dump_indent, $reference);
            echo "$indent)<br>";
        }
        elseif(is_int($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
        elseif(is_string($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color\"$avar\"</span><br>";
        elseif(is_float($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color$avar</span><br>";
        elseif(is_bool($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $type_color".($avar == 1 ? "TRUE":"FALSE")."</span><br>";
        elseif(is_null($avar)) echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> {$type_color}NULL</span><br>";
        else echo "$indent$var_name = <span style='color:#a2a2a2'>$type(".strlen($avar).")</span> $avar<br>";

        $var = $var[$keyvar];
    }
}
}
