jQuery(document).ready(function(){
    
    // jQuery('body').focusin(function(){
    //     console.log(jQuery(':focus').toArray());
    // });

/***** Menu ********/
    jQuery("#menuButton").click(function(){
        jQuery("#myNav").css('width', '100%');
        jQuery("#menuButton").fadeOut();
    });

    jQuery(".blog-nav, #menuCloseButton").focusin(function(){
        jQuery("#myNav").css('width', '100%');
        jQuery("#menuButton").hide();
    });
    
    jQuery(".blog-nav, #menuCloseButton").focusout(function(){
        jQuery("#myNav").css('width', '0%');
        jQuery("#menuButton").show();
    });

    jQuery("#menuCloseButton").click(function(){
        jQuery("#myNav").css('width', '0%');
        jQuery("#menuButton").fadeIn();
    });

    //menu subpages animation
    jQuery('.page_item_has_children').hover(
        function(){
            // console.log(jQuery(':focus').toArray());
                jQuery(this).find('.children').animate({"opacity":"1", "height": "toggle"}, 400);
        }, 
        function(){
                jQuery(this).find('.children').animate({"opacity":"0", "height": "toggle"}, 400);
        }
    );

    jQuery('li.page_item_has_children > a').focusin(
        function(){
            if(jQuery(this).parent().find('.children').css('opacity')==='0'){
                // console.log('ala');
                jQuery(this).parent().find('.children').animate({"opacity":"1", "height": "toggle"}, 400);
            }
        }
    );

    jQuery('li.page_item_has_children > a').focusout(
        function(){
            // console.log(jQuery(this).parent(':focus-within').toArray());
            // if(jQuery(this).parent().find('.children').css('opacity')==='1' && !jQuery(this).parent().find('.children').is(':focus')){
            if(!jQuery(this).parent(':focus-within').length){
                // console.log(this);
                jQuery(this).parent().find('.children').animate({"opacity":"0", "height": "toggle"}, 400);
            }
        }
    );

    jQuery('.children > li > a').focusout(
        function(){
            // console.log(jQuery(this).parents().eq(1).parent(':focus-within').length);
            if(!jQuery(this).parents().eq(1).parent(':focus-within').length){
                jQuery(this).parents().eq(1).animate({"opacity":"0", "height": "toggle"}, 400);
            }
        }
    );

    // jQuery('li.page_item_has_children').find('.children > a').focus(function(){
    //     // jQuery(this).animate({"opacity":"1", "height": "toggle"}, 400);
    //     // jQuery(this).css("display", "list-item");
    //     jQuery(this).animate({"opacity":"1", "height": "toggle", "display": "list-item"}, 400);
    // });

    // jQuery('li.page_item_has_children').on("focusout",
    //     function(){
    //         // if(jQuery(this).find('.children').css('opacity')==='1'){
    //             jQuery(this).find('.children').animate({"opacity":"0", "height": "toggle"}, 400);
    //         // }
    //     }
    // ); 
    // jQuery('.page_item_has_children').find('.children').focusin(
    //     function(){
    //         jQuery(this).animate({"opacity":"1", "height": "toggle"}, 400);
    //     }
    // ).focusout(
    //     function(){
    //         jQuery(this).animate({"opacity":"0", "height": "toggle"}, 400);
    //     }
    // ); 



/***** Top scroller ********/
    jQuery(window).scroll(function(){
        if(jQuery(this).scrollTop()>100){
            jQuery('#topScrollButton').fadeIn();
        } else {
            jQuery('#topScrollButton').fadeOut();
        }
    });

    jQuery('#topScrollButton').click(function(){
        jQuery('html, body').animate({scrollTop: 0}, 500, "swing");
        return false; 
    });
});

