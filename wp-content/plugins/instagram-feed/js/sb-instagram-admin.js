jQuery(document).ready(function($) {

	//Autofill the token and id
	var hash = window.location.hash,
        token = hash.substring(14),
        id = token.split('.')[0];
    //If there's a hash then autofill the token and id
    if(hash){
        $('#sbi_config').append('<div id="sbi_config_info"><p><b>Access Token: </b><input type="text" size=58 readonly value="'+token+'" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."></p><p><b>User ID: </b><input type="text" size=12 readonly value="'+id+'" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."></p><p><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp; <b><span style="color: red;">Important:</span> Copy and paste</b> these into the fields below and click <b>"Save Changes"</b>.</p></div>');
    }
	
	//Tooltips
	jQuery('#sbi_admin .sbi_tooltip_link').click(function(){
		jQuery(this).siblings('.sbi_tooltip').slideToggle();
	});

	//Shortcode labels
	jQuery('#sbi_admin label').click(function(){
    var $sbi_shortcode = jQuery(this).siblings('.sbi_shortcode');
    if($sbi_shortcode.is(':visible')){
      jQuery(this).siblings('.sbi_shortcode').css('display','none');
    } else {
      jQuery(this).siblings('.sbi_shortcode').css('display','block');
    }  
  });
  jQuery('#sbi_admin label').hover(function(){
    if( jQuery(this).siblings('.sbi_shortcode').length > 0 ){
      jQuery(this).attr('title', 'Click for shortcode option').append('<code class="sbi_shortcode_symbol">[]</code>');
    }
  }, function(){
    jQuery(this).find('.sbi_shortcode_symbol').remove();
  });


  //Add the color picker
	if( jQuery('.sbi_colorpick').length > 0 ) jQuery('.sbi_colorpick').wpColorPicker();

	//Check User ID is numeric
	jQuery("#sb_instagram_user_id").change(function() {

		var sbi_user_id = jQuery('#sb_instagram_user_id').val(),
			$sbi_user_id_error = $(this).closest('td').find('.sbi_user_id_error');

		if (sbi_user_id.match(/[^0-9, _.-]/)) {
  			$sbi_user_id_error.fadeIn();
  		} else {
  			$sbi_user_id_error.fadeOut();
  		}

	});

	//Mobile width
	var sb_instagram_feed_width = jQuery('#sbi_admin #sb_instagram_width').val(),
			sb_instagram_width_unit = jQuery('#sbi_admin #sb_instagram_width_unit').val(),
			$sb_instagram_width_options = jQuery('#sbi_admin #sb_instagram_width_options');

	if (typeof sb_instagram_feed_width !== 'undefined') {

		//Show initially if a width is set
		if( (sb_instagram_feed_width.length > 1 && sb_instagram_width_unit == 'px') || (sb_instagram_feed_width !== '100' && sb_instagram_width_unit == '%') ) $sb_instagram_width_options.show();

		jQuery('#sbi_admin #sb_instagram_width, #sbi_admin #sb_instagram_width_unit').change(function(){
			sb_instagram_feed_width = jQuery('#sbi_admin #sb_instagram_width').val();
			sb_instagram_width_unit = jQuery('#sbi_admin #sb_instagram_width_unit').val();

			if( sb_instagram_feed_width.length < 2 || (sb_instagram_feed_width == '100' && sb_instagram_width_unit == '%') ) {
				$sb_instagram_width_options.slideUp();			
			} else {
				$sb_instagram_width_options.slideDown();
			}
		});

	}

	//Scroll to hash for quick links
  jQuery('#sbi_admin a').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = jQuery(this.hash);
      target = target.length ? target : this.hash.slice(1);
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });

});