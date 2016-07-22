
jQuery(document).ready(function( $ ) {

	$('.form-table')
		.find( '.radio-preview' )
		.each(
			function()
			{
				var $r = $(this);
				$r.find( 'input' )
					.on( 'change',
						function( e )
						{
							if ( $r.find( 'input' ).filter( ':checked' ).data( 'suboptions' ) == 'yes' )
							{
								$r.closest( '.section' )
									.addClass( 'checked' );
							}
							else
							{
								$r.closest( '.section' )
									.removeClass( 'checked' )
									.removeClass( 'geared' );
							}
						}
					)
					.trigger( 'change' );
			}
		)
		.end()
		.find( '.dashicons-admin-generic' )
		.on( 'click',
			function( e )
			{
				e.preventDefault();
				$(this).closest( '.section' )
					.toggleClass( 'geared' );
			}
		)
		.end()
		.find( '.dashicons-editor-help' )
		.on( 'click',
			function( e )
			{
				e.preventDefault();
				$(this).closest( '.section' )
					.toggleClass( 'explained' );
			}
		);

});