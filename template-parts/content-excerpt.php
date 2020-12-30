<?php
/**
 * Template part for displaying post archives and search results
 *
*/
?>



<article class="blog-post-excerpt">
  <h3 class="blog-post-title">
    <a class="aBlogTitle" href="<?php the_permalink(); ?>">
      <?php the_title(); ?>
    </a>
  </h3>
  <p class="blog-post-meta-main"><?php echo date_i18n(get_option('date_format'), strtotime($post->post_date)); ?>&nbsp; &bull; &nbsp;<?php _e(' By ', 'my-secret-memory') ?> <a href="/author/<?php echo get_the_author_meta('nickname', $post->post_author); ?>"><?php echo get_the_author_meta('display_name', $post->post_author); ?></a>&nbsp; &bull; &nbsp;
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
      <div class="col-lg-3 col-sm-4 col-sm-offset-0 col-xs-6 col-xs-offset-3 thumbmnail-home">
        <?php
        if(has_post_thumbnail()){
          the_post_thumbnail('thumbnail');
        }else {
          ?><img class="attachment-thumbnail wp-post-image" src="<?php echo esc_url(get_template_directory_uri() . '/images/image.jpg' );?>" ><?php
        }
        ?>
      </div>
      <div class="col-lg-9 col-sm-8 col-sm-offset-0 col-xs-12 blog-excerpt">
        <?php 
          the_excerpt();
        ?>
        <p class="excerpt-tags">
        <?php
          if(has_category())
            the_category('&nbsp;  &bull;  &nbsp;');
          if(has_tag() && has_category())
            echo  (str_repeat('&nbsp;', 4) . "|" . str_repeat('&nbsp;', 4));
          if(has_tag()){
            ?>
            <span class="text-italic">
            <?php
            the_tags('', '&nbsp; • &nbsp;'); 
            ?>
            </span>
            <?php
          }
        ?></p><?php
        ?>
      </div>
    </div>
  
    </article><!-- /.blog-post -->