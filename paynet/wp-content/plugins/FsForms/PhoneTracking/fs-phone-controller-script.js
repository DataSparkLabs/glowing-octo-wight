/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function(){
       
});
var FsPhoneController = new function(){
    this.SetPhoneRoutes = function () {
        var routes = [];
        jQuery("span.fs-phone-route").each(function(){
            var route = jQuery(this).data("phone-route");
            if (jQuery.inArray(route, routes) === -1) 
            {
                routes.push(route);
            }
        });
        jQuery.each(routes, function(i, route){
            var arg = {
                action: "fs_get_phone",
                visitor: FsAnalyticsController.CurrentVisitor,
                phone_route: route
            };
            jQuery.post(FsCurrentPhone.FsAjax, arg, function(data){   
                jQuery("span.fs-phone-route[data-phone-route='"+route+"']").html(data);
            });
        });

    };
    
};