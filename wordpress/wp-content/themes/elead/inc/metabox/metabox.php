<?php

/**
 * Elead metabox file.
 *
 * This is the template that includes all the other files for metaboxes of Elead theme
 *
 * @package Theme Palace
 * @subpackage Elead
 * @since Elead 0.1
 */ 

/**
 * Class to Renders and save metabox options
 *
 * @since Elead 0.1
 */
class Elead_MetaBox {
    private $meta_box;

    private $fields;

    /**
    * Constructor
    *
    * @since Elead 0.1
    *
    * @access public
    *
    */
    public function __construct( $meta_box_id, $meta_box_title, $post_type ) {
        
        $this->meta_box = array (
                            'id'        => $meta_box_id,
                            'title'     => $meta_box_title,
                            'post_type' => $post_type,
                            );

        $this->fields = array(
                            'elead-sidebar-position',
                            'elead-selected-sidebar',
                            'elead-header-image',
                            );


        // Add metaboxes
        add_action( 'add_meta_boxes', array( $this, 'add' ) );
        
        add_action( 'save_post', array( $this, 'save' ) );  
    }

    /**
    * Add Meta Box for multiple post types.
    *
    * @since Elead 0.1
    *
    * @access public
    */
    public function add($postType) {
        if( in_array( $postType, $this->meta_box['post_type'] ) ) {
            add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType );
        }
    }

    /**
    * Renders metabox
    *
    * @since Elead 0.1
    *
    * @access public
    */
    public function show() {
        global $post;

        $layout_options         = elead_sidebar_position();
        $sidebar_options        = elead_selected_sidebar();
        $header_image_options   = elead_header_image();
        
        
        // Use nonce for verification  
        wp_nonce_field( basename( __FILE__ ), 'elead_custom_meta_box_nonce' );

        // Begin the field table and loop  ?>  
        <div id="elead-ui-tabs" class="ui-tabs">
            <ul class="elead-ui-tabs-nav" id="elead-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Layout Options', 'elead' ); ?></a></li>
                <li><a href="#frag3"><?php esc_html_e( 'Header Image Options', 'elead' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Select Sidebar', 'elead' ); ?></a></li>
            </ul> 

            <div id="frag1" class="catch_ad_tabhead">
                <table id="layout-options" class="form-table" width="100%">
                    <tbody>
                        <tr>
                            <select name="elead-sidebar-position" id="custom_element_grid_class">
                                <option value=""><?php esc_html_e( 'Default ( to customizer option )', 'elead' ); ?></option>
                                <?php  
                                    $metalayout = get_post_meta( $post->ID, 'elead-sidebar-position', true );
                                    if( empty( $metalayout ) ){
                                        $metalayout='';
                                    }
                                    foreach ( $layout_options as $field => $value ) {  
                                ?>
                                    <option value="<?php echo esc_attr( $field ); ?>" <?php selected( $metalayout, $field ); ?>><?php echo esc_html( $value ); ?></option>
                                <?php
                                } // end foreach 
                                ?>
                            </select>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="frag2" class="catch_ad_tabhead">
                <table id="sidebar-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>
                            <?php
                            $metasidebar = get_post_meta( $post->ID, 'elead-selected-sidebar', true );
                            if ( empty( $metasidebar ) ){
                                $metasidebar='sidebar-1';
                            } 
                            foreach ( $sidebar_options as $field => $value ) {  
                            ?>
                                <td style="vertical-align: top;">
                                    <label class="description">
                                        <input type="radio" name="elead-selected-sidebar" value="<?php echo esc_attr( $field ); ?>" <?php checked( $field, $metasidebar ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                            <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>        
            </div>

            <div id="frag3" class="catch_ad_tabhead">
                <table id="header-image-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>                
                            <?php  
                            $metaheader = get_post_meta( $post->ID, 'elead-header-image', true );
                            if ( empty( $metaheader ) ){
                                $metaheader='show-both';
                            }
                            foreach ( $header_image_options as $field => $value ) { 
                            ?>
                                <td style="width: 100px;">
                                    <label class="description">
                                        <input type="radio" name="elead-header-image" value="<?php echo esc_attr( $field ); ?>" <?php checked( $field, $metaheader ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                            <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php 
    }

    /**
     * Save custom metabox data
     * 
     * @action save_post
     *
     * @since Elead 0.1
     *
     * @access public
     */
    public function save( $post_id ) { 
    
        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'elead_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'elead_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
            return;
        }
      
        foreach ( $this->fields as $field ) {      
            // Checks for input and sanitizes/saves if needed
            if( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
            }
        } // end foreach         
    }
}
$post_types = array( 'page', 'post' );
$elead_metabox = new Elead_MetaBox( 
                                    'elead-options',     //metabox id
                                    esc_html__( 'Elead Meta Options', 'elead' ), //metabox title
                                    $post_types            //metabox post types
                                    );

/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_enqueue_script, and  wp_enqueue_style
 *
 * @since Elead 0.1
 */
function elead_enqueue_metabox_scripts( $hook ) {
    if( $hook == 'post.php' || $hook == 'post-new.php'  ){
        $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
        //Scripts
        wp_enqueue_script( 'elead-metabox', get_template_directory_uri() . '/assets/js/metabox' .$min. '.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );
        //CSS Styles
        wp_enqueue_style( 'elead-metabox-tabs', get_template_directory_uri() . '/assets/css/metabox-tabs' .$min. '.css' );
    }
    return;
}
add_action( 'admin_enqueue_scripts', 'elead_enqueue_metabox_scripts', 11 );