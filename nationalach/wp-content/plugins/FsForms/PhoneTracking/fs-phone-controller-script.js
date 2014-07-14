/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function(){
       
});
var FsPhoneController = new function(){
    this.ClientHandler = 'http://crm.funnelscience.com/FsClientHandler.php';
    //this.ClientHandler = 'http://localhost/~rudyard/FsCRM/src/FsClientHandler.php';
    
    this.SetPhoneRoutes = function (website) {
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
                action: "get_route_number",
                visitor: FsAnalyticsController.CurrentVisitor,
                session: FsAnalyticsController.CurrentSession, 
                phone_route: route,
                website: website
            };
            jQuery.ajax({ 
                url: FsPhoneController.ClientHandler,
                data: arg,
                type: "POST",
                dataType: 'json',
                success: function(data)
                {
                    if(data.error)
                    {
                         jQuery("span.fs-phone-route[data-phone-route='"+route+"']").html(FsCurrentPhone.FallbackPhone);                   
                    }
                    else
                    {
                        jQuery("span.fs-phone-route[data-phone-route='"+route+"']").html(data.number);
                        jQuery("a.fs-phone-route[data-phone-route='"+route+"']").html(data.number);
                        jQuery("a.fs-phone-route[data-phone-route='"+route+"']").attr("href","tel:"+data.number_plain);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) 
                {
                    jQuery("span.fs-phone-route[data-phone-route='"+route+"']").html(FsCurrentPhone.FallbackPhone); 
                }
            });
           
        });
    };
    
};