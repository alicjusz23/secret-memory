
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="alicjusz23">

    <!-- title displayed in the tab name -->
    <title><?php wp_title(); echo " | "; echo bloginfo('name');?></title>
  <?php wp_head(); ?>
  </head>
  <body>

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
          <a class="blog-nav-item" href="/">
            <?php _e("Home", 'my-secret-memory'); ?>
          </a>
          <?php wp_list_pages( 
              array(
                'title_li' => '',
                //show only 1st children of pages in the menu
                'depth' => 2
              )
             ); ?>
        </nav>
      </div>
    </div>


      <div class="blog-masthead">
        <nav class="navbar myNavbar">
          <!-- <div class="container-fluid"> -->
            <div class="navbar-header">
              <!-- hamburger menu button -->
              <button type="button" id="menuButton">
                <div class="icon-bar1"></div>
                <div class="icon-bar2"></div>
                <div class="icon-bar3"></div> 
              </button>
            </div>
          <!-- </div> -->
        </nav>
        <!-- blog header with blog name and description -->
        <div class="container blog-header-all">
          <div class="blog-header">
            <h1 class="blog-title"><a href="<?php echo get_bloginfo( 'wpurl' );?>">
              <?php echo get_bloginfo( 'name' ); ?>
            </a></h1>
            <p class="blog-description"><?php echo get_bloginfo( 'description' ); ?></p>
          </div>
        </div>
      </div>

      <div class="container">
        <main id="content">

