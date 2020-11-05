<?php
get_header(); ?>

<h2> 
    <?php 
        $author = get_user_by('slug', get_query_var('author_name') );
        if($author->nickname)
            echo $author->first_name;
        else 
        echo $author->nickname; 
    ?>
's posts</h2>
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
            'author' => $author->ID,
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'paged' => $paged
        );

        // wp_reset_postdata();
        $result = new WP_Query($args);

if ($result->have_posts()): 
    while ($result->have_posts()): $result->the_post();
        // get_template_part('content', get_post_format());
        get_template_part('template-parts/content', 'excerpt');
    endwhile; 

    the_posts_pagination(array(
        'screen_reader_text' => ' ',
        'mid_size' => 2,
        'prev_text' => __( '<< Back', 'textdomain' ),
        'next_text' => __( 'Onward >>', 'textdomain' ),
        'total' => $result->max_num_pages,
        // 'paged' => $paged
    ));
    if($result->max_num_pages>1): ?>
        <div class="scroller-status"> 
            <div class="infinite-scroll-request loader-ellips">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div> 
        </div> 
    <? endif; 
else:
    ?>
        <secition>
            <p class="blog-section">
                Unfortunately no posts of this author.
            </p>
        </section>
    <?php
endif;

            ?>
            </section>
<?php ?>
		</div> <!-- /.col -->
	</div> <!-- /.row -->

<?php 
get_footer();

?>