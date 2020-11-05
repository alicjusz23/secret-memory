<?php
get_header(); ?>

<h2>Looking for: '
    <?php 
        $search_phrase = get_search_query(); 
        echo $search_phrase; 
    ?>
'</h2>
<div class="row">
	<div class="col-sm-12">

        <?php
        
        $args = array(
            's' => $search_phrase,
            'orderby'    => 'ID',
            'post_status' => 'publish',
            'order'    => 'DESC',
            'posts_per_page' => -1 // this will retrive all the post that is published 
        );
        $result = new WP_Query($args);

if ($result->have_posts()): 
    while ($result->have_posts()): $result->the_post();
        // get_template_part('content', get_post_format());
        get_template_part('template-parts/content', 'excerpt');
    endwhile; 
else:
    ?>
        <secition>
            <p class="blog-section">
                Unfortunately no results with this phrase.
            </p>
        </section>
    <?php
endif;
			?>

		</div> <!-- /.col -->
	</div> <!-- /.row -->

<?php 
get_footer();

?>