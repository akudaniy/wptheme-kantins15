<?php 
/**
 * Template Name: Homepage
 */

global $updirs;

get_header(); ?>

<section class="content-block">
  <div class="container no-pad-t">
        
    <div class="row">
    
      <div class="col-sm-12 text-center">
        <?php $hs = new WP_Query( array(
          'post_type'   => 'page',
          'post_status' => 'publish',
          'pagename'    => 'slideshow-beranda',
        ) ); 

        if( $hs->have_posts() ) : ?>
        <?php while( $hs->have_posts() ) : $hs->the_post(); 

        // get attached images via imwp
        $gallerys = imwp_get_gallery( array(
          'image_size' => 'original',
          ) ); 

        // start looping if images found
        if( $gallerys ): ?>

        <div id="homepage-carousel" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php for($i=0; $i<count($gallerys); $i++): ?>
            <li data-target="#homepage-carousel" data-slide-to="<?php echo $i; ?>"></li>
            <?php endfor; ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
          <?php foreach( $gallerys as $t => $gallery ): ?>
          <div class="item <?php echo $t==0 ? 'active' : ''; ?>">
          <?php printf( '<img src="%s" alt="%s" title="%s" width="%d" height="%d" />', 
                    $gallery['sizes']['original']['fileurl'], 
                    $gallery['title'], 
                    $gallery['title'], 
                    $gallery['sizes']['original']['width'], 
                    $gallery['sizes']['original']['height'] 
                    ); ?>
          </div><!-- .item-->
          <?php endforeach; ?>
          </div><!-- .carousel-inner-->

          <!-- Controls -->
          <a class="left carousel-control" href="#homepage-carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#homepage-carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div><!-- .carousel slide -->

        <?php endif; ?>

        <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
      </div><!-- /Col -->
    
    </div><!-- .row -->
      
  </div><!-- .container -->
</section>


<section class="content-block">
  <div class="container no-pad-t">

    <h5 class="boxed-title">#kantins15 on instagram</h5>

    <?php $jgs = kantin_get_insta_hashtags_items( 'kantins15' ); ?>

    <?php if( $jgs ): ?>
    <div class="row">
      
      <?php foreach( $jgs as $nt => $jg ): ?>
      <?php if( $nt < 8 ): ?>
      <div class="col-sm-3">
        <a class="vcenter-this" href="<?php echo $jg->link ?>" target="_blank">
        <img src="<?php echo $jg->images->low_resolution->url ?>" class="img-thumbnail mb-30" 
             alt="<?php echo wp_specialchars( $jg->caption->text, 1 )  ?>" title="<?php echo wp_specialchars( $jg->caption->text, 1 )  ?>" />
        </a>
      </div><!-- /Col -->
      <?php endif; ?>
      <?php endforeach; ?>

    </div><!-- /Row -->
    <?php endif; ?>


  </div><!-- .container -->
</section><!-- .content-block -->


<section class="content-block">
  <div class="container no-pad-t text-center">

    <h5 class="boxed-title">Social Links</h5>

    <a class="sm-link" href="https://twitter.com/jogjaistmw/"><i class="fa fa-twitter"></i></a> 
    <a class="sm-link" href="https://www.facebook.com/jogjaistmw"><i class="fa fa-facebook"></i></a> 
    <a class="sm-link" href="https://instagram.com/jogjaistmw/"><i class="fa fa-instagram"></i></a> 
    
  </div><!-- .container -->
</section><!-- .content-block -->


<section class="content-block">
  <div class="container no-pad-t">

  <div class="row">

    <div class="col-sm-6">
      <h5 class="boxed-title">video</h5>
      <div class="twitbadge-wrapper">
        <?php $yth = new WP_Query( array(
          'post_type'   => 'page',
          'pagename'    => 'youtube-beranda',
        ) ); 

        if( $yth->have_posts() ) : ?>
        <?php while( $yth->have_posts() ) : $yth->the_post(); ?>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $post->post_content; ?>" frameborder="0" allowfullscreen></iframe>
        <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div><!-- .col -->

    <div class="col-sm-6">
      <h5 class="boxed-title">@jogjaistmw</h5>
      <div class="twitbadge-wrapper">

        <a class="twitter-timeline"  href="https://twitter.com/jogjaistmw" data-widget-id="573131917236678656">Tweets by @jogjaistmw</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
      

      </div>
    </div><!-- .col -->

  </div><!-- .row -->

  </div><!-- .container -->
</section><!-- .content-block -->

<?php get_footer();