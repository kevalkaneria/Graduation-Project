<?php
/**
 * Custom Info Widget
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */

if ( ! class_exists( 'Elead_Custom_Info_Widget' ) ) :
/**
 * Custom Info class.
 *
 * @since 1.0
 */
class Elead_Custom_Info_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_call_to_action',
			'description' => esc_html__( 'A widget to show basic informations with icons.', 'elead' ),
		);
		parent::__construct( 'custom_info_widget', esc_html__( 'TP : Custom Info', 'elead' ), $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		echo $args['before_widget'];
			if ( ! empty( $title ) ) {
				echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
			}


		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2; ?>
		<ul>
			<?php
			for ( $i=1; $i <= $number ; $i++ ) {
				$contact_value = ( ! empty( $instance['contact_value' . '-' . $i] ) ) ? $instance['contact_value' . '-' . $i] : '';
				$second_contact_value = ( ! empty( $instance['second_contact_value' . '-' . $i] ) ) ? $instance['second_contact_value' . '-' . $i] : '';
				$icon = ( ! empty( $instance['icon' . '-' . $i] ) ) ? $instance['icon' . '-' . $i] : ''; ?>

	         <li>
	         	<i class="fa <?php echo esc_attr( $icon );?>"></i>
	         	<?php if( ! empty( $contact_value ) ) : ?>
	         		<span class="first"><?php echo esc_html( $contact_value );?></span>
	         	<?php endif; 
	         	if( ! empty( $second_contact_value ) ) : ?>
	         		<span class="last"><?php echo esc_html( $second_contact_value );?></span>
	         	<?php endif; ?>
     		</li>
			<?php } ?>
     </ul>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
		$title     = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
	   ?>

	   <p>
		   <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php esc_html_e( 'Title:', 'elead' ); ?></label>
		   <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	   </p>

	   <p>
	   	<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of fields to show:', 'elead' ); ?></label>
	   	<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo absint( $number ); ?>" size="3" />
	   </p>
	   <?php for ( $i=1; $i <= $number; $i++ ) {
	   	$icon_selected = isset( $instance['icon'. '-' . $i ] ) ? $instance['icon' . '-' . $i ] : '';?>
		   <p>
		   	<label for="<?php echo esc_attr( $this->get_field_id( 'icon' . '-' . $i ) ); ?>"><?php printf( esc_html__( 'Select Icon %s :', 'elead' ), $i ); ?></label>

		   	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' . '-' . $i ) ); ?>" placeholder="fa-archive" name="<?php echo esc_attr( $this->get_field_name( 'icon' . '-' . $i ) ); ?>" type="text" value="<?php echo esc_attr( $icon_selected ); ?>" />
		   	<small><?php printf( __( 'Get the icon codes %1$shere%2$s.', 'elead' ), '<a href="' . esc_url( 'http://fontawesome.io/icons/' ) .'" target="_blank">', '</a>' );?></small>
		   </p>
		   <?php $contact_value = ! empty( $instance['contact_value'. '-' . $i] ) ? $instance['contact_value' . '-' . $i] : '';?>
		   <p>
		   	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_value' . '-' . $i ) ) . '-' . $i; ?>"><?php printf( esc_html__( 'First Info %s :', 'elead' ), $i ); ?></label>
		   	<input type="text" class="widefat" rows="2" cols="10" id="<?php echo esc_attr( $this->get_field_id('contact_value' . '-' . $i ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('contact_value' . '-' . $i) ); ?>" value="<?php echo esc_html( $contact_value ); ?>">
		   </p>
		   <?php $second_contact_value = ! empty( $instance['second_contact_value'. '-' . $i] ) ? $instance['second_contact_value' . '-' . $i] : '';?>
		   <p>
		   	<label for="<?php echo esc_attr( $this->get_field_id( 'second_contact_value' . '-' . $i ) ) . '-' . $i; ?>"><?php printf( esc_html__( 'Second Info %s :', 'elead' ), $i ); ?></label>
		   	<input type="text" class="widefat" rows="2" cols="10" id="<?php echo esc_attr( $this->get_field_id('second_contact_value' . '-' . $i ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('second_contact_value' . '-' . $i) ); ?>" value="<?php echo esc_html( $second_contact_value ); ?>">
		   </p>
		   <hr>
	   <?php }?>

	   <?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		for ( $i=1; $i <= $instance['number'] ; $i++ ) {
			$instance['icon' . '-' . $i] = esc_attr( $new_instance['icon' . '-' . $i] );

			if ( current_user_can( 'unfiltered_html' ) ) {
				$instance['contact_value' . '-' . $i] = $new_instance['contact_value' . '-' . $i];
				$instance['second_contact_value' . '-' . $i] = $new_instance['second_contact_value' . '-' . $i];
			} else {
				$instance['contact_value' . '-' . $i] = wp_kses_post( $new_instance['contact_value' . '-' . $i] );
				$instance['second_contact_value' . '-' . $i] = wp_kses_post( $new_instance['second_contact_value' . '-' . $i] );
			}
		}
		return $instance;
	}
}

endif;


function elead_register_custom_info_widget() {
	register_widget( 'Elead_Custom_Info_Widget' );
}
add_action( 'widgets_init', 'elead_register_custom_info_widget' );