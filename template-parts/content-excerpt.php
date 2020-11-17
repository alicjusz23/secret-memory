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
  <p class="blog-post-meta-main"><?php echo date_i18n(get_option('date_format'), strtotime($post->post_date)); ?> &bull; <?php _e(' By ', 'my-secret-memory') ?> <a href="/author/<?php echo get_the_author_meta('nickname', $post->post_author); ?>"><?php echo get_the_author_meta('display_name', $post->post_author); ?></a> &bull; 
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
      <div class="col-md-2 thumbmnail-home">
        <?php
        if(has_post_thumbnail()){
          the_post_thumbnail('thumbnail');
        }else {
          ?><img class="attachment-thumbnail wp-post-image" src="<?php echo get_template_directory_uri();?>/images/image.jpg" ><?
        }
        ?>
      </div>
      <div class="col-md-10 blog-excerpt">
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
            <?
          }
        ?></p><?php
        ?>
      </div>
    </div>
  
    </article><!-- /.blog-post -->