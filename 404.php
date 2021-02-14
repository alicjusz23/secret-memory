<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */


get_header();
?>

<div class="p404">
    <h2>
        <?php _e("Ooops, something went wrong.", 'my-secret-memory'); ?>
    </h2>
    <div class="p404-description">
        <p><?php _e("This page is not available.", 'my-secret-memory'); ?></p>
        <p><?php _e("Why not going to the", 'my-secret-memory'); ?> <a href="/"><?php _e("Home page", 'my-secret-memory'); ?></a>?</p>
    </div>
</div>


<?php
get_footer();