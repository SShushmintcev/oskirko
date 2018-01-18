function  getSorry(){
    alert("You use free version!");
}
function sorryChange(){
    alert("You use free version!");
}
jQuery(document).ready(function () {
    
    //####### JOOMLA UNIQUE ADMIN STYLES 
    jQuery('.options-block-title').parents('.control-group').addClass('options-block-title-wrapper');
    jQuery('.options-block-title-wrapper').eq(0).addClass('first');
	var viewbutton=jQuery('#view-style-block');
    viewbutton.parents('.control-group').css({'display':'none'});
    var prevparent=viewbutton.parents('.control-group').prev();
    prevparent.append(viewbutton);
   
   
   
   
    popupsizes(jQuery('#jform_params_light_box_size_fix'));
	function popupsizes(checkbox){
			if(checkbox.is(':checked')){                           
				jQuery('.not-fixed-size').parents('.control-group').css({'display':'none'});
				jQuery('.fixed-size').parents('.control-group').css({'display':'block'});
			}else {
				jQuery('.fixed-size').parents('.control-group').css({'display':'none'});
				jQuery('.not-fixed-size').parents('.control-group').css({'display':'block'});
			}
		}
	jQuery('#jform_params_light_box_size_fix').change(function(){
		popupsizes(jQuery(this));
	});  
        jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		 jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		 jQuery(this).val(parseInt(data.value));
	});
});
jQuery(document).ready(function () {
	
	
	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		 jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		 jQuery(this).val(parseInt(data.value));
	});	
	
        
	jQuery('#view-style-block ul li[data-id="'+jQuery('#jform_params_light_box_style option[selected]').val()+'"]').addClass('active');
	
	jQuery('#jform_params_light_box_style').change(function(){
		var strtr = jQuery(this).val();
		jQuery('#view-style-block ul li').removeClass('active');
		jQuery('#view-style-block ul li[data-id="'+strtr+'"]').addClass('active');
	});
});