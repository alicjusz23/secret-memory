<?php
/**
 * The main template file
 *
 */

get_header(); ?>


  <div class="row">
    <div class="col-sm-8">

      <!-- new posts -->
      <section class="blog-main">
        <h2>
          <?php _e("New on the blog", 'my-secret-memory'); ?>
        </h2>
        <div>
          <p id="new-posts"></p>
        </div>
          <nav>
            <ul class="pager">
              <li><a id="previousPost">
                <?php _e("Previous"); ?>
              </a></li>
              <li><a id="nextPost">
                <?php _e("Next"); ?>
              </a></li>
            </ul>
          </nav>
      </section>

      <!-- Posts by categories -->
      <section id="categories-main">
        <div>
          <h2>
            <?php _e("Posts by popular categories", 'my-secret-memory'); ?>
          </h2>
          <div class="row">
            <?php
              $categories = array_slice(get_categories(array('orderby'=>'post__in')), 0, 3);
              $i=0;
              $class_array = ["first", "second", "third"];
              foreach($categories as $t){
                ?>
                <div class="col-sm-4">
                  <div class="panel panel-default">
                    <a href="/category/<?php echo $t->slug; ?>">
                    <div class="cat-panel">
                      <div class="<?php echo $class_array[$i]?>"></div>
                      
                      <div class="cat-panel-text">
                        <?php
                          printf( '%s', $t->name );
                        ?>
                      </div>
                    </div>
                    </a>  
                  </div>
                </div>
                <?php
                $i++;
              }
            ?>
          </div>
        </div>
      </section>

      <!-- recent comments -->
      <section id="recent-comments">
        <h2><?php _e('Recent comments', 'my-secret-memory'); ?></h2>
          <div class="recent-com-div">
            <?php 
              $recent_comments = get_comments(array(
                'number' => 2,
                'status' => 'approve',
                'post_status' => 'publish'
              ));
              if($recent_comments){
                $comm = '';
                foreach($recent_comments as $comment){
                  //comment url
                  $comm .= '<li class="recent-com-li"><a class="author" href="' . get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID . '">';
                  //comment avatar
                  $comm .= '<div class="recent-com-avatar">' . get_avatar($comment->comment_author_email, 25) . '</div>';
                  //comment author
                  $comm .= '<span class="span-larger-text">' . get_comment_author($comment->comment_ID) . '</span></a>';
                  //comment post
                  $comm .= '<span class="green-text"> on <a href="' . get_permalink($comment->comment_post_ID) . '">"' . get_the_title($comment->comment_post_ID) . '"</a></span>';
                  //comment date
                  // $comm .= '<span class="green-text"> &bull; ' . date_i18n(get_option('date_format'), get_comment_date('', $comment->comment_ID)) . '</span>';
                  //comment excerpt
                  $comm .= '<p>' . substr($comment->comment_content , 0, 60);
                  if(strlen($comment->comment_content)>60){
                    $comm .= '...</p></li>';
                  }else {
                    $comm .= '</p></li>';
                  }
                }
                echo $comm;
              } else {
                _e('No comments', 'my-secret-memory');
              }
            ?>
          </div>
      </section>

    </div>

    <!-- empty column break -->
    <div class="col-sm-1"></div>

    <?php get_sidebar(); ?>
    
  </div>

<?php get_footer(); ?>

    