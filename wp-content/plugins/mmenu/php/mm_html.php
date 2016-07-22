<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


function is_session_started()
{
    if ( php_sapi_name() !== 'cli' )
    {
        if ( version_compare( phpversion(), '5.4.0', '>=' ) )
        {
            return session_status() === PHP_SESSION_ACTIVE ? true : false;
        }
        else
        {
            return session_id() === '' ? false : true;
        }
    }
    return false;
}

if ( !is_session_started() )
{
	session_start();
}



class MmHtml {

	protected function echo_title( $title, $class = '' )
	{
		echo '
		<h2 class="' . $class . '">' . $title . '</h2>';
	}
	protected function echo_updated( $text )
	{
		$this->echo_message( $text, 'updated' );
	}
	protected function echo_error( $text )
	{
		$this->echo_message( $text, 'error' );
	}
	protected function echo_message( $text, $class )
	{
		echo '
			<div class="' . $class . '">
				<p>' . $text . '</p>
			</div>';
	}

	protected function echo_form_opener( $id = '' )
	{
		if ( $id )
		{
			$id = ' id="' . $id . '"';
		}
		echo '
			<form' . $id . ' method="POST" action="options.php">';

		settings_fields( 'mmenu-settings' );
		do_settings_sections( 'mmenu-settings' );
	}

	protected function echo_section_opener( $class = '', $title = '' )
	{
		if ( strlen( $class ) > 0 )
		{
			$class = ' ' . $class;
		}
		echo '
					<div class="section' . $class . '">';

		if ( strlen( $title ) > 0 )
		{
			echo '
						<h2>' . $title . '</h2>';
		}
	}
	protected function echo_form_table_opener( $class = '' )
	{
		if ( strlen( $class ) > 0 )
		{
			$class = ' ' . $class;
		}
		echo '
						<table class="form-table' . $class . '">';
	}
	protected function echo_form_table_row( $th, $td, $class = null, $caret = false )
	{
		$first = ( $th )
			? ''
			: ' class="empty"';

		$class = ( $class )
			? ' class="' . $class . '"'
			: '';

		$caret = ( $caret )
			? ( $caret === 'help' )
				? '<span class="dashicons dashicons-editor-help"></span>'
				: '<span class="dashicons dashicons-admin-generic"></span>'
			: '';

		echo '
							<tr' . $class . '>
								<th' . $first . '>' . $th . '</th>
								<td>' . $td . '</td>
								<td class="caret">' . $caret . '</td>
							</tr>';
	}

	protected function echo_table_row( $tds = array() )
	{
		$tr = '
							<tr>';

		foreach( $tds as $td )
		{
			$tr .= '
								<td>' . $td . '</td>';
		}

		$tr .= '
							</tr>';

		echo $tr;
	}
	protected function echo_form_table_closer()
	{
		echo '
						</table>';
	}
	protected function echo_section_closer()
	{
		echo '
					</div>';
	}

	protected function echo_form_closer()
	{
		echo '
			</form>';
	}
	
	protected function html_checkbox( $optn, $valu = 'yes', $type = 'checkbox' )
	{
		$v = $this->html_input_get_vars( $optn );
		$chck = ( $valu == $v[ 'value' ] );
		return '
			<input type="' . $type . '" name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '" value="' . $valu . '"' . ( $chck ? ' checked' : '' ) . ' />';
	}
	protected function html_input( $optn, $type = 'text', $extr = '' )
	{
		$v = $this->html_input_get_vars( $optn );
		return '
			<input type="' . $type . '" name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '" value="' . esc_attr( $v[ 'value' ] ) . '"' . ( $extr ? ' ' . $extr : '' ) . ' />';
	}
	protected function html_textarea( $optn )
	{
		$v = $this->html_input_get_vars( $optn );
		return '
			<textarea name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '">' . esc_attr( $v[ 'value' ] ) . '</textarea>';
	}
	protected function html_select( $optn, $opts )
	{
		$v = $this->html_input_get_vars( $optn );
		$html = '
			<select name="' . $v[ 'name' ] . '" id="' . $v[ 'id' ] . '">';
		
		foreach( $opts as $valu => $text )
		{
			$html .= '
				<option value="' . $valu . '"' . ( ( $valu == $v[ 'value' ] ) ? ' selected' : '' ) . '>' . $text . '</option>';
		}
		$html .= '
			</select>';

		return $html;
	}
	protected function html_radio_preview( $optn, $opts, $subs = false, $extra = '' )
	{
		$v = $this->html_input_get_vars( $optn );
		$html = '
			<div id="' . $v[ 'id' ] . '" class="radio-preview">';
		
		foreach( $opts as $valu => $text )
		{
			$id = $v[ 'id' ] . '_' . $valu;
			$html .= '
				<label for="' . $id . '">
					<div>
						<img src="' . plugins_url( '/img/' . $id . '.png', dirname( __FILE__ ) ) . '" />
						<input name="' . $v[ 'name' ] . '" value="' . $valu . '" id="' . $id . '"' . ( ( $valu == $v[ 'value' ] ) ? ' checked' : '' ) . ' type="radio"' . ( ( $subs && $valu == $subs ) ? ' data-suboptions="yes"' : '' ) . ' />
						' . $text . '
					</div>
				</label>';
		}
		$html .= $extra . '
			</div>';

		return $html;
	}
	private function html_input_get_vars( $optn )
	{
		return array(
			'id'	=> $optn[ 1 ] . '_' . $optn[ 2 ],
			'name' 	=> $optn[ 1 ] . '[' . $optn[ 2 ] . ']',
			'value'	=> !empty( $optn[ 0 ][ $optn[ 2 ] ] ) ? $optn[ 0 ][ $optn[ 2 ] ] : ''
		);
	}

	protected function html_pre( $code )
	{
		return '
<pre>' . str_replace( array( '<', '>' ), array( '&lt;', '&gt;' ), $code ) . '
</pre>';
	}
}
