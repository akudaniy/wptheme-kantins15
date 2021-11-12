<?php

/**
 * Plugin Name: Daniy Image Manager
 * Plugin URI:  http://www.murdanieko.com/
 * Description: Save more MySQL queries when displaying post galleries of post thumbnails, by saving the image attachments data in mostly empty table <code>post_content_filtered</code> field in <code>wp_posts</code> table
 * Version:     1.7.6
 * License:     GPLv3
 * Author:      Murdani Eko
 * Author URI:  http://www.murdanieko.com/
 * Last Change: 6:10 pm  13 Februari 2015
 */

/**
 * @package Daniy Image Manager
 * @author  Murdani Eko
 */

/**
 * Employs the 'mostly-empty' wp_posts  field to save attached image data
 * to reduce MySQL queries when certain attachments for a post is being requested
 *
 * For example: when a post have 10 attachments, using the old code the_image()
 * will run more than 10 additional queries to the post which generated from
 * - get_posts()
 * - get_post_meta()
 * 
 * Updates:
 * - Bugfix format_image_data() method using array_values() to reset array key numbering (1.7.6)
 * - Bugfix on imwp_get_thumbnail() fallback function on return_data_only param (1.7.5)
 * - Dynamic THEME_IMAGE_FALLBACK (1.7.4)
 * - Added enable_cache arguments whether to cache image data in wp_posts.post_content_filtered (1.7.3)
 * - Simplify function arguments for imwp_get_thumbnail by merging timthumb args into options (1.7.2)
 * - Remove global $post, instead localize $post object into $this->post (1.7.2)
 * - Added imwp_get_gallery() helper to retrieve $images array (1.7)
 * - Added capabilities for passing timthumb arguments
 * - Added randomize_order arguments
 * - Added alt tags for featured image generated from the_post_thumbnail()
 * - Added options argument for imwp_get_thumbnail (1.7.1)
 */


// Initial settings, defining constants 
define('DNY_FORCE_FLUSH', TRUE);

$dirname_native = str_replace('\\', '/', dirname( __FILE__ ));      // Windows-based path workaround
$dirname_wp     = str_replace('\\', '/', get_template_directory()); // Windows-based path workaround
$imwp_relative_path = get_template_directory_uri() . str_replace($dirname_wp, '', $dirname_native);

define('THEME_IMAGE_FALLBACK', $imwp_relative_path . '/image_default_fallback.jpg');

class DNY_Image_Manager {

  private $post;      //
  private $size;      //
  private $images;    //
  private $htmls;     // array of ready to output values like <p><img src="" class="" title="" /></p>
  private $html;      // final form of ready to output images
  private $init;      // initialization values

  /**
   * Class constructor. Setup default initialization values
   * 
   * @param   array   $init
   */
  function __construct( $init = array() ) {
    
    $defaults = array(
        'post'                  => NULL,                    // $post object
        'enable_cache'          => TRUE,                    // enable image data caching in post_content_filtered field
        'images_per_row'        => NULL,                    // when in thumbnail gallery, how much images do you put in a row?
        'last_row_class'        => NULL,                    // class name to reset the layout, usually reset the right margin
        'insert_image_link'     => TRUE,                    // do each image links to its own attachment page?
        'insert_image_title'    => TRUE,                    // when an image is wrapped within <a> tag, this should be set to FALSE
        'image_link_target'     => 'page',                  // choose `page` or `source`
        'before_wrapper'        => NULL,                    // do you want to add something before the gallery?
        'after_wrapper'         => NULL,                    // do you want to add something after the gallery?
        'image_size'            => 'thumbnail',             // the safest value is 'thumbnail' and 'original'
        'image_id'              => 'attachment-image-',
        'image_class'           => 'attachment-image',
        'image_container_tag'   => NULL,
        'image_container_id'    => NULL,
        'image_container_class' => NULL,
        'image_wrapper_tag'     => 'div',
        'image_wrapper_id'      => 'attachment-container',
        'image_wrapper_class'   => NULL,
        'image_data_attributes' => NULL,    // add the customized data attributes inside <img> tag like data-id="58" which can be used by jQuery/javascript applications
        'link_data_attributes'  => NULL,    // add the customized data attributes inside <a> tag like data-toggle="true" or rel="lightbox" which can be used by jQuery/javascript applications
        'show_caption'          => FALSE,   // 
        'caption_wrapper'       => 'p',             // 
        'caption_class'         => 'item-caption',  // 
        'use_timthumb'          => FALSE,   // 
        'timthumb_url_script'   => '',      // 
        'timthumb_url_params'   => '',      // 
        'randomize_order'       => FALSE,   // get images in random order?
        'max_result_count'      => FALSE,   // limit image results? useful for listing only several images on archive pages/homepage
    );
    $this->init = array_merge( $defaults, $init );
    $this->size = $this->init['image_size'];

    // assign $post object
    if( $this->init['post']==NULL ) {

      global $post;
      $this->post = $post;

    } else {

      $this->post = $this->init['post'];

    }

  }


  /**
   * Check the value of a data placeholder
   * 
   * @param string  $var
   */
  function debug( $var ) {
    if( function_exists('tree_dump') ) 
      tree_dump( $this->$var );
    
    else 
      var_dump( $this->$var );
  }
  

  /**
   * Fill up the $images property either from wp_posts.emptytable or postmeta
   *
   * Do the procedural task. If the data is already in wp_posts.emptytable,
   * and is_unserializeable
   *
   * @return array
   */
  function populate_images() {

    // get the data from wp_posts.emptytable
    $images = $this->get_data($this->post->ID);

    // does the wp_posts.emptytable data exists?
    if( $images ) { 

      // yes it exists! format first then return it immediately
      $tmp_images = $this->format_image_data($images); 
      
      return $this->images = $tmp_images; 

    } else { 

      // nope, there's no data in it or it's not unserializeable. get from postmeta first
      $images_postmeta = $this->get_image_postmeta($this->post->ID);

      // ask again.. does this post has any image attachments?
      // if not, return to FALSE
      if( !$images_postmeta ) return FALSE;

      // save the data to wp_posts.emptytable if enable_cache is allowed
      if( $this->init['enable_cache'] == TRUE ) 
        $this->save_data($images_postmeta); 

      // format first then return it immediately
      $tmp_images = $this->format_image_data($images_postmeta); 
      
      return $this->images = $tmp_images;

    }
  }


  /**
   * Check the data in target wp_posts field
   *
   * If data exists, return the unserialized data, else return FALSE flag
   *
   * @global object $post
   * @return mixed
   */
  function get_data() {

    // if data is not empty or FALSE, try to unserialize
    if( $this->post->post_content_filtered ):
      $tmp = @unserialize($this->post->post_content_filtered);

      // yes, it's unserializeable, return array immediately
      if( $tmp ) return $tmp;
    endif;

    // nope, it's a common string, not a serialized array, return FALSE flag
    return FALSE;
  }
  
  
  /**
   * Save the returned postmeta data into wp_posts empty table
   * 
   * @global  object  $wpdb
   * @param   array   $array
   * @return  mixed
   */
  function save_data( $array ) {
    global $wpdb;

    // if target field is not empty (maybe it's a valid wp_posts.emptytable value),
    // and you don't want to force replace it with the serialized data
    // stop, and fire up FALSE flag
    if( !empty ($this->post->post_content_filtered) && !DNY_FORCE_FLUSH ) return FALSE;

    // serialize data so we can save it into database
    $save_data = serialize( $array );

    // run the wp update
    $wpdb->update(
            $wpdb->prefix . 'posts',
            array(
                'post_content_filtered' => $save_data,
            ),
            array( 'ID' => $this->post->ID )
            );

    return;

  }


  /**
   * Format the given raw data to a ready to use array
   *
   * It adds the appropriate baseurl (http://www.example.com/wp-content/uploads)
   * and the basedir (/home/myaccount/public_html/wp-content/uploads) to each
   * of the file values. Also fixes the different directory separator between
   * UNIX and WINDOWS environment
   *
   * @param   array $images
   * @return  array
   */
  function format_image_data( $images ) {

    $updirs = wp_upload_dir();

    // list of available image sizes in WordPress
    // array('thumbnail', 'medium', 'large', 'original');
    $maybe_sizes   = get_intermediate_image_sizes();
    $maybe_sizes[] = 'original';

    // set FALSE if images input is empty
    if( !$images ) return FALSE;

    foreach( $images as $n => $img ):
    foreach($maybe_sizes as $size_name):
      if( isset( $img['sizes'][$size_name] ) ):

        $file = '/' . $img['sizes'][$size_name]['file'];

        $images[$n]['sizes'][$size_name]['filepath'] = $this->fix_image_path( trim($updirs['basedir'], '/') . $file );
        $images[$n]['sizes'][$size_name]['fileurl']  = $this->fix_image_url( trim($updirs['baseurl'], '/') . $file );

      endif;
    endforeach;
    endforeach;

    $return_images = array();

    // randomize result if requested
    if( $this->init['randomize_order'] ) {

      $random_keys = range(0, count($images) - 1);
      shuffle($random_keys);

      foreach ($random_keys as $random_key) {
        $return_images[] = $images[$random_key];
      }
    }

    else {

      $return_images = $images;

    } 

    // limit output count if requested
    if( $this->init['max_result_count'] !== FALSE ) {
      foreach ($return_images as $imgnum => $return_image) {
        if( $imgnum >= $this->init['max_result_count'] ) {
          unset($return_images[$imgnum]);
        }
      }
    }

    // filter with array_values() to reset array numbering
    return array_values( $return_images );

  }


  /**
   * Get all children from a post and formats its title and path data
   * with all of its available sizes
   *
   * @param   int   $post_id
   * @return  array
   */
  function get_image_postmeta( $post_id ) {

    $im_metadata = NULL;

    // setup the attachment query arguments
    $att_array = array(
      'post_parent'     => $post_id,
      'post_type'       => 'attachment',
      'numberposts'     => -1,
      'post_mime_type'  => 'image',
      'order_by'        => 'menu_order'
    );
    $attachments = get_children($att_array);

    if( $attachments ) {

      // we need another counter because $num is undependable
      $i = 0;
      foreach($attachments as $att) {

          $updirs = wp_upload_dir();
          $file = get_post_meta( $att->ID, '_wp_attachment_metadata', TRUE);
          $filepath = $updirs['basedir'] . DIRECTORY_SEPARATOR . $file['file'];

          // does the file REALLY EXISTS?? check first!
          if( file_exists($filepath) ) {

            // setup the main data: ID and title
            $im_metadata[$i] = array(
                'att_ID'    => $att->ID,
                'title'     => $att->post_title,
                'content'   => $att->post_content,
                'link'      => get_attachment_link($att->ID),
                );

            // setup the original image data: path and sizes
            $im_metadata[$i]['sizes']['original'] = array(
                'file'    => $file['file'],
                'width'   => $file['width'],
                'height'  => $file['height'],
                );

            // extract the $subdir value from original size
            $basename = basename($file['file']);
            $subdir = str_replace($basename, "", $file['file']);

            // list of available image sizes in WordPress
            $maybe_sizes = get_intermediate_image_sizes();

            // setup the additional other image data if exists
            foreach($maybe_sizes as $size_name):
              if( isset($file['sizes'][$size_name]) ):
                $im_metadata[$i]['sizes'][$size_name]['file']   = trim( $subdir ) . $file['sizes'][$size_name]['file'];
                $im_metadata[$i]['sizes'][$size_name]['width']  = $file['sizes'][$size_name]['width'];
                $im_metadata[$i]['sizes'][$size_name]['height'] = $file['sizes'][$size_name]['height'];
              endif;
            endforeach;
          }
          
          // increment our counter by one step
          $i++;

      }

      return $im_metadata;

    }

    return FALSE;

  }


  /**
   * Populate the $htmls property with formatted <img> tags
   *
   * @return <type> 
   */
  function generate_htmls() {

    $html = NULL;
    $images = $this->populate_images(); 

    // only process if $images is not empty or not FALSE
    if( $images ):
    foreach( $images as $n => $img ):

      // is this size exists?
      if( !isset($img['sizes'][$this->size]) ) {

        // this size doesn't exists, put NULL value to htmls array
        $this->htmls[] = NULL;

      } else {

        //
        if( $this->init['images_per_row'] && $this->init['last_row_class'] ) {

          $add_class = ( $this->is_multiples_of($n, $this->init['images_per_row']) ) ? ' ' . $this->init['last_row_class'] : '';
          $image_class = $this->init['image_class'] . $add_class;

        } else {

          $image_class = $this->init['image_class'];

        }
        

        // yep, it exists. let's build the <img> tag
        // use timthumb hardcropping script?
        if( $this->init['use_timthumb'] ) 
          $img_src = $this->init['timthumb_url_script'] . '?src=' . $img['sizes'][$this->size]['fileurl'] . $this->init['timthumb_url_params'];
        else 
          $img_src = $img['sizes'][$this->size]['fileurl'];

        $imginit = array(
            'src'     => $img_src,
            'alt'     => $img['title'],
            'class'   => $image_class . " item-no-{$n}",
            'id'      => $this->init['image_id'] ? $this->init['image_id'] . $img['att_ID'] : '',
            'width'   => $img['sizes'][$this->size]['width'],
            'height'  => $img['sizes'][$this->size]['height'],
        );

        if( $this->init['insert_image_title'] ) $imginit['title'] = $img['title'];
        $element = $this->construct_img_tag( $imginit );


        // where the link should point? to the attachment page or the image source address?
        if($this->init['image_link_target'] == 'page')
          $image_link = $img['link'];

        elseif($this->init['image_link_target'] == 'source')
          $image_link = $img['sizes']['original']['fileurl'];


        // should it links to its own attachment page? wrap each <img> with <a> tag
        if( $this->init['insert_image_link'] ) {
          $link_format = '<a href="%s" %s>%s</a>';
          $element = sprintf(
                  $link_format,
                  $image_link,
                  $this->init['link_data_attributes'],
                  $element
                  );
        }


        // show the image description as caption
        if( $this->init['show_caption'] ) {
          if( $img['content'] ) {
            $element .= '<' . $this->init['caption_wrapper'] . ' class="'. $this->init['caption_class'] .'">' . $img['content'] . '</'. $this->init['caption_wrapper'] .'>';
          }
        }

        // does it has the image_container tag? wrap each with its container tag
        if( $this->init['image_container_tag'] ) {
          $cont_tag    = $this->init['image_container_tag'];
          $cont_class  = ( $this->init['image_container_class'] ) ? ' class="' . $this->init['image_container_class'] . '"' : '';
          $cont_id     = ( $this->init['image_container_id'] ) ? ' id="' . $this->init['image_container_id'] . '"' : '';
          $cont_format = '<' . $cont_tag . $cont_class . $cont_id . '>%s</' . $cont_tag . '>';
          $element     = sprintf($cont_format, $element);

        }

        $this->htmls[] = $element;
      }

    endforeach;
    endif;

    return $this->htmls;
  }


  /**
   * Finalize the $html property by glueing the $htmls array into the $html property
   *
   * Add wrapper tag if any
   * Add before_wrapper element if any
   * Add after_wrapper element if any
   *
   * @return string
   */
  function finalize_html() {

    // is $htmls an array? or is it empty? fire up FALSE flag immediately
    if( !is_array($this->htmls) || empty($this->htmls) ) return FALSE;

    // glued the $htmls array into a string
    $html = implode(PHP_EOL, $this->htmls);

    // does it has the image_wrapper tag? wrap this gallery with a wrapper tag
    if( $this->init['image_wrapper_tag'] ) {
      $wrap_tag    = $this->init['image_wrapper_tag'];
      $wrap_class  = ( $this->init['image_wrapper_class'] ) ? ' class="' . $this->init['image_wrapper_class'] . '"' : '';
      $wrap_id     = ( $this->init['image_wrapper_id'] ) ? ' id="' . $this->init['image_wrapper_id'] . '"' : '';
      $wrap_format = '<' . $wrap_tag . $wrap_class . $wrap_id . '>%s</' . $wrap_tag . '>';
      $html        = sprintf($wrap_format, $html);
    }

    // does it has a before_wrapper element? get it prefixed
    if( $this->init['before_wrapper'] ) $html = $this->init['before_wrapper'] . PHP_EOL . $html;

    // does it has an after_wrapper element? get it suffixed
    if( $this->init['after_wrapper'] ) $html = $html . PHP_EOL . $this->init['after_wrapper'];

    // concatenation finished. save it into $html property
    $this->html = $html;
  }


  /* ==========================================================================
     COMMON HELPERS
     ========================================================================== */
  
  /**
   * Output the final html onto the screen
   */
  function output_prop( $prop ) {
    echo $this->$prop;
  }


  /**
   * Return the final html to save into a string
   *
   * @return string
   */
  function return_prop( $prop ) {
    return $this->$prop;
  }


  function construct_img_tag( $array ) {

    // set a data placeholder
    $attributes = array();

    // iterate item's input
    foreach ($array as $key => $val):
      $attributes[] = sprintf('%s="%s"', $key, $val);
    endforeach;

    // unify all values to string
    $attribute = implode(" ", $attributes);

    if( $this->init['image_data_attributes'] )
      $attribute .= $this->init['image_data_attributes'];

    // return by prepend and append tag element
    return '<img ' . $attribute . ' />';
  }

  
  /**
   * Check if a wp_posts.emptytable has no value
   *
   * @return bool
   */
  function is_target_empty() {

    if( empty($this->post->post_content_filtered) ) 
      return TRUE;
    
    return FALSE;

  }


  /**
   * Change the backslash to forward slash
   *
   * @param string $image_url
   * @return string
   */
  function fix_image_url( $image_url ) {
    return str_replace( DIRECTORY_SEPARATOR, "/", $image_url );
  }


  /**
   * Change the forward slash to backslash
   *
   * @param string $image_url
   * @return string
   */
  function fix_image_path( $image_path ) {
    return str_replace( "/", DIRECTORY_SEPARATOR, $image_path );
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
   *
   * @param int $n
   * @param int $multiplier
   * @return bool
   */
  function is_multiples_of($n, $multiplier) {

    $modulus = ($n + 1) % $multiplier;
    if( $modulus == 0 ) return TRUE;
    return FALSE;

  }

}
// end of class DNY_Image_Manager



/**
 * Function to be hooked after plugin deactivated
 * http://wordpress.stackexchange.com/questions/25910/uninstall-activate-deactivate-a-plugin-typical-features-how-to/25979#25979
 */
function imwp_deactivate() {
  global $wpdb;
  
  if ( ! current_user_can( 'activate_plugins' ) )
      return;
  $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
  check_admin_referer( "deactivate-plugin_{$plugin}" );
  
  $sql = "UPDATE {$wpdb->prefix}posts SET post_content_filtered = ''";
  $wpdb->query($sql);
  
  return;

}
//register_deactivation_hook( __FILE__, 'imwp_deactivate' );


/* ==========================================================================
   FRONT END HELPERS
   WordPress template files should use these functions
   rather than instantiating above class directly
   ========================================================================== */


/**
 * Return the image gallery for a post
 *
 * @param   $array  $init
 */

function imwp_get_gallery( $init = array() ) {

  $img = new DNY_Image_Manager( $init );
  $img->generate_htmls();
  $img->finalize_html();
  $return_images = $img->return_prop('images');
  unset( $img );

  return $return_images;
  
}


/**
 * Display the image gallery for a post
 *
 * @param   $array  $init
 */

function imwp_view_gallery( $init = array() ) {

  $img = new DNY_Image_Manager( $init );
  $img->generate_htmls();
  $img->finalize_html();
  $img->output_prop('html');
  unset($img);
  
}


function imwp_get_thumbnail( $size='thumbnail', $image_class = NULL, $options=array(), $deprecated_arguments=array() ) {
  
  global $wpdb;


  // compatibility logic for previous version
  $options = array_merge($options, $deprecated_arguments);

  $timb = array(
    'script_file' => isset( $options['script_file'] ) ? $options['script_file'] : '',
    'params'      => isset( $options['params'] ) ? $options['params'] : '',
    );

  $defaults = array(
    'image_size'          => $size,
    'insert_image_link'   => FALSE,
    'insert_image_title'  => FALSE,
    'image_class'         => $image_class,
    'use_timthumb'        => strlen($timb['script_file']) > 1 ? TRUE : FALSE,
    'timthumb_url_script' => $timb['script_file'],
    'timthumb_url_params' => $timb['params'],
    'return_data_only'    => FALSE,
    );
  $init = array_merge($defaults, $options); 


  /* ===================================  
   * Does this post have post thumbnail?
   * =================================== */
  $post_ID = get_the_ID();
  if( has_post_thumbnail( $post_ID ) ) { 
    $post_thumbnail_id = get_post_thumbnail_id( $post_ID );
    $image_attributes  = wp_get_attachment_image_src( $post_thumbnail_id, $size );

    $img_tag_id     = 'attachment-image-' . $post_thumbnail_id;
    $img_tag_class  = $image_class;

    // get post title to be used as image alt
    $post_title = $wpdb->get_var("SELECT post_title FROM {$wpdb->prefix}posts WHERE ID = '{$post_ID}'");

    if( $init['use_timthumb'] ) 
      $img_tag_src = $init['timthumb_url_script'] . '?src=' . $image_attributes[0] . $init['timthumb_url_params'];
      
    else
      $img_tag_src = $image_attributes[0];


    // return only data array if set to TRUE
    if( $init['return_data_only'] ) {
      return array(
        'img_src'   => $img_tag_src,
        'img_alt'   => $post_title,
        'img_id'    => $img_tag_id,
        'img_class' => $img_tag_class,
        'img_w'     => $image_attributes[1],
        'img_h'     => $image_attributes[2],
        );
    }

    $img_tag = '<img alt="'. $post_title .'" id="'. $img_tag_id .'" class="'. $img_tag_class .'" src="'. $img_tag_src .'" />';

    return $img_tag;
  }


  /* ============================================  
   * this post DOESN'T have post thumbnail, 
   * proceed with DNY_Image_Manager instantiation
   * ============================================ */
  $img = new DNY_Image_Manager( $init );
  $img->generate_htmls();
  $htmls  = $img->return_prop('htmls');
  $images = $img->return_prop('images');

  if( isset($htmls[0]) ) {
    
    // return only data array if set to TRUE
    if( $init['return_data_only'] ) { 
      return array(
        'img_src'   => $images[0]['sizes'][$init['image_size']]['fileurl'],
        'img_alt'   => $images[0]['title'],
        'img_id'    => 'attachment-image-' . $images[0]['att_ID'],
        'img_class' => $image_class,
        'img_w'     => $images[0]['sizes'][$init['image_size']]['width'],
        'img_h'     => $images[0]['sizes'][$init['image_size']]['height'],
        );
    }
    
    else {
      
      return $htmls[0];
      
    }

  } else {
    $out = imwp_get_image_fallback( 
      array(
        'class'               => $image_class,
        'use_timthumb'        => $init['use_timthumb'],
        'timthumb_url_script' => $init['script_file'],
        'timthumb_url_params' => $init['params'],
        'return_data_only'    => $init['return_data_only'],
        ) 
      );
    
    return $out;
  }

}



function imwp_view_thumbnail( $size='thumbnail', $image_class = NULL, $options=array(), $deprecated_arguments=array() ) {
  echo imwp_get_thumbnail( $size, $image_class, $options, $deprecated_arguments );
}



function imwp_get_image_fallback( $init = array() ) {

  $ims = getimagesize( THEME_IMAGE_FALLBACK );
  $defaults = array(
      'class'   => 'attachment-thumbnail',
      'alt'     => 'Thumbnail preview',
      'title'   => NULL,
      'width'   => $ims[0],
      'height'  => $ims[1],
      'use_timthumb'          => FALSE,   // 
      'timthumb_url_script'   => '',      // 
      'timthumb_url_params'   => '',      // 
      'return_data_only'      => FALSE,   // whether to return data array only, not in <img> tag format
  );
  $init = array_merge($defaults, $init);


  // use timthumb?
  if( $init['use_timthumb'] ) 
    $img_src = $init['timthumb_url_script'] . '?src=' . THEME_IMAGE_FALLBACK . $init['timthumb_url_params'];
  
  else 
    $img_src = THEME_IMAGE_FALLBACK;
  
  
  // return only data array if set to TRUE
  if( $init['return_data_only'] ) {
    return array(
      'img_src'   => $img_src,
      'img_alt'   => $init['alt'],
      'img_id'    => 'attachment-image-default',
      'img_class' => $init['class'],
      'img_w'     => $ims[0],
      'img_h'     => $ims[1],
      );
  }


  return sprintf( '<img src="%s" width="%s" height="%s" class="%s" alt="%s" title="%s" />',
                  $img_src,
                  $ims[0],
                  $ims[1],
                  $init['class'],
                  $init['alt'],
                  $init['title']
                  );
  
}


/**
 * Force to empty wp_posts.emptytable field everytime we update a post
 *
 * @global object $wpdb
 * @global object $post
 * @return void
 */
add_action('save_post', 'force_empty_field');
function force_empty_field() {
  global $wpdb, $post;
  
  if( !$post ) 
    return;

  if( !defined('DNY_FORCE_FLUSH') && !DNY_FORCE_FLUSH ) 
    return FALSE;

  // flush the wp_posts.emptytable
  $wpdb->update(
          $wpdb->prefix . 'posts',
          array(
              'post_content_filtered' => "",
          ),
          array( 'ID' => $post->ID )
          );

  return;

}



/**
 * Reset image caches by emptying wp_posts.emptytable field
 *
 * @global object $wpdb
 * @return void
 */
add_action('init', 'imwp_reset');
function imwp_reset() {
  global $wpdb;

  if( isset($_GET['imwp_reset_images']) || isset($_GET['imwp_reset']) ):

    // flush the wp_posts.emptytable
    $wpdb->query( "UPDATE {$wpdb->prefix}posts SET post_content_filtered = ''" );
    echo 'all image caches flushed'; die();
    return;

  endif;

}
