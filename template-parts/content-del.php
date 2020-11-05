<?php
/**
 * Template part for displaying posts
 *
*/
?>



<article class="blog-post-main">
  <h3 class="blog-post-title">
    <a class="aBlogTitle" href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
    </a>
  </h3>
  <p class="blog-post-meta-main"><?php echo date('jS F Y', strtotime($post->post_date)); ?> &bull; By <a href="/author/<?php echo get_the_author_meta('nickname'); ?>"><?php echo get_the_author_meta('display_name', $post->post_author); ?></a> &bull; 
    <a href="<?php comments_link(); ?>">
      <?php
      printf(_nx('One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain'), number_format_i18n(get_comments_number())); ?>
    </a>
  </p>
  <?php  
    
  ?>
    <div class="row">
      <div class="col-md-4 thumbmnail-home">
        <?php
        if(has_post_thumbnail()){
          the_post_thumbnail('thumbnail');
        }else {
          ?><img class="attachment-thumbnail wp-post-image" src="<?php echo get_template_directory_uri();?>/images/image.jpg" ><?
        }
        ?>
      </div>
      <div class="col-md-8 blog-excerpt">
        <?php 
          the_excerpt();
        ?>
      </div>
    </div>
  
    </article><!-- /.blog-post -->