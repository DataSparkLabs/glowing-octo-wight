/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
jQuery(document).ready(function(){
    jQuery(".fs-date-row input").datepicker();
    jQuery("a.fs-form-submit").click(function(){
       var form = jQuery(this).data("form");
       jQuery("form.fs-form[data-form='"+form+"']").submit();
       return false;
    });
    jQuery("div.fs-form-loader").progressbar({
        value: false
    });
    jQuery("div.fs-scheduler-slots-loader").progressbar({
        value: false
    });
    jQuery("div.fs-scheduler-calendar").datepicker({
        numberOfMonths: 3,
        onSelect: function(dateText, inst) {
            var parent = jQuery(this).parents(".fs-scheduler-container");
            fs_load_scheduler_slots(dateText, parent);
        }
    });
    jQuery("form.fs-form").each(function(){
        jQuery(this).validate({        
            submitHandler: function(form) {
                var form_id = jQuery(form).data("form");
                jQuery(form).ajaxSubmit({
                    target: ".fs-form-result[data-form='"+form_id+"']",                            
                    beforeSubmit: function() {
                        jQuery("a.fs-form-submit[data-form='"+form_id+"']").hide();
                        jQuery(".fs-form-loader[data-form='"+form_id+"']").slideDown();
                    },
                    success: function() {
                        jQuery(".fs-form-loader[data-form='"+form_id+"']").slideUp(400, function(){
                            window.location.href = jQuery(form).find(".fs-redirect").val();
                            //jQuery("a.fs-form-submit[data-form='"+form_id+"']").show();
                        });

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        jQuery("a.fs-form-submit[data-form='"+form_id+"']").show();
                        jQuery(".fs-form-loader[data-form='"+form_id+"']").hide();
                        jQuery(".fs-form-result[data-form='"+form_id+"']").html(jqXHR.status+"<br/>"+jqXHR.statusText);
                  }
                });
            }
        });
    });
//    jQuery(".fs-scheduler-container").each(function(){
//        fs_load_scheduler_slots(jQuery(this).find(".fs-scheduler-calendar").datepicker( "getDate" ), this);
//    });
    
});
function fs_load_scheduler_slots(date, parent)
{
    jQuery(parent).find(".fs-scheduler-slots-loader").slideDown();
    jQuery(parent).find(".fs-scheduler-slots").html('');
    var arg = {
        action: "load_scheduler_slots",
        calendar: jQuery(parent).data("calendar"),
        date: date
    };
    jQuery.post(FsFormView.FsAjax, arg, function(data){                        
        jQuery(parent).find(".fs-scheduler-slots-loader").slideUp(400, function(){
            jQuery(parent).find(".fs-scheduler-slots").html(data);
            jQuery(parent).find("a.fs-scheduler-slot").click(function() {
                var check = jQuery(this).find("input");
                if(jQuery(this).hasClass("fs-active-scheduler-slot"))
                {
                    jQuery(this).removeClass('fs-active-scheduler-slot');   
                    jQuery(check).prop('checked', false);
                }
                else
                {
                    jQuery(this).addClass('fs-active-scheduler-slot');
                    jQuery(check).prop('checked', true);
                }
                return false;
            });             
        });
    });
}
