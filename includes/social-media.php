<?php


/*=== SOCIAL MEDIA SHARER URL MASKER ===*/

add_action('template_redirect', 'kantin_socmed_redirect');
function kantin_socmed_redirect() {

  if( isset($_GET['kantin_share']) ) :

    // build endpoint URL for social media sharer
    $endpoint_fn = "kantin_{$_GET['kantin_share']}_share_endpoint";
    $endpoint = $endpoint_fn();
    header("Location: {$endpoint}");
    die();

  endif;

}



/** 
 * Build internal sharer URL
 * 
 * @param   string  $socmed 
 * @return  string  
 */
function kantin_socmed_share_link( $socmed ) {
  return get_permalink( get_the_ID() ) . '?kantin_share=' . $socmed;
}



/** 
 * Build endpoint URL for Twitter sharer
 * 
 * @param   array   $args
 * @return  string  $twitter_link
 */
function kantin_twitter_share_endpoint( $args=array() ) {

  $defaults = array(
    'title' => get_the_title(),
    'url'   => get_the_permalink(),
    );
  $init = array_merge( $defaults, $args );
  
  $twitter_link  = 'https://twitter.com/intent/tweet?'; 
  $twitter_link .= 'text=' . urlencode( $init['title'] ); 
  $twitter_link .= '&url=' . urlencode( $init['url'] ); 
  $twitter_link .= '&related=';

  return $twitter_link;

}



/** 
 * Build endpoint URL for Facebook sharer
 * 
 * @param   array   $args
 * @return  string  $facebook_link
 */
function kantin_facebook_share_endpoint( $args=array() ) {

  $defaults = array(
    'url'   => get_the_permalink(),
    );
  $init = array_merge( $defaults, $args );

  $facebook_link  = 'https://www.facebook.com/sharer/sharer.php?'; 
  $facebook_link .= 'u=' . urlencode( $init['url'] );

  return $facebook_link;

}



/** 
 * Build endpoint URL for Pinterest sharer
 * 
 * @param   array   $args
 * @return  string  $pinterest_link
 */
function kantin_pinterest_share_endpoint( $args=array() ) {

  $defaults = array(
    'title' => get_the_title(),
    'url'   => get_the_permalink(),
    );
  $init = array_merge( $defaults, $args );

  $pinterest_link  = 'http://www.pinterest.com/pin/create/button/'; 
  $pinterest_link .= '?description=' . urlencode( $init['title'] );
  $pinterest_link .= '&url=' . urlencode( $init['url'] );

  return $pinterest_link;

}



/** 
 * Build endpoint URL for Google+ sharer
 * 
 * @param   array   $args
 * @return  string  $googleplus_link
 */
function kantin_googleplus_share_endpoint( $args=array() ) {

  $defaults = array(
    'title' => get_the_title(),
    'url'   => get_the_permalink(),
    );
  $init = array_merge( $defaults, $args );

  $googleplus_link  = 'https://plus.google.com/share?'; 
  $googleplus_link .= 'url=' . urlencode( $init['url'] );
  $googleplus_link .= '&t=' . urlencode( $init['title'] );

  return $googleplus_link;

}



/** 
 * Build endpoint URL for LinkedIn sharer
 * 
 * @param   array   $args
 * @return  string  $linkedin_link
 */
function kantin_linkedin_share_endpoint( $args=array() ) {

  $defaults = array(
    'title' => get_the_title(),
    'url'   => get_the_permalink(),
    'desc'  => get_the_excerpt(),
    'blog'  => get_bloginfo('name'),
    );
  $init = array_merge( $defaults, $args );

  $linkedin_link  = 'http://www.linkedin.com/shareArticle?mini=true'; 
  $linkedin_link .= '&url=' . urlencode( $init['url'] );
  $linkedin_link .= '&title=' . urlencode( $init['title'] );
  $linkedin_link .= '&summary=' . urlencode( $init['desc'] );
  $linkedin_link .= '&source=' . urlencode( $init['blog'] );

  return $linkedin_link;

}



/** 
 * Build endpoint URL for StumbleUpon sharer
 * 
 * @param   array   $args
 * @return  string  $su_link
 */
function kantin_stumbleupon_share_endpoint( $args=array() ) {

  $defaults = array(
    'title' => get_the_title(),
    'url'   => get_the_permalink(),
    );
  $init = array_merge( $defaults, $args );

  $su_link  = 'http://www.stumbleupon.com/submit?url=';
  $su_link .= urlencode( $init['url'] ) . '&title=' . urlencode( $init['title'] );

  return $su_link;

}



/** 
 * Build endpoint URL for Reddit sharer
 * 
 * @param   array   $args
 * @return  string  $reddit_link
 */
function kantin_reddit_share_endpoint( $args=array() ) {

  $defaults = array(
    'title' => get_the_title(),
    'url'   => get_the_permalink(),
    );
  $init = array_merge( $defaults, $args );

  $reddit_link  = 'http://www.reddit.com/submit?';
  $reddit_link .= 'url=' . urlencode( $init['url'] );
  $reddit_link .= '&title=' . urlencode( $init['title'] );

  return $reddit_link;

}



/** 
 * Display social sharing buttons and its social counts
 * 
 * @param   array   $args
 */
function kantin_display_social_share( $args=array() ) {

  $defaults = array(
    'wrapper_class' => '',
    );
  $init = array_merge($defaults, $args); ?>

  <div class="social-share-wrap <?php echo $init['wrapper_class'] ?>">

    <a class="sm-link facebook" title="Share <?php the_title_attribute() ?> on your Facebook" href="<?php echo kantin_socmed_share_link('facebook') ?>" target="_blank">
      <i class="fa fa-facebook"></i> 
    </a> 

    <a class="sm-link twitter" title="Share <?php the_title_attribute() ?> on your Twitter" href="<?php echo kantin_socmed_share_link('twitter') ?>" target="_blank">
      <i class="fa fa-twitter"></i>
    </a> 

    <a class="sm-link googleplus" title="Share <?php the_title_attribute() ?> on your Google+" href="<?php echo kantin_socmed_share_link('googleplus') ?>" target="_blank">
      <i class="fa fa-google-plus"></i> 
    </a>

    <a class="sm-link linkedin" title="Share <?php the_title_attribute() ?> on your LinkedIn profile" href="<?php echo kantin_socmed_share_link('linkedin') ?>" target="_blank">
      <i class="fa fa-linkedin"></i> 
    </a> 

    <?php /* <a class="sm-link pinterest" title="Share <?php the_title_attribute() ?> on your Pinterest" href="<?php echo kantin_socmed_share_link('pinterest') ?>" target="_blank">
      <i class="fa fa-pinterest"></i> 
    </a> 

    <a class="sm-link stumbleupon" title="Share <?php the_title_attribute() ?> on your Stumbleupon profile" href="<?php echo kantin_socmed_share_link('stumbleupon') ?>" target="_blank">
      <i class="fa fa-stumbleupon"></i> 
    </a> 

    <a class="sm-link reddit" title="Share <?php the_title_attribute() ?> on your Reddit profile" href="<?php echo kantin_socmed_share_link('reddit') ?>" target="_blank">
      <i class="fa fa-reddit"></i> 
    </a> */ ?>
  </div>

<?php }
