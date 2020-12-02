<div class="col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-0 col-xs-8 col-xs-offset-2">
  <div class="sidebar">
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
  </div>
</div><!-- /.blog-sidebar -->