jQuery(document).ready(function(){

    if(jQuery('.next.page-numbers').length){
        // Infinite scroll options
        jQuery('.section-posts').infiniteScroll({
            path: '.next.page-numbers',
            append: '.blog-post-main',
            status: '.scroller-status',
            hideNav: '.navigation.pagination',
            // scrollThreshold: 100,
            history: false
        });
    }

    // jQuery('input[type=checkbox]').focusin(function() {
    //     jQuery('#check').css('border-color', 'black');
    // });

    jQuery('input[type=checkbox]').focusin(function() {
        jQuery('#check').addClass('check-focus');
    });

    jQuery('input[type=checkbox]').focusout(function() {
        jQuery('#check').removeClass('check-focus');
    });

    jQuery.ajax({
        type: 'POST',
        url: post_ajax.ajaxurl,
        data: {action : 'get_ajax_posts'},
        success: function(results) {    
                jQuery('#new-posts').html(results.html);
                if(!results.prev){
                    jQuery('#previousPost').hide();
                };
                if(!results.next){
                    jQuery('#nextPost').hide();
                }
        },
        error: function(xhr, text, error){
            alert("Error: " + error);
        }   
    });

    jQuery('#nextPost').click(function(){
        jQuery.ajax({
            type: 'POST',
            url: post_ajax.ajaxurl,
            data: { action : 'get_next_posts',
                post: jQuery('.aBlogTitle').text().trim()},
            success: function(results) {    
                jQuery('#new-posts').html(results.html);
                if(!results.prev){
                    jQuery('#previousPost').hide();
                }else {
                    jQuery('#previousPost').show();
                }
                if(!results.next){
                    jQuery('#nextPost').hide();
                } else {
                    jQuery('#nextPost').show();
                }
            },
            error: function(xhr, text, error){
                alert("Error: " + error);
            }  
        });
    });

    jQuery('#previousPost').click(function(){
        jQuery.ajax({
            type: 'POST',
            url: post_ajax.ajaxurl,
            data: { action : 'get_previous_posts',
                post: jQuery('.aBlogTitle').text().trim()},
            success: function(results) {    
                jQuery('#new-posts').html(results.html);
                if(!results.prev){
                    jQuery('#previousPost').hide();
                }else {
                    jQuery('#previousPost').show();
                }
                if(!results.next){
                    jQuery('#nextPost').hide();
                } else {
                    jQuery('#nextPost').show();
                }
            },
            error: function(xhr, text, error){
                alert("Error: " + error);
            }  
        });
    });    
});