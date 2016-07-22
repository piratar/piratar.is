
jQuery(document).ready(function( $ ) {

	var $inp = $('input, select, textarea');
	$inp.on( 'change.edited',
			function( e )
			{
				$inp.off( 'change.edited' );
				$('body').addClass( 'edited' );
			}
		);

});