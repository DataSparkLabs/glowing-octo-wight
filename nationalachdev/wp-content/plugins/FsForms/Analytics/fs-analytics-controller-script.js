/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function(){
    FsAnalyticsController.ProcessVisitor(FsCurrentAnalytics.Website);
});
var FsAnalyticsController = new function() {
    this.CurrentVisitor = '';
    this.CurrentSession = '';
    this.ClientHandler = 'http://crm.funnelscience.com/FsClientHandler.php';
    //this.ClientHandler = 'http://localhost/~rudyard/FsCRM/src/FsClientHandler.php';
    
    this.ProcessVisitor = function(website) {
        FsAnalyticsController.CurrentVisitor = jQuery.cookie('FsVisitorId');
        FsAnalyticsController.CurrentSession = jQuery.cookie('FsSessionId');
        
        if(this.CurrentVisitor === undefined || this.CurrentSession === undefined)
        {
            if(typeof(ga) !== 'undefined')
            {
                ga(function(tracker) {
                    var google_cid = tracker.get('clientId');        
                    var arg = {
                        action: "process_visitor",
                        website: website,
                        visitor: FsAnalyticsController.CurrentVisitor,
                        request: jQuery(location).attr('href'),
                        referer: jQuery(document).prop("referrer"),
                        google_cid: google_cid
                    };
                    jQuery.post(FsAnalyticsController.ClientHandler, arg, function(data){   
                        var obj = jQuery.parseJSON(data);
                        FsAnalyticsController.CurrentVisitor = obj.visitor;
                        jQuery.cookie('FsVisitorId', FsAnalyticsController.CurrentVisitor, { expires: 365, path: '/' });
                        FsAnalyticsController.CurrentSession = obj.session;
                        jQuery.cookie('FsSessionId', FsAnalyticsController.CurrentSession, { path: '/' });
                        FsAnalyticsController.PageView(website);
                        FsPhoneController.SetPhoneRoutes(website);
                        FsAnalyticsController.FormView(website);
                        FsAnalyticsController.FormUpdate(website);
                    });
                });
            }
            else
            {
                 var arg = {
                    action: "process_visitor",
                    website: website,
                    visitor: FsAnalyticsController.CurrentVisitor,
                    request: jQuery(location).attr('href'),
                    referer: jQuery(document).prop("referrer"),
                    google_cid: ''
                };                
                jQuery.post(FsAnalyticsController.ClientHandler, arg, function(data){   
                    var obj = jQuery.parseJSON(data);
                    FsAnalyticsController.CurrentVisitor = obj.visitor;
                    jQuery.cookie('FsVisitorId', FsAnalyticsController.CurrentVisitor, { expires: 365, path: '/' });
                    FsAnalyticsController.CurrentSession = obj.session;
                    jQuery.cookie('FsSessionId', FsAnalyticsController.CurrentSession, { path: '/' });
                    FsAnalyticsController.PageView(website);
                    FsPhoneController.SetPhoneRoutes(website);
                    FsAnalyticsController.FormView(website);
                    FsAnalyticsController.FormUpdate(website);
                });
            }  
        }
        else
        {
            FsAnalyticsController.PageView(website);
            FsPhoneController.SetPhoneRoutes(website);
            FsAnalyticsController.FormView(website);
            FsAnalyticsController.FormUpdate(website);
        }
    };
    
    this.PageView = function (website) {
        if(typeof(ga) !== 'undefined')
        {
            ga(function(tracker) {
                var google_cid = tracker.get('clientId');   
                var arg = {
                    action: "process_page_view",
                    website: website,
                    visitor: FsAnalyticsController.CurrentVisitor,  
                    session: FsAnalyticsController.CurrentSession,  
                    request: jQuery(location).attr('href'),
                    referer: jQuery(document).prop("referrer"),
                    google_cid: google_cid
                };
                jQuery.post(FsAnalyticsController.ClientHandler, arg, function(data){                
                    //alert(data);
                });                
            });
        }
        else
        {
            var arg = {
                action: "process_page_view",
                website: website,
                visitor: FsAnalyticsController.CurrentVisitor, 
                session: FsAnalyticsController.CurrentSession, 
                request: jQuery(location).attr('href'),
                referer: jQuery(document).prop("referrer"),
                google_cid: ''
            };
            jQuery.post(FsAnalyticsController.ClientHandler, arg, function(data){                
                //alert(data);
            });
        }
    };
    this.FormView = function(website) {
        jQuery("form.fs-form").each(function(){
            var form = jQuery(this).data("form");
            var arg = {
                action: "process_form_view",
                website: website,
                visitor: FsAnalyticsController.CurrentVisitor,
                session: FsAnalyticsController.CurrentSession, 
                form: form
            };
            jQuery.post(FsAnalyticsController.ClientHandler, arg, function(data){                
                //alert(data);
            });
        });
        
    };
    
    this.FormUpdate = function(website) {
        jQuery("input.fs-input, textarea.fs-input").change(function(){
           var field = jQuery(this).data("field");
           var value = jQuery(this).val();
           var arg = {
                action: "process_form_update",
                website: website,
                visitor: FsAnalyticsController.CurrentVisitor,
                session: FsAnalyticsController.CurrentSession, 
                field: field,
                value: value
            };
            jQuery.post(FsAnalyticsController.ClientHandler, arg, function(data){                
                //alert(data);
            });
        });
    };
    
    
    
    
};
