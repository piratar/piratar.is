jQuery(document).ready(function( $ ) {

	$('.combobox')
		.find( 'select' )
		.on( 'change.mm-combobox',
			function( e )
			{
				$(this)
					.closest( '.combobox' )
					.find( 'input' )
					.val( $(this).val() )
					.trigger( 'change' );

				$(this).val( '' );
			}
		);

});