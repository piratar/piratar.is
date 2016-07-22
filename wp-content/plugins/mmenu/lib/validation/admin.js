
jQuery(document).ready(function( $ ) {

	var $m = $('#mm_setup_menu'),
		$b = $('#mm_setup_button');


	//	Validate on change
	$m.add( $b )
		.attr( 'required', 'required' )
		.on( 'change.mm',
			function( e )
			{

				var $tr = $(this).closest( 'tr' ),
					val = $(this).val();

				if ( val.length && window.mmenu.website_html )
				{
					try
					{
						switch( $(window.mmenu.website_html).find( val ).length )
						{
							case 0:
								$tr.removeClass( 'warning' );
								$tr.addClass( 'error' );
								break;

							case 1:
								$tr.removeClass( 'warning' );
								$tr.removeClass( 'error' );
								break;

							default:
								$tr.addClass( 'warning' );
								$tr.removeClass( 'error' );
								break;
						}
					}
					catch( err )
					{
						$tr.removeClass( 'warning' );
						$tr.addClass( 'error' );
					}
				}
				else
				{
					$tr.removeClass( 'warning' );
					$tr.removeClass( 'error' );
				}
			}
		);

	//	Validate on page load
	window.mmenu.website_html_callbacks.push(
		function()
		{
			$m.add( $b ).trigger( 'change.mm' );
		}
	);

	//	Dissmiss invalid warning/error
	$('.button.dismiss')
		.on( 'click',
			function( e ) 
			{
				e.preventDefault();

				$(this)
					.closest( 'tr' )
					.removeClass( 'warning' )
					.removeClass( 'error' );
			}
		);

});