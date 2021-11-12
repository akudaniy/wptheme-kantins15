<?php 
/**
 * The main template file.
 *
 * @package KantinS15
 */

global $updirs;

get_header(); ?>

<section class="content-block">
  <div class="container no-pad-t">

    <?php if( have_posts() ): ?>
    <?php while( have_posts() ): the_post(); ?>
    <article class="blog-entry">
    
      <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>

      <?php if( is_single() || is_page() ): ?>
      
        <?php the_content() ?>
      
      <?php else: ?>
      
        <?php the_excerpt() ?>
        <a href="<?php the_permalink() ?>" class="continue btn btn-primary">Selengkapnya</a>
      
      <?php endif; ?>
      
      
    </article>
    <?php endwhile; ?>
    <?php endif; ?>
    
  </div><!-- .container -->
</section>

<?php get_footer();