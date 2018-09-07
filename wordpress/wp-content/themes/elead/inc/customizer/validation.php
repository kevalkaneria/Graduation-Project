<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage Elead
* @since Elead 0.1
*/

if ( ! function_exists( 'elead_validate_post_id' ) ) :
    function elead_validate_post_id( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'elead' ) );
        } elseif ( $value < 1 ) {
            $validity->add( 'min_value', esc_html__( 'Minimum value is 1', 'elead' ) );
        } 
        return $validity;
    }
endif;