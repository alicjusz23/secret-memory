jQuery(document).ready(function(){

/***** Menu ********/
    jQuery("#menuButton").click(function(){
        jQuery("#myNav").css('width', '100%');
        jQuery(".myButton").fadeOut();
    });

    jQuery(".blog-nav, #menuCloseButton").focusin(function(){
        jQuery("#myNav").css('width', '100%');
        jQuery(".myButton").hide();
    });
    
    jQuery(".blog-nav, #menuCloseButton").focusout(function(){
        jQuery("#myNav").css('width', '0%');
        jQuery(".myButton").show();
    });

    jQuery("#menuCloseButton").click(function(){
        jQuery("#myNav").css('width', '0%');
        jQuery(".myButton").fadeIn();
    });

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

