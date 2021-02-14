
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="alicjusz23">

    <!-- title displayed in the tab name -->
    
    <title><?php wp_title(' | ', true, 'right'); ?></title>
  <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> >
    <?php wp_body_open(); ?>

    <!-- skip link to main content -->
    <div id="skip-div">
      <a class="skip-link" href="#content">
        <?php _e("Skip to content", 'my-secret-memory'); ?>
      </a>
    </div>

    <div id="myNav" class="overlay">
      <?php
        //in order to move x sign lower when admin bar is showing
        if (is_admin_bar_showing()) 
          echo '<div style="min-height: 32px;"></div>'; 
      ?>
      <a href="javascript:void(0)" id="menuCloseButton">&times</a>
      
      <div class="overlayContent">
        <!-- ovelay menu content -->
        <nav class="blog-nav">
          <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
        </nav>
      </div>
    </div>


      <div class="blog-masthead" style="background-image: url(<?php header_image(); ?>);">
        <nav class="navbar myNavbar">
          <div class="navbar-header">
            <!-- hamburger menu button -->
            <button type="button" id="menuButton">
              <div class="icon-bar1"></div>
              <div class="icon-bar2"></div>
              <div class="icon-bar3"></div> 
            </button>
          </div>
        </nav>
        <!-- blog header with blog name and description -->
        <div class="container blog-header-all">
          <div class="blog-header">
            <?php if(display_header_text()): ?>
              <h1 class="blog-title"><a href="<?php echo esc_url( home_url() );?>">
                <?php echo get_bloginfo( 'name' ); ?>
              </a></h1>
              <p class="blog-description"><?php echo get_bloginfo( 'description' ); ?></p>
              <?php endif;?>
          </div>
        </div>
      </div>

      <div class="container">
        <main id="content">

