
jQuery(document).ready(function( $ ) {

	var $i = $(window.top.document).find( '#mm-breakpoint' );
	var $m;

	window.mmenu.breakpoint = function( menu, callback, callbackFail )
	{
		if ( !menu )
		{
			return;
		}

		try
		{
			$m = $(menu)
				.show()
				.children( 'ul, ol, div' )
				.first();

			if ( $m.length )
			{
				decreaseWidth( 1000, callback, callbackFail );
			}
		}
		catch( err ) {}
	}

	function decreaseWidth( w, callback, callbackFail )
	{
		$i.width( w );
		if ( w < 300 )
		{
			return;
		}
		
		if ( !$m.is( ':visible' ) )
		{
			$m.parent().hide();
			callback( w + 1 );
		}
		else
		{
			setTimeout(
				function()
				{
					decreaseWidth( w - 1, callback, callbackFail );
				}, 1
			);
		}
	}

});