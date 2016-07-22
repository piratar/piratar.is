jQuery(document).ready(function( $ ) {

	$('.buttons')
		.each(
			function()
			{
				var $head = $(this).find( '.buttons-head' ),
					$btns = $(this).find( '.buttons-button' ),
					$foot = $(this).find( '.buttons-foot' ),
					$dsms = $btns.find( '.dashicons-no' ),
					$addb = $foot.find( '.button' );

				$addb
					.on( 'click',
						function( e )
						{
							e.preventDefault();

							$head.show();
							$btns
								.filter( ':hidden' )
								.first()
								.show()
								.find( 'input, select' )
								.prop( 'disabled', false );

							if ( $btns.filter( ':hidden' ).length == 0 )
							{
								$addb.hide();
							}
						}
					);

				$dsms
					.on( 'click',
						function( e )
						{
							e.preventDefault();

							$addb.show();
							$(this)
								.closest( '.buttons-button' )
								.hide()
								.find( 'input, select' )
								.prop( 'disabled', true );

							if ( $btns.filter( ':visible' ).length == 0 )
							{
								$head.hide();
							}
						}
					);

				$btns
					.each(
						function()
						{
							if ( $(this).find( 'input[type="hidden"]' ).val() == '' )
							{
								$(this)
									.closest( '.buttons-button' )
									.find( '.dashicons-no' )
									.trigger( 'click' );
							}
							else
							{
								$(this)
									.closest( '.buttons-button' )
									.find( 'input, select' )
									.prop( 'disabled', false );
							}
						}
					);
			}
		);

});