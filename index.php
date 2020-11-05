
<?php get_header(); ?>
      <div class="row">
        <div class="col-sm-8">
            <section class="blog-main">
              <h2>New on the blog</h2>
              <div>
                <p id="new-posts"></p>
              </div>
                    <nav>
                      <ul class="pager">
                        <li><a id="previousPost">Previous</a></li>
                        <li><a id="nextPost">Next</a></li>
                      </ul>
                    </nav>
            </section><!-- /.blog-main -->
            <section id="categories-main">
              <div>
              <h2>Posts by popular categories</h2>
                <div class="row">
                <?php
                  $categories = array_slice(get_categories(array('orderby'=>'post__in')), 0, 3);
                //   if ( $categories ) {
                //     printf( '<div class="col">%s</div>', $categories );
                // }
                  $i=0;
                  $class_array = ["first", "second", "third"];
                  foreach($categories as $t){
                    ?>
                    <div class="col-sm-4">
                      <div class="panel panel-default">
                        <div class="cat-panel">
                          <div class="<?php echo $class_array[$i]?>"></div>
                          
                          <p><a href="/category/<?php echo $t->slug; ?>">
                            <?php
                              printf( '%s', $t->name );
                            ?>
                          </a></p>
                        </div>
                      </div>
                    </div>
                    <?php
                    $i++;
                  }
                  ?>
                </div>
              </div>
            </section>
            <section id="about-main">
              <h2>About the author</h2>
                <p>
                  <?php global $post;
                  $author_id = $post->post_author;
                  echo get_the_author_meta('description', $author_id); ?>
                </p>
                <div class="read-more"><a href="/about">Read more >></a></div>
            </section>
        </div>
        <div class="col-sm-1"></div>
        <?php get_sidebar(); ?>
      </div><!-- /.row -->
<?php get_footer(); ?>

    