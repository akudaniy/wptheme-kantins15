<?php 
/**
 * The template for displaying archive pages
 *
 * @package KantinS15
 */

global $updirs;

get_header(); ?>

<section class="content-block">
  <div class="container no-pad-t">

    <?php if( have_posts() ): ?>

    <?php
      the_archive_title( '<h1 class="page-title">', '</h1>' );
      the_archive_description( '<div class="taxonomy-description">', '</div>' );
    ?>

    <div class="row">
    <?php while( have_posts() ): the_post(); ?>
    <div class="col-md-4 grid-col">
    <article class="blog-entry">
      
      <h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
      <?php the_excerpt() ?>
      <a href="<?php the_permalink() ?>" class="continue btn btn-primary">Selengkapnya</a>
      
    </article>
    </div><!-- .col -->
    <?php endwhile; ?>
    </div><!-- .row -->
    <?php endif; ?>
    
  </div><!-- .container -->
</section>

<?php get_footer();