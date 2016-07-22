jQuery(document).ready(function( $ ) {

	var $choose = $('#mm_header_image_yes'),
		$header = $('<div class="header-image" />').prependTo( $choose.parent() ),
		$hidden = $('#mm_header_image_src'),
		$scale  = $('#mm_header_image_scale');

	$choose
		.on( 'click.mm',
			function( e )
			{
				e.stopPropagation();
				tb_show( 'Choose an image', 'media-upload.php?referer=mmenu-header-image&type=image&TB_iframe=true&post_id=0', false );
			}
		);

	$scale
		.on( 'change.mm',
			function( e )
			{
				if ( $scale.val() == 'cover' )
				{
					$header.addClass( 'cover' );
				}
				else
				{
					$header.removeClass( 'cover' );
				}
			}
		)
		.trigger( 'change.mm' );

    window.send_to_editor = function( html )
    {
    	var src = $('<div />').append( html ).find( 'img' ).attr( 'src' );
    	$hidden.val( src );
    	setImage( src );
	    tb_remove();
	}
	function setImage( src )
	{
		if ( src )
		{
    		$header.attr( 'style', 'background-image: url(' + src + ')' );
		}
		else
		{
			$header.removeAttr( 'style' );
		}
	}
	setImage( $hidden.val() );

});