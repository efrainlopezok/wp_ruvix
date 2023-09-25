<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/genesis/
 */

?>
<table class="form-table">
<tbody>

	<tr valign="top">
		<th scope="row"><?php esc_html_e( 'Select Default Layout', 'genesis' ); ?></th>
		<td>
			<fieldset class="genesis-layout-selector">
			<legend class="screen-reader-text"><?php esc_html_e( 'Default Layout', 'genesis' ); ?></legend>

			<?php
			genesis_layout_selector( array(
				'name'     => $this->get_field_name( 'site_layout' ),
				'selected' => $this->get_field_value( 'site_layout' ),
				'type'     => array( 'site' ),
			) );
			?>

			</fieldset>
			<br class="clear" />
		</td>
	</tr>

</tbody>
</table>
