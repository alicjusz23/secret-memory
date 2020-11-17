<div class="col-sm-3 sidebar">

          <div class="sidebar-archives">
            <h3><?php _e("Archives"); ?></h3>
            <ol class="list-unstyled">
            <?php wp_get_archives('type=monthly'); ?>
            </ol>
          </div>

          <div class="sidebar-search">
            <?php get_search_form(); ?>
          </div>

          <div class="sidebar-tags">
            <?php wp_tag_cloud(); ?>
          </div>
        </div><!-- /.blog-sidebar -->