/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function(){
    FsAnalyticsController.GetVisitor();
});
var FsAnalyticsController = new function() 
{    
    this.CurrentVisitor = '';

    this.GetVisitor = function () {
        if(typeof(ga) !== 'undefined')
        {
            ga(function(tracker) {
                var google_cid = tracker.get('clientId');        
                var arg = {
                    action: "fs_get_visitor",
                    request: jQuery(location).attr('href'),
                    referer: jQuery(document).prop("referrer"),
                    google_cid: google_cid
                };
                jQuery.post(FsCurrentAnalytics.FsAjax, arg, function(data){   
                    FsAnalyticsController.CurrentVisitor = data;
                    FsAnalyticsController.PageView();
                    FsPhoneController.SetPhoneRoutes();
                    FsAnalyticsController.FormView();
                    FsAnalyticsController.FormUpdate();
                });
            });
        }
        else
        {
             var arg = {
                action: "fs_get_visitor",
                request: jQuery(location).attr('href'),
                referer: jQuery(document).prop("referrer"),
                google_cid: ''
            };
            jQuery.post(FsCurrentAnalytics.FsAjax, arg, function(data){   
                FsAnalyticsController.CurrentVisitor = data;
                FsAnalyticsController.PageView();
                FsPhoneController.SetPhoneRoutes();
                FsAnalyticsController.FormView();
                FsAnalyticsController.FormUpdate();
            });
        }
    };
    this.PageView = function () {
        if(typeof(ga) !== 'undefined')
        {
            ga(function(tracker) {
                var google_cid = tracker.get('clientId');   
                var arg = {
                    action: "fs_page_view",
                    visitor: FsAnalyticsController.CurrentVisitor,            
                    request: jQuery(location).attr('href'),
                    referer: jQuery(document).prop("referrer"),
                    google_cid: google_cid
                };
                jQuery.post(FsCurrentAnalytics.FsAjax, arg, function(data){                
                    //alert(data);
                });                
            });
        }
        else
        {
            var arg = {
                action: "fs_page_view",
                visitor: FsAnalyticsController.CurrentVisitor,            
                request: jQuery(location).attr('href'),
                referer: jQuery(document).prop("referrer"),
                google_cid: ''
            };
            jQuery.post(FsCurrentAnalytics.FsAjax, arg, function(data){                
                //alert(data);
            });
        }
    };
    
    this.FormView = function() {
        jQuery("form.fs-form").each(function(){
            var form = jQuery(this).data("form");
            var arg = {
                action: "fs_form_view",
                visitor: FsAnalyticsController.CurrentVisitor,            
                request: jQuery(location).attr('href'),
                referer: jQuery(document).prop("referrer"),
                form: form
            };
            jQuery.post(FsCurrentAnalytics.FsAjax, arg, function(data){                
                //alert(data);
            });
        });
        
    };
    
    this.FormUpdate = function() {
        jQuery("input.fs-input, textarea.fs-input").change(function(){
           var field = jQuery(this).data("field");
           var value = jQuery(this).val();
           var arg = {
                action: "fs_form_update",
                visitor: FsAnalyticsController.CurrentVisitor,            
                request: jQuery(location).attr('href'),
                referer: jQuery(document).prop("referrer"),
                field: field,
                value: value
            };
            jQuery.post(FsCurrentAnalytics.FsAjax, arg, function(data){                
                //alert(data);
            });
        });
    };
    
};