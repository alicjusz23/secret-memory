<?php
    get_header();
?>

<div class="blog-site-excerpt">
    <?php
    the_archive_title('<h2>', '</h2>');
    ?>

    <div class="row">
        <div class="col-sm-12">
            <section class="section-posts">
            <?php

                $result = new WP_Query(
                    array_merge(mysecretmemory_excerpt_post_query_array(), 
                        array('tag_id' => get_queried_object()->term_id)
                    )
                );

                if (have_posts()): 
                    while ($result->have_posts()): $result->the_post();
                        get_template_part('template-parts/content', 'excerpt');
                    endwhile; 
                else:
                    ?>
                        <secition>
                            <p class="blog-section">
                                <?php _e("Unfortunately no posts with this tag.", 'my-secret-memory'); ?>
                            </p>
                        </section>
                    <?php
                endif;

                the_posts_pagination(array('total' => $result->max_num_pages));
                ?>
            </section>
            <?php if($result->max_num_pages>1){ 
                mysecretmemory_post_pagination_scroller(); 
            } ?>
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</div>

<?php 
get_footer();

?>