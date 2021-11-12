<?php

define('JOGIS_INSTAGRAM_CLIENT_ID', 'a3b2113a88004f64b693c85aa65fcbfb');
define('JOGIS_INSTAGRAM_CLIENT_SECRET', 'cf18df521c434d22a4e4988278ff1616');


/**
 * Get latest photos based on given hashtag
 * 
 * @link    http://stackoverflow.com/questions/18458038/how-to-use-instagram-api-to-fetch-image-with-certain-hashtag
 * @param   string  
 * @return  array/object
 */
function kantin_get_insta_hashtags_items( $hashtag ) {

  $endpoint = 'https://api.instagram.com/v1/tags/%s/media/recent?client_id=%s';
  $rawresp  = wp_remote_get( sprintf($endpoint, urlencode($hashtag), JOGIS_INSTAGRAM_CLIENT_ID) );
  $response = $rawresp['body'];

  $jd = json_decode( $response );

  if( isset($jd->data) )
    return $jd->data;

  return FALSE;

}
