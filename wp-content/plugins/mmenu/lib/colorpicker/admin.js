jQuery(document).ready(function( $ ) {

	var old_theme = '',
		new_theme = '';
	
	var $inpt = $('#mm_menu_backgroundcolor'),
		$hidn = $('#mm_menu_theme');

	function setTheme()
	{
		var v = $inpt.val();
		if ( v && v.length == 7 && v.slice( 0, 1 ) == '#' )
		{
			var r = parseInt( v.slice( 1, 3 ), 16 ),
				g = parseInt( v.slice( 3, 5 ), 16 ),
				b = parseInt( v.slice( 5, 7 ), 16 ),
				t = r + g + b;

			var new_theme = 'light';
			if ( t < 64 )
			{
				new_theme = 'black';
			}
			else if ( t > ( 255 * 3 ) - 16 )
			{
				new_theme = 'white';
			}
			else if ( r + g + b < 255 * 3 / 2 )
			{
				new_theme = 'dark';
			}

			if ( new_theme != old_theme )
			{
				$hidn
					.val( new_theme );

				$inpt
					.closest( '.wp-picker-container' )
					.removeClass( old_theme )
					.addClass( new_theme );

				old_theme = new_theme;
			}
		}
	}

	$inpt.wpColorPicker({
	    defaultColor: '#f3f3f3',
	    palettes: false,
	    change: setTheme
	});

	setTheme();

});