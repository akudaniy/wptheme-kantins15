<?php
/**
 * Load Jombor Options
 */

/**
 * Default option values for Jombor
 */
function uung_options_items() {
  $items = array (

    'before_content_template' => '',
    'after_content_template'  => '',
    'before_att_template'     => '',
    'after_att_template'      => '',

    'is_demo'               => 0,
    'adsense_adslot'        => '',
    'adsense_pubid'         => '',

    'custom_css'            => '',
    'wp_footer_script'      => '',
    
    'att_title_separator'   => ', ',

    'atts_title'            => '',
    'atts_other_title'      => '',
    'related_single_title'  => '',
    'related_tag_title'     => '',
    'random_posts_title'    => '',

    'googlefonts_url'       => '//fonts.googleapis.com/css?family=Roboto+Slab:400,300|Open+Sans:300italic,400italic,600italic,300,400,600',

    'adsense_728x90'        => '',
    'adsense_336x280'       => '',
    'adsense_300x250'       => '',
    'adsense_728x15_link'   => '',

    'twitter_username'      => '',
    'facebook_username'     => '',
    'pinterest_username'    => '',
    'youtube_username'      => '',
    'gplus_ID'              => '',
    'fb_app_ID'             => '',
    'fb_admins_ID'          => '',
    'addthis_username'      => '',

    'enable_fb_comments'    => '',
    'enable_share_buttons'  => '',
    'enable_breadcrumbs'    => '',
    'enable_related_posts'  => '',
    'custom_favicon'        => '',
    'related_posts_type'    => 'random',
    'related_posts_amount'  => '5',
    'enable_single_gallery' => '',
    'view_default_post_thumbnail' => '',

    'adpos_home_header'           => '',
    'adpos_home_between_posts'    => '',
    'adpos_single_header'         => '',
    'adpos_single_unitlink'       => '',
    'adpos_single_post_wrap'      => '',
    'adpos_single_after_post'     => '',
    'adpos_image_header'          => '',
    'adpos_image_unitlink'        => '',
    'adpos_image_before_image'    => '',
    'adpos_image_after_image'     => '',
    'adpos_archive_header'        => '',
    'adpos_archive_between_posts' => '',
      
    'adpos_home_after_count'      => 3,
    'adpos_archive_after_count'   => 3,

  );
  return $items;
}


/**
 * Get theme options, if not exists serve the default values
 * 
 * @return type
 */
function uung_options() {

  $theme_opts = get_option('uung_options');
  if( !$theme_opts ) {
    $theme_opts = uung_options_items();
  } else {
    $theme_opts = array_merge(uung_options_items(), $theme_opts);
  }

  return $theme_opts;

}


/**
 * @package Hoomioo
 */

function hoomioo_update_options() {

  if( isset($_POST['save_options']) ) {

    $default_options = hoomioo_options_items();
    $updated_options = array_merge($default_options, $_POST['themeopts']);

    // sanitize input by trimming spaces both on left and right
    foreach( $updated_options as $n => $upopt ): 
      $updated_options[$n] = trim( $upopt );
    endforeach;
    //print_r($updated_options);die();
    update_option('hoomioo_options', $updated_options);

  }

}
add_action('admin_init', 'hoomioo_update_options');



/**
 * HTML display of XmasHomeDecor options
 * @global object $wpdb
 */
function hoomioo_options_fn() {

  global $wpdb, $updirs; 

  $theme_opts = get_option('hoomioo_options');
  if( !$theme_opts ) {
    $theme_opts = hoomioo_options_items();
  } else {
    $theme_opts = array_merge(hoomioo_options_items(), $theme_opts);
  }

  ?>
  <style type="text/css">
    .section-title {border-bottom:1px solid #CCC; padding-bottom:20px;}
    .jquery-ui, .jquery-ui-tabs, .ui-widget, 
    .ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button {font-family:'Open Sans',Helvetica,Arial, sans-serif;}
  </style>

  <div class="wrap">
    <h2><?php _e('Theme Options', WPTHEME_TEXT_DOMAIN) ?></h2>

    <?php if( isset($_POST['save_options']) ): ?>
    <div class="updated fade"> 
    <p><strong>Settings saved.</strong></p></div>
    <?php endif; ?>
    
    <form action="" method="post">
      
    <div id="tabs">
      
    <ul>
      <li><a href="#tabs-1"><?php _e('Layout', WPTHEME_TEXT_DOMAIN) ?></a></li>
      <li><a href="#tabs-2"><?php _e('Auto-Content Template', WPTHEME_TEXT_DOMAIN) ?></a></li>
      <li><a href="#tabs-3"><?php _e('AdSense', WPTHEME_TEXT_DOMAIN) ?></a></li>
      <li><a href="#tabs-4"><?php _e('Titles', WPTHEME_TEXT_DOMAIN) ?></a></li>
    </ul>
      
    <?php require get_template_directory() . '/includes/admin-tabs-1.php'; ?>
    <?php require get_template_directory() . '/includes/admin-tabs-2.php'; ?>
    <?php require get_template_directory() . '/includes/admin-tabs-3.php'; ?>
    <?php require get_template_directory() . '/includes/admin-tabs-4.php'; ?>
        
    </div><!--#tabs-->

    <p class="submit"><input type="submit" value="<?php esc_attr_e( 'Save Changes', WPTHEME_TEXT_DOMAIN ) ?>" class="button button-primary" id="submit" name="save_options"></p>
    </form>
    
  </div><!--.wrap-->

  <?php

}


function hoomioo_do_checkbox($key) {

  $theme_opts = get_option('hoomioo_options');
  if( !$theme_opts ) {
    $theme_opts = hoomioo_options_items();
  } else {
    $theme_opts = array_merge(hoomioo_options_items(), $theme_opts);
  }

  //tree_dump($theme_opts);

  if( isset($theme_opts[$key]) ) {
    if( $theme_opts[$key] == 'on' ) {
      echo 'checked="checked" value="on"';
    }
  }
}



/**
 * Load styles and javascripts
 */
function hoomioo_admin_scripts() {
  wp_register_style( 'hoomioo_ui_css', get_template_directory_uri() . '/lib/css/hoomioo_ui.css', false, '1.0.0' );
  wp_enqueue_style( 'hoomioo_ui_css' );
  wp_enqueue_style( 'thickbox' );
  wp_enqueue_script( 'jquery-ui-tabs' );
  wp_enqueue_script( 'media-upload' );
  wp_enqueue_script( 'thickbox' );
  
  if ( is_admin() ) {
    wp_enqueue_script( 'hoomioo_script',
          get_template_directory_uri() . '/lib/js/tabs.js',
          array('jquery'));
    wp_enqueue_media();
    wp_register_script('hoomioo-upload', get_template_directory_uri() .'/lib/js/favicon-upload-3.5.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('hoomioo-upload');
  
  }

}
add_action('admin_enqueue_scripts', 'hoomioo_admin_scripts');


/**
 * Display admin notifications
 */
function hoomioo_notices() {
  
  $notice = '';
  $message = '';
   
  if( strlen($notice) > 1 )
    printf('<div class="error fade"><p>%s</p></div>', $notice);
    
  if( strlen($message) > 1 )
    printf(__('<div class="updated fade"><p>%sGo to <a href="%s">Options</a> to resolve this matter.</p></div>', WPTHEME_TEXT_DOMAIN), $message, admin_url('admin.php?page=hoomioo-options#resolve-warning'));
  
}
add_action('admin_notices', 'hoomioo_notices');


/**
 * Register theme custom menu in WordPress Administration screen
 *
 * @uses admin_menu hook
 */
function theme_menu () {

  // Add a submenu to the custom top-level menu:
  add_theme_page('Appearance', __('Theme Options', WPTHEME_TEXT_DOMAIN), 'edit_posts', 'hoomioo-options', 'hoomioo_options_fn');

}
add_action( 'admin_menu' ,'theme_menu' );


