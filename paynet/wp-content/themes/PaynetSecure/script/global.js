/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
navigation = {
    init: function() {
        
        jQuery("#menu .inner div > ul > li > a").each(function() {
            var li = jQuery(this).parent();

            li.hover(function() {
                jQuery(this).find("a:first").addClass("active");
                jQuery("ul", this).stop(true, true).slideDown(100);
            },
            function() {               
                jQuery(this).find("a:first").removeClass("active");
                jQuery("ul", this).stop(true, true).slideUp(100);
            });
        });
    }
}; 

jQuery(document).ready(function(){
    //jQuery('div.tabs').tabs();    
    navigation.init();
});