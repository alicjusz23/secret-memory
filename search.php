<?php
get_header();


?>

<h2>
    <?php _e('Looking for: ', 'my-secret-memory'); ?>'
    <?php 
        $search_phrase = get_search_query(); 
        echo $search_phrase; 
    ?>
'</h2>
<div class="row">
	<div class="col-sm-12">
        <section class="section-posts">

        <?php
            $result = new WP_Query(
                array_merge(mysecretmemory_excerpt_post_query_array(), 
                    array('s' => $search_phrase)
                )
            );
            if ($result->have_posts()): 
                while ($result->have_posts()): $result->the_post();
                    get_template_part('template-parts/content', 'excerpt');
                endwhile; 
            else:
                ?>
                    <secition>
                        <p class="blog-section">
                            <?php _e("Unfortunately no results with this phrase.", 'my-secret-memory'); ?>
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