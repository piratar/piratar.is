jQuery(document).ready(function( $ ) {

	if ( window.mmenu.home_url )
	{
		var $menu = $('#mm_setup_menu'),
			$optg = $('#theme_breakpoints_list'),
			$cbbx = $optg.closest( '.combobox' ),
			$ifrm = $('<iframe src="' + window.mmenu.home_url + '?mmenu=breakpoint" id="mm-breakpoint" />').appendTo( 'body' ),
			cwndw = $ifrm[ 0 ].contentWindow;

		var find_counter = 0;

		function find_breakpoint()
		{
			var val = $menu.val() || '';
			$optg.removeClass( 'filled' );

			if ( typeof cwndw.mmenu != 'undefined' && typeof cwndw.mmenu.breakpoint != 'undefined' )
			{
				cwndw.mmenu.breakpoint( val,
					function( w )
					{
						$optg
							.addClass( 'filled' )
							.html( '<option value="' + w + 'px">' + w + 'px</options>' );
					}
				);
			}
			else if ( find_counter < 10 )
			{
				find_counter++;
				setTimeout( find_breakpoint, 500 );
			}
		}

		$menu.on( 'change.mm-breakpoint', find_breakpoint );
		find_breakpoint();
	}

});