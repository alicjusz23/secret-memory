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
    var tIn;
    jQuery('.menu-item-has-children').hover(
        function(){
            // clearTimeout(tOut);
            var inObj = jQuery(this);
            tIn = setTimeout(function(){
                inObj.children('.sub-menu').first().animate({"opacity":"1", "height": "toggle"}, 400);
            }, 400, inObj);
        }, 
        function(){
            clearTimeout(tIn);
        }
    );

    jQuery('li.menu-item-has-children > a').focusin(
        function(){
            if(jQuery(this).parent().children('.sub-menu').first().css('opacity')==='0'){
                jQuery(this).parent().children('.sub-menu').first().animate({"opacity":"1", "height": "toggle"}, 400);
            }
        }
    );

    jQuery('li.menu-item-has-children > a').focusout(
        function(){
            // console.log(jQuery(this).parent(':focus-within').toArray());
            // if(jQuery(this).parent().find('.sub-menu').css('opacity')==='1' && !jQuery(this).parent().find('.sub-menu').is(':focus')){
            if(!jQuery(this).parent(':focus-within').length){
                // console.log(this);
                jQuery(this).parent().children('.sub-menu').first().animate({"opacity":"0", "height": "toggle"}, 400);
            }
        }
    );

    jQuery('.sub-menu > li > a').focusout(
        function(){
            // console.log(jQuery(this).parents().eq(1).parent(':focus-within').length);
            if(!jQuery(this).parents().eq(1).parent(':focus-within').length){
                jQuery(this).parents().eq(1).animate({"opacity":"0", "height": "toggle"}, 400);
            }
        }
    );



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

