
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php wp_title(); echo " | "; echo bloginfo('name');?></title>
  <?php wp_head(); ?>
  </head>
  <body>

  <div class="skip-div">
    <a class="skip-link" href="#footer">Skip to content</a>
  </div>

  <div id="myNav" class="overlay">
    <a href="javascript:void(0)" id="menuCloseButton">&times</a>
    <div class="overlayContent">
      
      <nav class="blog-nav">
        <a class="blog-nav-item" href="/">Home</a>
        <?php wp_list_pages( '&title_li=' ); ?>
      </nav>
    </div>
  </div>


    <div class="blog-masthead">
      <nav class="navbar navbar-inverse myNavbar">
        <div class="container-fluid">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" id="menuButton" class="myButton">
                <div class="icon-bar1"></div>
                <div class="icon-bar2"></div>
                <div class="icon-bar3"></div> 
              </button>
            </div>
          </div>
        </div>
      </nav>
      <div class="container blog-header-all">
        <div class="blog-header">
          <h1 class="blog-title"><a href="<?php echo get_bloginfo( 'wpurl' );?>"><?php echo get_bloginfo( 'name' ); ?></a></h1>
          <p class="blog-description"><?php echo get_bloginfo( 'description' ); ?></p>
        </div>
      </div>
    </div>

    <div class="container">
      <main id="content">

