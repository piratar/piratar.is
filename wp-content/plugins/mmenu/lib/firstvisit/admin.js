jQuery(document).ready(function( $ ) {

	if ( !$('.wrap.mmenu-setup').length )
	{
		return;
	}

	function showNextSection()
	{
		$sections
			.filter( '.show' )
			.last()
			.addClass( 'typed' );

		var $s = $sections
			.not( '.show' )
			.first()
			.addClass( 'show' );

		setTimeout(
			function()
			{
				$s.addClass( 'fade' );
			}, 100
		);

		if ( $s[ 0 ] == $sections.last()[ 0 ] )
		{
			$('p.submit').addClass( 'proceed' );
		}
	}

	var $sections = $('.section');
	showNextSection();

	$('.button.next')
		.on( 'click',
			function( e )
			{
				e.preventDefault();
				showNextSection();
			}
		);

	$sections
		.find( 'input' )
		.on( 'input propertychange',
			function( e )
			{
				$(this)
					.closest( '.section' )
					.addClass( 'typed' );
			}
		);

});