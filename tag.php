<?php
get_header(); ?>

<?php
    the_archive_title('<h3>', '</h3>');
?>
<div class="row">
	<div class="col-sm-12">
        <section class="section-posts">
        <?php
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        
        $args = array(
            'post_type'=> 'post',
            'tag_id' => get_queried_object()->term_id,
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'paged' => $paged
        );

        // wp_reset_postdata();
        $result = new WP_Query($args);

        if (have_posts()): 
            while ($result->have_posts()): $result->the_post();
                // get_template_part('content', get_post_format());
                get_template_part('template-parts/content', 'excerpt');
            endwhile; 
        else:
            ?>
                <secition>
                    <p class="blog-section">
                        Unfortunately no posts in this category.
                    </p>
                </section>
            <?php
        endif;

the_posts_pagination(array(
    'screen_reader_text' => ' ',
    'mid_size' => 2,
    'prev_text' => __( '<< Back', 'textdomain' ),
    'next_text' => __( 'Onward >>', 'textdomain' ),
    'total' => $result->max_num_pages,
    // 'paged' => $paged
));
            ?>
            </section>
<?php if($result->max_num_pages>1){ ?>
            <div class="scroller-status"> 
                <div class="infinite-scroll-request loader-ellips">
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                </div> 
            </div> 
<? } ?>
		</div> <!-- /.col -->
	</div> <!-- /.row -->

<?php 
get_footer();

?>