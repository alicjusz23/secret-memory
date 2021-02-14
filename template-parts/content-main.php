<?php
/**
 * Template part for displaying post archives and search results
 *
*/
?>



<article <?php post_class("blog-post-main"); ?>>
  <h3 class="blog-post-title">
    <a href="<?php the_permalink(); ?>">
      <span class="aBlogTitle" >
        <?php the_title(); ?>
      </span>
    </a>
    <span class="sticky-title"><?php _e("Featured", 'my-secret-memory'); ?></span>
  </h3>
  <p class="blog-post-meta-main">
    <a href="<?php the_permalink(); ?>">
      <?php echo date_i18n(get_option('date_format'), strtotime($post->post_date)); ?>
    </a>
      &bull; <?php _e(' By ', 'my-secret-memory') ?> <a href="/author/<?php echo get_the_author_meta('nickname', $post->post_author); ?>"><?php echo get_the_author_meta('display_name', $post->post_author); ?></a> &bull; 
    <a href="<?php comments_link(); ?>">
      <?php
        printf(_n('One Comment', '%s Comments', get_comments_number(), 'my-secret-memory'), 
          number_format_i18n(get_comments_number())); 
      ?>
    </a>
  </p>
  <?php  
    
  ?>
    <div class="row">
      <div class="col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 thumbmnail-home">
        <a href="<?php the_permalink(); ?>">
          <?php
          if(has_post_thumbnail()){
            the_post_thumbnail('thumbnail');
          }else {
            ?><img class="attachment-thumbnail wp-post-image" src="<?php echo esc_url(get_template_directory_uri() . '/images/image.jpg' );?>" ><?php
          }
          ?>
        </a>
      </div>
      <div class="col-sm-8 col-xs-12 blog-excerpt">
        <?php 
          the_excerpt();
        ?>
      </div>
    </div>
  
    </article><!-- /.blog-post -->