<?php
/**
 * Customizer custom controls
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */


if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

//Custom control for horizontal line
class Elead_Customize_Horizontal_Line extends WP_Customize_Control {
	public $type = 'hr';

	public function render_content() {
		?>
		<div>
			<hr style="border: 1px dotted #72777c;" />
		</div>
		<?php
	}
}


//Custom control for any note, use label as output description
class Elead_Note_Control extends WP_Customize_Control {
	public $type = 'description';

	public function render_content() {
		echo '<h2 class="description">' . $this->label . '</h2>';
	}
}