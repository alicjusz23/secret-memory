jQuery(document).ready(function(){

    if(jQuery('.next.page-numbers').length){
        // Infinite scroll options
        jQuery('.section-posts').infiniteScroll({
            path: '.next.page-numbers',
            append: '.blog-post-excerpt',
            status: '.scroller-status',
            hideNav: '.navigation.pagination',
            // scrollThreshold: 100,
            history: false
        });
    }

    jQuery('input[type=checkbox]').focusin(function() {
        jQuery('#check').addClass('check-focus');
    });

    jQuery('input[type=checkbox]').focusout(function() {
        jQuery('#check').removeClass('check-focus');
    });


    ajaxStickyPost();

    function ajaxStickyPost(){
        jQuery.ajax({
            type: 'POST',
            url: post_ajax.ajaxurl,
            data: {action : 'get_sticky_posts'},
            success: function(results) {
                if(results.status===1){    
                    jQuery('#new-posts').html(results.html);
                    jQuery('#pager-sticky').html(`
                    <nav>
                        <ul class="pager">
                        <li><a id="previousStickyPost">
                            ` + results.prevText + `
                        </a></li>
                        </ul>
                    </nav>
                    `);
                    jQuery('#pager-sticky').show();
                    jQuery('#pager-main').hide();
                    jQuery('#previousStickyPost').click(function(){
                        ajaxPost();
                    });
                } else {
                    ajaxPost();
                }
            }
        });
    }


    function ajaxPost(){
        jQuery.ajax({
            type: 'POST',
            url: post_ajax.ajaxurl,
            data: {action : 'get_ajax_posts'},
            success: function(results) {    
                jQuery('#pager-sticky').hide();
                jQuery('#pager-main').show();
                jQuery('#new-posts').html(results.html);
                if(results.prev===null){
                    jQuery('#previousPost').hide();
                }else {
                    jQuery('#previousPost').show();
                }
                if(results.next===null){
                    jQuery('#nextPost').hide();
                    if(results.sticky){
                        jQuery('#nextToSticky').css('display', 'inline-block');
                        jQuery('#nextToSticky').click(function() {
                            ajaxStickyPost();
                        });
                    }else {
                        jQuery('#nextToSticky').hide();
                    }
                } else {
                    jQuery('#nextPost').show();
                }
            } 
        });
    }




    jQuery('#nextPost').click(function(){
        jQuery.ajax({
            type: 'POST',
            url: post_ajax.ajaxurl,
            data: { action : 'get_next_posts',
                    post: jQuery('article.blog-post-main').attr('class').split(/\s+/)[1].slice(5)},
            success: function(results) {    
                jQuery('#new-posts').html(results.html);
                if(results.prev===null){
                    jQuery('#previousPost').hide();
                }else {
                    jQuery('#previousPost').show();
                }
                if(results.next===null){
                    jQuery('#nextPost').hide();
                    if(results.sticky)
                        jQuery('#nextToSticky').css('display', 'inline-block');
                    else {
                        jQuery('#nextToSticky').hide();
                    }
                } else {
                    jQuery('#nextPost').show();
                    jQuery('#nextToSticky').hide();
                }
            }
            // ,
            // error: function(xhr, text, error){
            //     alert("Error: " + error);
            // }  
        });
    });

    jQuery('#previousPost').click(function(){
        jQuery.ajax({
            type: 'POST',
            url: post_ajax.ajaxurl,
            data: { action : 'get_previous_posts',
                post: jQuery('article.blog-post-main').attr('class').split(/\s+/)[1].slice(5)},
            success: function(results) {    
                jQuery('#new-posts').html(results.html);
                if(results.prev===null){
                    jQuery('#previousPost').hide();
                }else {
                    jQuery('#previousPost').show();
                }
                if(results.next===null){
                    jQuery('#nextPost').hide();
                    if(results.sticky)
                        jQuery('#nextToSticky').css('display', 'inline-block');
                    else {
                        jQuery('#nextToSticky').hide();
                    }
                } else {
                    jQuery('#nextPost').show();
                    jQuery('#nextToSticky').hide();
                }
            }
            // ,
            // error: function(xhr, text, error){
            //     alert("Error: " + error);
            // }  
        });
    });    
});