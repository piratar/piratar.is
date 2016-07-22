jQuery(document).ready(
	function( $ )
	{
		if ( !$('body').is( ':visible' ) )
		{
			return;
		}


		var setup = window.location.search.slice( 1 ).split( '&' );
		var $_GET = {};
		for ( var s = 0, l = setup.length; s < l; s++ )
		{
			var a = setup[ s ].split( '=' );
			$_GET[ a[ 0 ] ] = a[ 1 ];
		}

		var find = {
			menu: function()
			{
				var $menus = $body
					.find( '.nav-menu' )
					.filter( 'nav, div' );

				$menus = $menus
					.add(
						$body
							.find( '[class^="menu-"], [class*=" menu-"]' )
							.filter( '[class$="-container"], [class*="-container "]' )
					);

				$menus = $menus
					.add(
						$body
							.find( 'ul, ol' )
							.parent()
							.not( 'li' )
					);

				return $menus;
			},
			button: function()
			{
				var $buttons = $body
					.find( '.menu-toggle, .secondary-toggle' )
					.filter( 'a, button' );

				$buttons = $buttons.add( $body.find( 'a, button' ).filter( '[id]' ) );

				find.menu()
					.each(
						function()
						{
							var id = $(this).attr( 'id' ) || false;
							if ( id )
							{
								$buttons = $buttons.add( '[href="#' + id + '"]' );
							}
						}
					);

				return $buttons;
			},
			anchors: function()
			{
				$anchors = $body
					.find( 'a' )
					.filter( '[href]' );

				return $anchors;
			}
		};

		function highlight( $elems )
		{
			$elems
				.each(
					function()
					{
						var $e = $(this),
							$h = $('<span class="mmenu-highlight" data-selector="' + $e.attr( 'data-selector' ) + '" title="Click to select"><span class="dashicons dashicons-yes"></span></span>');

						if ( $e.is( 'button' ) )
						{
							$e = $e.parent();
						}

						$h.appendTo( $e );

						switch( $e.css( 'position' ) )
						{
							case 'absolute':
							case 'fixed':
							case 'relative':
								break;

							default:
								$e.css( 'position', 'relative' );
								break;
						}
					}
				);
		}
		function filllist( $elems )
		{
			var itms = '',
				type = single ? 'radio' : 'checkbox';

			$elems
				.each(
					function()
					{

						var sl = $(this).attr( 'data-selector' );
						itms += '<li>'
							 +  '<span>' + sl + '</span>'
							 +  '<input data-selector="' + sl + '" type="' + type + '" class="Toggle" name="locate" />'
							 +  '</li>';
					}
				);

			if ( !itms.length )
			{
				itms = '<li><span><em>Sorry, no elements found.</em></span></li>';
			}

			window.top.mmenu.locateList.fill( itms );
		}
		function filter( $elems )
		{
			var arr = {};
			return $elems
				.filter(
					function()
					{
						var $e = $(this);

						var id = $e.attr( 'id' ) || false,
							cl = $e.attr( 'class' ) || false,
							sl = ( id ) ? '#' + id : ( cl ) ? '.' + cl.split( ' ' ).join( '.' ) : false;

						if ( cl && cl.indexOf( 'screen-reader-' ) != -1 )
						{
							return false;
						}
						if ( !sl || arr[ sl ] )
						{
							return false;
						}
						arr[ sl ] = true;

						$e.attr( 'data-selector', sl );
						return true;
					}
				);
		}


		var $wndw = $(window),
			$html = $('html'),
			$body = $('body'),
			$both = $html.add( $body );

		$body.removeClass( 'admin-bar' );

		var type 	= $_GET[ 'locate' ],
			single	= false;


		//	Find the elements
		switch( type )
		{
			case 'menu':
				single = true;
				break;
		}
		var $elems = find[ type ]();
			$elems = filter( $elems );

		highlight( $elems );
		filllist( $elems );

		window.top.mmenu.locateList.single = single;


		var $high = $('.mmenu-highlight');
		$high
			.on( 'click',
				function( e )
				{
					window.top.mmenu.locateList.toggle( this );
				}
			)
			.parent()
			.off( 'click mousedown mouseup' )
			.add( $high )
			.on( 'click mousedown mouseup',
				function( e )
				{
					e.preventDefault();
					e.stopImmediatePropagation();
					return false;
				}
			);

	}
);