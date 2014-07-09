/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function(){
    jQuery('input[type="text"][title]').each(function(){ 
        this.value = jQuery(this).attr('title');
        jQuery(this).addClass('text-label');

        jQuery(this).focus(function(){
            if(this.value == jQuery(this).attr('title')) {
                this.value = '';
                jQuery(this).removeClass('text-label');
            }
        });
        jQuery(this).blur(function(){
            if(this.value == '') {
                this.value = jQuery(this).attr('title');
                jQuery(this).addClass('text-label');
            }
        });
    });
    navigation.init();

});


navigation = {
    init: function() {
        jQuery("#container #main-nav .inner div ul li").hover(function() {
            jQuery("a:first", this).addClass("active");
            jQuery(".sub-menu-container", this).slideDown(100);
        }, function() {
            var li = jQuery(this);
            jQuery("a:first", li).removeClass("active");
            jQuery(".sub-menu-container", li).stop(true,true).slideUp(100);
            
        });
/*        jQuery("#container #header .inner #menu div > ul > li > a").each(function() {
            var li = jQuery(this).parent();
            // Set up the hover
            li.hover(function() {
                // The mouse enter
                if (jQuery(this).children(".sub-menu-container").length > 0) {
                    jQuery(this).find("a:first").addClass("active");
                    var ul = jQuery(this).find(".sub-menu-container");
                    jQuery(ul).slideDown();
                } else {
                    jQuery(this).find("a:first").addClass("active");
                }
            },
            function() {
                // The mouse leave
                jQuery(this).find("a:first").removeClass("active");
                jQuery(this).find(".sub-menu-container").stop(true, true).slideUp();
            });
        });*/
    }
}; 
contact = {
    init: function(id){
        jQuery.validator.methods.smart_required = function(value, element) {
                return value != jQuery(element).attr("title");
        };
        jQuery(id).validate({
            rules: {		
                    name: {
                            required: true
                    },
                    businessname: {
                            required: true
                    },
                    email:  {
                        required: true,
                        email: true
                    }
            },
            messages: {
                    name: "*",
                    businessname: "*",
                    email: "*"
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                        target: id+" .result"
                });
            }
        });     
    }    
};
var hovered = false;
function slideshow_rotator(container_id, button_right)
{
    if(!hovered)
    {
        jQuery(container_id).find(button_right).click();
    }
    setTimeout('slideshow_rotator(\''+container_id+'\', \''+button_right+'\');', 15000);
}
function init_slideshow(container_id, button_left, button_right, slide)
{
    init_slideshow_indicator(container_id, button_left, button_right, slide, '');
}
function init_slideshow_indicator(container_id, button_left, button_right, slide, indicator)
{
    var container = jQuery(container_id);
    jQuery(container).hover(function(){
        hovered = true;
    }, function(){
        hovered = false;
    });
    var set_active_indicator = function(index){
        if(indicator.length>0)
        {
            jQuery(container).find(indicator).removeClass('current-indicator');
            jQuery(container).find(indicator).each(function(idx, val){
                if(index ==idx)
                {
                    jQuery(this).addClass('current-indicator');
                }
            });
        }
    };
    //setup
    setTimeout('slideshow_rotator(\''+container_id+'\', \''+button_right+'\');', 15000);
    jQuery(container).find(slide+':first').show();
    jQuery(container).find(slide+':first').addClass('active');
    jQuery(container).find(indicator+':first').addClass('current-indicator');
    //events
    jQuery(container).find(button_left).click(function () {
        var current = jQuery(container).find('.active');
        jQuery(current).hide();
        jQuery(current).removeClass('active');
        var prev = jQuery(current).prev(slide);
        if(prev.length == 0)
        {
            prev = jQuery(container).find(slide+':last');
        }
        jQuery(prev).show();
        jQuery(prev).addClass('active');
        set_active_indicator(jQuery(prev).index(slide));
        return false;
    });
    jQuery(container).find(button_right).click(function () {
        var current = jQuery(container).find('.active');
        jQuery(current).hide();
        jQuery(current).removeClass('active');
        var next = jQuery(current).next(slide);
        if(next.length == 0)
        {
            next = jQuery(container).find(slide+':first');
        }
        jQuery(next).show();
        jQuery(next).addClass('active');
        set_active_indicator(jQuery(next).index(slide));
        return false;                
    });
    if(indicator.length>0)
    {
        jQuery(container).find(indicator).each(function(){
            jQuery(this).click(function(){
                var link = this;
                var current_slide = jQuery(container).find('.active');
                jQuery(current_slide).hide();
                jQuery(current_slide).removeClass('active');
                jQuery(container).find(slide).each(function(index, val){
                    if(index ==jQuery(link).index())
                    {
                        jQuery(this).show();
                        jQuery(this).addClass('active');
                        set_active_indicator(index);
                    }
                });                
                return false;
            });
        });
    }
}