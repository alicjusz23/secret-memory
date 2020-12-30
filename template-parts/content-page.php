<?php
/**
 * Template part for displaying page content in page.php
 *
*/
?>


<article <?php post_class("blog-post"); ?>>
  <div class="blog-post-info">
    <h1 class="blog-post-title"><?php the_title(); ?></h1>
  </div>
  <div class="post-content">
    <div class="post-image">
      <?php 
        if(has_post_thumbnail()){
          the_post_thumbnail('medium');
        }
      ?>
    </div>
    <div class="post-text">
      <?php the_content(); ?>
    </div>
  </div>
</article><!-- /.blog-post -->