
jQuery(document).ready(function( $ ) {

	window.mmenu.website_html = '',
	window.mmenu.website_html_callbacks = [];

	if ( window.mmenu.home_url )
	{
		$.ajax( window.mmenu.home_url )
			.success(
				function( html )
				{
					window.mmenu.website_html = html;
					for ( var w = 0; w < window.mmenu.website_html_callbacks.length; w++ )
					{
						window.mmenu.website_html_callbacks[ w ]( window.mmenu.website_html );
					}
				}
			);
	}

});