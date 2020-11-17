<?php
    get_header(); 


    the_archive_title('<h3>', '</h3>');


    // ?>
    <!-- <h2>  -->
    <!-- <?php 
        // $author = get_user_by('slug', get_query_var('author_name') );
        // if($author->nickname)
        //     echo $author->first_name;
        // else 
        // echo $author->nickname; 
    ?> -->
<!-- 's posts</h2> -->
<?php

?>

<div class="row">
	<div class="col-sm-12">
        <section class="section-posts">
            <?php
            $author = get_user_by('slug', get_query_var('author_name'));
            $result = new WP_Query(
                array_merge(mysecretmemory_excerpt_post_query_array(), 
                    array('author' => $author->ID)
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
                            <?php _e("Unfortunately no posts published by this author.", 'my-secret-memory'); ?>
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

<?php 
get_footer();

?>