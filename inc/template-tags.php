<?php
/**
 * Custom template tags for this theme
 * 
 * 
 **/
 


if (!function_exists('mysecretmemory_post_pagination_scroller')) :
	/**
	 * Prints infinite scroller ellips
	 */
	function mysecretmemory_post_pagination_scroller() {
        ?>
        <div class="scroller-status"> 
            <div class="infinite-scroll-request loader-ellips">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div> 
        </div> 
        <?
    }
endif;


if (!function_exists('mysecretmemory_excerpt_post_query_array')) :
	/**
	 * Returns 
	 */
	function mysecretmemory_excerpt_post_query_array() {
        if ( get_query_var('paged') ) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }

        $args = array(
            'post_type'=> 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'paged' => $paged
        );

        return $args;
    }
endif;