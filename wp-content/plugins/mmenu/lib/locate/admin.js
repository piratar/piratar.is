
jQuery(document).ready(function( $ ) {


	/*
		Locate comboboxes
	*/
	(function() {
		function fillCombobox( $elems, name, locations )
		{
			var $selc = $('#' + name + '_select'),
				_opts = {};

			$elems
				.each(
					function()
					{
						var id = $(this).attr( 'id' ) || false,
							cl = $(this).attr( 'class' ) || false,
							sl = ( id ) ? '#' + id : ( cl ) ? '.' + cl.split( ' ' ).join( '.' ) : false;

						if ( sl && typeof _opts[ sl ] == 'undefined' )
						{
							_opts[ sl ] = true;
							var op = '<option value="' + sl + '">' + sl + '</option>';
							$selc.append( op );
						}
					}
				);

			if ( $selc.children().length )
			{
				$selc
					.prepend( '<option value="" selected />' )
					.closest( '.combobox' )
					.addClass( 'is-combobox' );
			}
		}


		//	Find the menu and the menu button
		window.mmenu.website_html_callbacks.push(
			function( html )
			{

				//	Find menu(s)
				var $menus = $(html)
					.find( '.nav-menu' )
					.filter( 'nav, div' );

				$menus = $menus.add(
					$(html)
						.find( '[class^="menu-"], [class*=" menu-"]' )
						.filter( '[class$="-container"], [class*="-container "]' )
				);


				//	Find button(s)
				var $buttons = $(html)
					.find( '.menu-toggle, .secondary-toggle' )
					.filter( 'a, button' );

				$menus
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


				//	Add to select
				fillCombobox( $menus, 'menu' );
				fillCombobox( $buttons, 'button' );
			}
		);
	})();




	/*
		Locate popup
	*/
	(function() {
		var $body	= $('body'),
			$locate = $('#locate-content'),
			$menu 	= $('#locate-menu'),
			$list 	= $('#locate-list'),
			$types  = $locate.find( '.type' ),
			$iframe = $locate.find( 'iframe' );

		var _type = null,
			$inpt = $();


		window.mmenu.locateList = {
			fill: function( itms )
			{
				$list.html( itms );
				_menu.init( $list.parent() );

				$list
					.find( 'label.mm-toggle' )
					.off( 'click mousedown mouseup' )
					.on( 'click',
						function( e )
						{
							window.mmenu.locateList.toggle( $('#' + $(this).attr( 'for' ) )[ 0 ] );
							
							e.preventDefault();
							e.stopImmediatePropagation();
							return false;
						}
					);
			},
			toggle: function( node )
			{
				var $inpt = $list.find( 'input.mm-toggle[data-selector="' + $(node).attr( 'data-selector' ) + '"]' ),
					chckd = $inpt.is( ':checked' );

				$inpt.prop( 'checked', !chckd );

				var $high = $iframe
					.contents()
					.find( '.mmenu-highlight' )
					.removeClass( 'selected' );

				$list
					.find( 'input.mm-toggle' )
					.filter( ':checked' )
					.each(
						function()
						{
							$high
								.filter( '[data-selector="' + $(this).attr( 'data-selector' ) + '"]' )
								.addClass( 'selected' );
						}
					);
			}
		};

		$menu.mmenu({
			extensions: [ 'theme-black' ],
			offCanvas: false,
			navbar: {
				title: ''
			},
			navbars: [{
				content: [ 
					'<a href="#" class="dashicons dashicons-no"></a>', 
					'<a href="#" class="dashicons dashicons-smartphone"></a>',
					'<a href="#" class="dashicons dashicons-tablet"></a>',
					'<a href="#" class="dashicons dashicons-desktop"></a>', 
					'<a href="#" class="button done">Save</a>' ]
			}]
		});
		var _menu = $menu.data( 'mmenu' );

		$('.button.locate')
			.on( 'click',
				function( e )
				{
					e.preventDefault();
					$body.addClass( 'locate' );

					_type = $(this).data( 'type' );
					$inpt = $(this).parent().find( 'input' );

					$types.html( _type );
					$list.empty();
					$iframe.attr( 'src', window.mmenu.home_url + '?mmenu=locate&locate=' + _type );
				}
			);

		$('#locate-menu')
			.find( '.mm-navbar' )
			.find( '.dashicons' )
			.on( 'click',
				function( e )
				{
					e.preventDefault();
					$locate.attr( 'class', $(this).attr( 'class' ).split( 'dashicons-' )[ 1 ] );
				}
			);

		$locate
			.find( '.dashicons-no' )
			.on( 'click',
				function( e )
				{
					e.preventDefault();
					tb_remove();
					setTimeout(function() {
						$body.removeClass( 'locate' );
					}, 500);
				}
			);

		$locate
			.find( '.done' )
			.on( 'click',
				function( e )
				{
					e.preventDefault();

					var sl = [];
					$list
						.find( 'input.mm-toggle' )
						.filter( ':checked' )
						.each(
							function()
							{
								sl.push( $(this).attr( 'data-selector' ) );
							}
						);

					$inpt
						.val( sl.join(', ') )
						.trigger( 'change.mm' );

					tb_remove();
					setTimeout(function() {
						$body.removeClass( 'locate' );
					}, 500);
				}
			);
	})();

});