<?php
    // Add scripts and stylesheets
    function mysecretmemory_scripts() {
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
        // wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css' );
        wp_enqueue_style('style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
        wp_enqueue_script('navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), false, true);

        wp_enqueue_script('lazy', get_template_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array('jquery'), false, true);

    }

    add_action( 'wp_enqueue_scripts', 'mysecretmemory_scripts' );


    // WordPress Titles
    add_theme_support('title-tag');

    // Support Featured Images
    add_theme_support( 'post-thumbnails' );

    // automatic feed links
    add_theme_support( 'automatic-feed-links' );

    // custom header
    add_theme_support('custom-header', array(
        'default-image' => get_template_directory_uri() . '/images/notes1.jpg',
        'uploads' => true
    ));
    
    register_default_headers(array(
        'default-image' => array(
            'url' => get_template_directory_uri() . '/images/notes1.jpg',
            'thumbnail_url' => get_template_directory_uri() . '/images/notes1_thumbnail.jpg',
            'description'   => __('Desktop', 'my-secret-memory' )
        ),
    ));


    // add editor style
    add_editor_style();


    // Comment walker.
    require get_template_directory() . '/classes/class-mysecretmemory-walker-comment.php';


    //comment reply script
    function mysecretmemory_enqueue_comments_reply() {
        if( get_option( 'thread_comments' ) )  {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    add_action('comment_form_before', 'mysecretmemory_enqueue_comments_reply' );


    //custom background
    add_theme_support( 'custom-background' );

    // register menu
    function mysecretmemory_register_menu() {
        register_nav_menus(
          array(
            'primary-menu' => __("Primary Menu", "my-secret-memory")
           )
         );
       }
    add_action( 'init', 'mysecretmemory_register_menu' );



    function mysecretmemory_settings_add_menu(){
        add_menu_page(__("Theme Settings", 'my-secret-memory'), __("Theme Settings", 'my-secret-memory'), 'manage_options', 'custom-settings', 'mysecretmemory_settings_page', null, 99 );
    }

    add_action( 'admin_menu', 'mysecretmemory_settings_add_menu' );


    function mysecretmemory_settings_page(){ ?>
        <div class="wrap">
            <h1><?php _e("Theme Settings", 'my-secret-memory') ?></h1>
            <form method="post" action="options.php">
                <?php
                    settings_fields('section');
                    do_settings_sections('theme-options');
                    submit_button();
                ?>
            </form>
        </div>
    <?php }

    //Twitter
    function setting_twitter(){?>
        <input type="text" name="twitter" id="twitter" value="<?php echo get_option('twitter'); ?>">
    <?php 
    }
    //Facebook
    function setting_facebook() { ?>
        <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
    <?php 
    }
    //Instagram
    function setting_instagram() { ?>
        <input type="text" name="instagram" id="instagram" value="<?php echo get_option('instagram'); ?>" />
    <?php 
    }
    //Pinterest
    function setting_pinterest() { ?>
        <input type="text" name="pinterest" id="pinterest" value="<?php echo get_option('pinterest'); ?>" />
    <?php 
    }

    function mysecretmemory_settings_page_setup(){
        add_settings_section('section', __('Social media', 'my-secret-memory'), null, 'theme-options');
        add_settings_field('twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section');
        add_settings_field('facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section');
        add_settings_field('instagram', 'Instagram URL', 'setting_instagram', 'theme-options', 'section');
        add_settings_field('pinterest', 'Pinterest URL', 'setting_pinterest', 'theme-options', 'section');
        register_setting('section', 'twitter');
        register_setting('section', 'facebook');
        register_setting('section', 'instagram');
        register_setting('section', 'pinterest');
    }

    add_action('admin_init', 'mysecretmemory_settings_page_setup');


    // register sidebar - widget area
    function mysecretmemory_widgets_init() {
        register_sidebar(
            array(
                'name'          => __( 'Main sidebar', 'my-secret-memory' ),
                'id'            => 'sidebar1',
                'description'   => __( 'Add widgets here to appear in your footer.', 'my-secret-memory' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
    add_action('widgets_init', 'mysecretmemory_widgets_init' );


    // $content_width variable
    function mysecretmemory_content_width() {
        // $GLOBALS['content_width'] = 900;
        if ( !isset( $content_width ) ) {
            $content_width = 900;
          }
    }
    add_action( 'after_setup_theme', 'mysecretmemory_content_width', 0 );


    // theme textdomain
    function mysecretmemory_load_theme_textdomain() {
        load_theme_textdomain('my-secret-memory', get_template_directory() . '/languages' );
    }
    add_action( 'after_setup_theme', 'mysecretmemory_load_theme_textdomain' );


    //Notice: ob_end_flush(): failed to send buffer of zlib output compression - prevent this error
    remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
    add_action( 'shutdown', function() {
        while ( @ob_end_flush() );
    } );



    //filter page title
    add_filter('wp_title', 'filter_page_title', 10, 2);
    function filter_page_title($title, $sep) {
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = get_bloginfo( 'name' ) . "$sep $site_description";
        else
            $title .=  get_bloginfo( 'name' );
        return $title;
    }
    

    function get_previous_posts() {
        ob_start();
        global $post;
        $oldGlobal = $post;
        $current_post = $_POST['post'];
        $post = get_page_by_title($current_post, OBJECT, 'post');
        $post = get_previous_post();
        get_template_part('template-parts/content', 'main');
        $html .= ob_get_contents();
        if(get_previous_post()){
            $prev=1;
        }
        if(get_next_post()){
            $next=1;
        }       
        ob_end_clean(); 
        header('Content-type: application/json');
        echo json_encode(array("next"=>$next, "prev"=>$prev, "html"=>$html));
        exit;
    }
    add_action('wp_ajax_get_previous_posts', 'get_previous_posts');
    add_action('wp_ajax_nopriv_get_previous_posts', 'get_previous_posts');


    function get_next_posts() {
        ob_start();
        global $post;
        $oldGlobal = $post;
        $current_post = $_POST['post'];
        $post = get_page_by_title($current_post, OBJECT, 'post');
        $post = get_next_post();
        get_template_part('template-parts/content', 'main');
        $html .= ob_get_contents();
        if(get_previous_post()){
            $prev=1;
        }
        if(get_next_post()){
            $next=1;
        }       
        ob_end_clean(); 
        header('Content-type: application/json');
        echo json_encode(array("next"=>$next, "prev"=>$prev, "html"=>$html));
        exit;
    }
    add_action('wp_ajax_get_next_posts', 'get_next_posts');
    add_action('wp_ajax_nopriv_get_next_posts', 'get_next_posts');


    function get_ajax_posts() {
        ob_start();
        $args = array(
            'post_status' => array('publish'),
            'order' => 'DESC',
            'orderby' => 'date'
        );
        $html = "";
        $ajaxposts = new WP_Query($args); 
        if($ajaxposts->have_posts()){
            while($ajaxposts->have_posts()){
                $ajaxposts->the_post();
                $html .= get_template_part('template-parts/content', 'main');
                $html .= ob_get_contents();
                if(get_previous_post()){
                    $prev=1;
                }
                if(get_next_post()){
                    $next=1;
                }
            }
        }
        ob_end_clean();
        header('Content-type: application/json');
        echo json_encode(array("next"=>$next, "prev"=>$prev, "html"=>$html));
        exit;
    }
    add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
    add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');
    

    function load_post_scripts(){
        wp_register_script('post', get_template_directory_uri() . '/js/post.js', array('jquery'));
        wp_localize_script('post', 'post_ajax', array('ajaxurl' => admin_url('admin-ajax.php')));
        wp_enqueue_script('post');
    }
    add_action('init', 'load_post_scripts');



    require get_template_directory() . '/inc/template-tags.php';
?>