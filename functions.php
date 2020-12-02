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
    
    // Comment walker.
    require get_template_directory() . '/classes/class-mysecretmemory-walker-comment.php';


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


    function mysecretmemory_load_theme_textdomain() {
        load_theme_textdomain('my-secret-memory', get_template_directory() . '/languages' );
    }
    add_action( 'after_setup_theme', 'mysecretmemory_load_theme_textdomain' );


    //Notice: ob_end_flush(): failed to send buffer of zlib output compression - prevent this error
    remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
    add_action( 'shutdown', function() {
        while ( @ob_end_flush() );
    } );


    add_filter( 'page_attributes_dropdown_pages_args', 'admin_page_attributes_meta_filter', 10, 2 );

function admin_page_attributes_meta_filter($dropdown_args, $post=NULL) {
    $dropdown_args['depth'] = 1;
    return $dropdown_args;

}
add_filter( 'quick_edit_dropdown_pages_args', 'admin_page_attributes_meta_filter', 10, 1);


    

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