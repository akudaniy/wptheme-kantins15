<?php 
/**
 * The template for displaying all single posts and attachments.
 *
 * @package KantinS15
 */

global $updirs;

get_header(); ?>

<section class="content-block">
  <div class="container no-pad-t">

    <?php if( have_posts() ): ?>
    <?php while( have_posts() ): the_post(); ?>

    <?php 

    $pmeta = get_post_meta( get_the_ID(), 'youtube', TRUE ); 
    if( $pmeta ) : ?>

      <div class="post-video-wrap text-center">
        <iframe width="100%" height="500" src="https://www.youtube.com/embed/<?php echo $pmeta; ?>" frameborder="0" allowfullscreen></iframe>
      </div>

    <?php else: ?>

      <?php 

      $imwp = imwp_get_thumbnail('original', 'post-single-thumbnail', array('return_data_only' => TRUE)); 
      if( $imwp['img_id'] != 'attachment-image-default' ): ?>
      <div class="post-thumbnail-wrap text-center">
        <?php printf( '<img src="%s" width="%s" height="%s" class="%s" alt="%s" title="%s" />',
                  $imwp['img_src'], 
                  $imwp['img_w'], 
                  $imwp['img_h'], 
                  $imwp['img_class'], 
                  $imwp['img_alt'], 
                  $imwp['img_alt']
                  ) ?>
      </div>
      <?php endif; ?>

    <?php endif; ?>

    <article class="blog-entry">
    
      <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
      
      <?php the_content() ?>
      
      <?php imwp_view_gallery(); ?>
      
    </article>

    <h5 class="boxed-title">Bagikan</h5>
    <?php kantin_display_social_share(); ?>

    <?php endwhile; ?>
    <?php endif; ?>
    
  </div><!-- .container -->
</section>

<?php get_footer();