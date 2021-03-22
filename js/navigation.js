jQuery(document).ready(function(){

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
            var inObj = jQuery(this);
            tIn = setTimeout(function(){
                inObj.children('.sub-menu').first().animate({"opacity":"1", "height": "toggle"}, 1000);
            }, 400, inObj);
        }, 
        function(){
            clearTimeout(tIn);
        }
    );

    jQuery('li.menu-item-has-children > a').focusin(
        function(){
            if(jQuery(this).parent(':focus-within').length){
                jQuery(this).parent().children('.sub-menu').first().animate({"opacity":"1", "height": "toggle"}, 1000);
            }
        }
    );

    jQuery('li.menu-item-has-children > a').focusout(
        function(){
            if(!jQuery(this).parent(':focus-within').length){
                jQuery(this).parent().children('.sub-menu').first().animate({"opacity":"0", "height": "toggle"}, 1000);
            }
        }
    );

    jQuery('.sub-menu > li > a').focusout(
        function(){
            if(!jQuery(this).parents().eq(1).parent(':focus-within').length){
                jQuery(this).parents().eq(1).animate({"opacity":"0", "height": "toggle"}, 1000);
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

