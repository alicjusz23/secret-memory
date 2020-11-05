<?php
/**
 * Template part for displaying posts
 *
*/
?>


<article class="blog-post">
  <div class="blog-post-info">
    <h2 class="blog-post-title"><?php the_title(); ?></h2>
    <p class="blog-post-meta">
      <?php the_category('&bull;'); ?>
    </p>
    <p class="blog-post-meta">Posted on <?php the_date('jS F Y'); ?> by <a href="/author/<?php echo get_the_author_meta('nickname'); ?>"><?php the_author(); ?> </a></p>
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
    <p class="blog-post-meta-bottom">
      <?php the_tags('', ' • '); ?>
    </p>
  </div>
</article><!-- /.blog-post -->