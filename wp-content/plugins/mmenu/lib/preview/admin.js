jQuery(document).ready(function( $ ) {

	$('a[href="#preview"]')
		.on( 'click',
			function( e )
			{
				e.preventDefault();
				$('input[name="preview"]')
					.click();
			}
		);

	$('.submit-preview')
		.find( 'a[href="#mmenu-settings"]' )
		.on( 'click',
			function( e )
			{
				e.preventDefault();
				$('.wrap.mmenu-preview')
					.removeClass( 'mmenu-preview' );
			}
		);

});