
function fsi_prep_validator()
{
    jQuery.validator.methods.fsi_required = function(value, element) {
        if(jQuery(element).attr("title") == undefined)
        {
            return value.length > 0;
        }
        else
        {
            return value != jQuery(element).attr("title");
        }
    };
}
function fsi_init_form_titles(form_id)
{
    jQuery('#'+form_id+' input[type="text"][title], #'+form_id+' textarea[title]').each(function(){ 
        if(jQuery(this).val() == '')
        {
            this.value = jQuery(this).attr('title');
            jQuery(this).addClass('text-label');
        }
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
}
jQuery(document).ready(function(){
    jQuery.cacheImage(FsiGlobal.FsiUrl+'LeadTracking/images/loader.gif');
});