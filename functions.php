<?php
    // Add scripts and stylesheets
    function startwordpress_scripts() {
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6' );
        // wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/blog.css' );
        wp_enqueue_style('style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6', true);
        wp_enqueue_script('navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), false, true);

        wp_enqueue_script('lazy', get_template_directory_uri() . '/js/infinite-scroll.pkgd.min.js', array('jquery'), false, true);

    }

    add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );


    function startwordpress_google_fonts() {
        wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
        wp_enqueue_style( 'OpenSans');
    }
    
    add_action('wp_print_styles', 'startwordpress_google_fonts');

    // WordPress Titles
    add_theme_support('title-tag');

    // Support Featured Images
    add_theme_support( 'post-thumbnails' );
    
    // Custom comment walker.
    require get_template_directory() . '/classes/class-startwordpress-walker-comment.php';


    function custom_settings_add_menu(){
        add_menu_page('Theme Settings', 'Theme Settings', 'manage_options', 'custom-settings', 'custom_settings_page', null, 99 );
    }

    add_action( 'admin_menu', 'custom_settings_add_menu' );


    function custom_settings_page(){ ?>
        <div class="wrap">
            <h1>Custom Settings</h1>
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

    function custom_settings_page_setup(){
        add_settings_section('section', 'All Settings', null, 'theme-options');
        add_settings_field('twitter', 'Twitter URL', 'setting_twitter', 'theme-options', 'section');
        add_settings_field('facebook', 'Facebook URL', 'setting_facebook', 'theme-options', 'section');
        add_settings_field('instagram', 'Instagram URL', 'setting_instagram', 'theme-options', 'section');
        add_settings_field('pinterest', 'Pinterest URL', 'setting_pinterest', 'theme-options', 'section');
        register_setting('section', 'twitter');
        register_setting('section', 'facebook');
        register_setting('section', 'instagram');
        register_setting('section', 'pinterest');
    }

    add_action('admin_init', 'custom_settings_page_setup');


    function get_previous_posts() {
        ob_start();
        global $post;
        $oldGlobal = $post;
        $current_post = $_POST['post'];
        $post = get_page_by_title($current_post, OBJECT, 'post');
        $post = get_previous_post();
        // get_previous_post();
        // the_post();
        // $post = $oldGlobal;
        //echo $post->post_author;
        // get_template_part('content', get_post_format());
        get_template_part('template-parts/content', 'excerpt');
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
        // get_template_part('content', get_post_format());
        get_template_part('template-parts/content', 'excerpt');
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
                // get_template_part('content', get_post_format());
                get_template_part('template-parts/content', 'excerpt');
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
?>