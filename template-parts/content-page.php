<?php
/**
 * Template part for displaying page content in page.php
 *
*/
?>


<article <?php post_class("blog-post"); ?>>
  <div class="blog-post-info">
   
    <h1 class="blog-post-title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a></h1>
  </div>

  
  <?php $anc = array_reverse(get_post_ancestors(get_the_ID()));
    if(count($anc)):
      ?>
      <div class="page_anc">
      <?php
      // echo json_encode(get_post_ancestors(get_the_ID())); 
      foreach ($anc as $p){
        ?>
        <a href="<?php the_permalink($p); ?>">
        <?php
          echo get_post($p)->post_title;
        ?>
        </a> >> 
        <?php
      }
      ?><a href="<?php the_permalink(); ?>"><?php
        echo get_post(get_the_ID())->post_title;
      ?>
      </a>
      </div>
      <?php
    endif;
  ?>

  <div class="post-content">
    <?php 
      if(has_post_thumbnail()){
    ?>
      <div class="post-image">
        <?php
          the_post_thumbnail('medium');
        ?>
      </div>
    <?php } ?>
    <div class="post-text">
      <?php the_content(); ?>
    </div>
    <div style="clear: both;"></div>
  </div>
</article><!-- /.blog-post -->