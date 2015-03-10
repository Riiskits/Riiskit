<?php
/**
 * Implement Theme Customizer additions and adjustments.
 *
 * @package		Riiskit
 * @subpackage	functions.php
 * @since		1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function riiskit_theme_customizer( $wp_customize ) {
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
	$wp_customize->remove_section( 'static_front_page' );


	// MOBILE
	// Mobile sidr.js menu on/off
	$wp_customize->add_section('developer' , array(
		'title' => __('Developer', 'riiskit'),
		'priority'    => 2,
		'description' => __( 'Options for the developer.', 'riiskit' ),
	) );
	// toggle/slideout selection
	$wp_customize->add_setting('developer_menu_type', array(
		'default' => 'toggle-menu',
		'type' => 'option',
		'capability' => 'activate_plugins',
		'sanitize_callback', 'riiskit_sanitize_menu_type',
	) );
	$wp_customize->add_control('developer_menu_type', array(
		'label'      => __('Menutype', 'riiskit'),
		'section'    => 'developer',
		'settings'   => 'developer_menu_type',
		'type' => 'select',
		'choices' => array(
            'toggle-menu' => 'Toggle',
            'slideout-menu' => 'Slideout',
        ),
	) );


	// SOCIAL
	$wp_customize->add_section( 'social', array(
		'title'       => __( 'Social', 'riiskit' ),
		'description' => __('Add links to your social profiles.', 'riiskit'),
		'priority'    => 135,
	) );
	$social_links = array();
    // Facebook
	$social_links[] = array(
        'slug'	=> 'social_facebook_link',
        'label'	=> 'Facebook',
    );
	// Twitter
    $social_links[] = array(
        'slug'	=> 'social_twitter_link',
		'label'	=> 'Twitter',
    );
    foreach( $social_links as $link ) {
		// SETTINGS
		$wp_customize->add_setting( $link['slug'], array(
            'type' => 'option',
			'sanitize_callback' => 'riiskit_sanitize_url',
        ) );
        // CONTROLS
        $wp_customize->add_control( $link['slug'], array(
			'label' => $link['label'],
			'section' => 'social',
			'settings' => $link['slug'],
			'type' => 'text',
		) );
	}
}
add_action( 'customize_register', 'riiskit_theme_customizer' );


// CUSTOM CONTROLS

if( class_exists( 'WP_Customize_Control' ) ):
	/**
	* Customize Number Control
	*
	* @since Riiskit 1.0.0
	*/
	class Riiskit_Customize_Number_Control extends WP_Customize_Control
	{
		public $type = 'number';

		public function render_content() {
			?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<input type="number" style="width:30%;" id="<?php echo $this->id; ?>" name="<?php echo $this->id; ?>" value="<?php echo absint( $this->value() ); ?>" <?php $this->link(); ?>>
		</label>
		<?php
		}
	}

	/**
	* Customize Textarea
	*
	* @since Riiskit 1.0.0
	*/
	class Textarea_Custom_Control extends WP_Customize_Control
	{
		public $type = 'textarea';
		/**
		 * Render the control's content.
		 *
		 * Allows the content to be overriden without having to rewrite the wrapper.
		 *
		 * @since   10/16/2012
		 * @return  void
		 */
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?>>
					<?php echo esc_textarea( $this->value() ); ?>
				</textarea>
			</label>
			<?php
		}
	}

	/**
	* Customize Image Reloaded Class
	*
	* Extend WP_Customize_Image_Control allowing access to uploads made within
	* the same context
	*
	* @since Riiskit 1.0.0
	*/
	class Riiskit_Customize_Image_Control extends WP_Customize_Image_Control {
        /**
		* Constructor.
		*
		* @since 3.4.0
		* @uses WP_Customize_Image_Control::__construct()
		*
		* @param WP_Customize_Manager $manager
		*/
	   public function __construct( $manager, $id, $args = array() ) {
		   parent::__construct( $manager, $id, $args );
	   }

	   /**
		* Search for images within the defined context
		*/
	   public function tab_uploaded()
	   {
		   $my_context_uploads = get_posts( array(
			   'post_type'  => 'attachment',
			   'meta_key'   => '_wp_attachment_context',
			   'meta_value' => $this->context,
			   'orderby'    => 'post_date',
			   'nopaging'   => true,
		   ) );
		   ?>

		   <div class="uploaded-target"></div>

		   <?php
		   if ( empty( $my_context_uploads ) )
			   return;

		   foreach ( (array) $my_context_uploads as $my_context_upload ) {
			   $this->print_tab_image( esc_url_raw( $my_context_upload->guid ) );
		   }
	   }
    }
endif;


// SANITIZERS

/**
 * Sanitize number
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_number( $value ) {
    $value = (int) $value;
    return ( 0 < $value ) ? $value : null;
}

/**
 * Sanitize checkbox
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_checkbox( $input ) {
    if ( $input === true ) {
        return 1;
    } else {
        return 0;
    }
}

/**
 * Sanitize URL
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_url( $value) {
	$value = esc_url( $value);
	return $value;
}

/**
 * Sanitize HTML
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_html( $input ) {
    return wp_kses_post($input);
}

/**
 * Sanitize color hex
 *
 * @since Riiskit 1.0.0
 */
function riiskit_sanitize_hex_color( $color ) {
	if ( $unhashed = sanitize_hex_color_no_hash( $color ) )
		return '#' . $unhashed;

	return $color;
}

// Custom ones

/**
 * select: menu type
 *
 * @since Riiskit 1.0.0
 *
 * @param array $input.
 * return array Valid options.
 */
function riiskit_sanitize_menu_type( $input ) {
    $valid = array(
        'toggle-menu' => 'Toggle',
        'slideout-menu' => 'Slideout',
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
