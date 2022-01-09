<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.valleydevelopers.com/
 * @since      1.0.0
 *
 * @package    Ctm_Reg
 * @subpackage Ctm_Reg/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ctm_Reg
 * @subpackage Ctm_Reg/admin
 * @author     Valley Developers <contact@valleydevelopers.com>
 */
class Ctm_Reg_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ctm_Reg_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ctm_Reg_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ctm-reg-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ctm_Reg_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ctm_Reg_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ctm-reg-admin.js', array( 'jquery' ), $this->version, false );

	}

}


/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class ShipWDCustomRegistration {
	private $ship4wd_custom_registration_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'ship4wd_custom_registration_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'ship4wd_custom_registration_page_init' ) );
	}

	public function ship4wd_custom_registration_add_plugin_page() {
		add_options_page(
			'Ship4WD - Custom Registration', // page_title
			'Ship4WD - Custom Registration', // menu_title
			'manage_options', // capability
			'ship4wd-custom-registration', // menu_slug
			array( $this, 'ship4wd_custom_registration_create_admin_page' ) // function
		);
	}

	public function ship4wd_custom_registration_create_admin_page() {
		$this->ship4wd_custom_registration_options = get_option( 'ship4wd_custom_registration_option_name' ); ?>

		<div class="wrap">
			<h2>Ship4WD - Custom Registration</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'ship4wd_custom_registration_option_group' );
					do_settings_sections( 'ship4wd-custom-registration-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function ship4wd_custom_registration_page_init() {
		register_setting(
			'ship4wd_custom_registration_option_group', // option_group
			'ship4wd_custom_registration_option_name', // option_name
			array( $this, 'ship4wd_custom_registration_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'ship4wd_custom_registration_setting_section', // id
			'Settings', // title
			array( $this, 'ship4wd_custom_registration_section_info' ), // callback
			'ship4wd-custom-registration-admin' // page
		);

		add_settings_field(
			'client_id_0', // id
			'Client ID', // title
			array( $this, 'client_id_0_callback' ), // callback
			'ship4wd-custom-registration-admin', // page
			'ship4wd_custom_registration_setting_section' // section
		);

		add_settings_field(
			'client_secret_1', // id
			'Client Secret', // title
			array( $this, 'client_secret_1_callback' ), // callback
			'ship4wd-custom-registration-admin', // page
			'ship4wd_custom_registration_setting_section' // section
		);

		add_settings_field(
			'refresh_token_2', // id
			'Refresh Token', // title
			array( $this, 'refresh_token_2_callback' ), // callback
			'ship4wd-custom-registration-admin', // page
			'ship4wd_custom_registration_setting_section' // section
		);

		add_settings_field(
			'sf_key_3', // id
			'SF Key', // title
			array( $this, 'sf_key_3_callback' ), // callback
			'ship4wd-custom-registration-admin', // page
			'ship4wd_custom_registration_setting_section' // section
		);
	}

	public function ship4wd_custom_registration_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['client_id_0'] ) ) {
			$sanitary_values['client_id_0'] = sanitize_text_field( $input['client_id_0'] );
		}

		if ( isset( $input['client_secret_1'] ) ) {
			$sanitary_values['client_secret_1'] = sanitize_text_field( $input['client_secret_1'] );
		}

		if ( isset( $input['refresh_token_2'] ) ) {
			$sanitary_values['refresh_token_2'] = sanitize_text_field( $input['refresh_token_2'] );
		}

		if ( isset( $input['sf_key_3'] ) ) {
			$sanitary_values['sf_key_3'] = sanitize_text_field( $input['sf_key_3'] );
		}

		return $sanitary_values;
	}

	public function ship4wd_custom_registration_section_info() {

	}

	public function client_id_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="ship4wd_custom_registration_option_name[client_id_0]" id="client_id_0" value="%s">',
			isset( $this->ship4wd_custom_registration_options['client_id_0'] ) ? esc_attr( $this->ship4wd_custom_registration_options['client_id_0']) : ''
		);
	}

	public function client_secret_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="ship4wd_custom_registration_option_name[client_secret_1]" id="client_secret_1" value="%s">',
			isset( $this->ship4wd_custom_registration_options['client_secret_1'] ) ? esc_attr( $this->ship4wd_custom_registration_options['client_secret_1']) : ''
		);
	}

	public function refresh_token_2_callback() {
		printf(
			'<input class="regular-text" type="text" name="ship4wd_custom_registration_option_name[refresh_token_2]" id="refresh_token_2" value="%s">',
			isset( $this->ship4wd_custom_registration_options['refresh_token_2'] ) ? esc_attr( $this->ship4wd_custom_registration_options['refresh_token_2']) : ''
		);
	}

	public function sf_key_3_callback() {
		printf(
			'<input class="regular-text" type="password" name="ship4wd_custom_registration_option_name[sf_key_3]" id="sf_key_3" value="%s">',
			isset( $this->ship4wd_custom_registration_options['sf_key_3'] ) ? esc_attr( $this->ship4wd_custom_registration_options['sf_key_3']) : ''
		);
	}

}
if ( is_admin() )
	$ship4wd_custom_registration = new ShipWDCustomRegistration();

/*
 * Retrieve this value with:
 * $ship4wd_custom_registration_options = get_option( 'ship4wd_custom_registration_option_name' ); // Array of All Options
 * $client_id_0 = $ship4wd_custom_registration_options['client_id_0']; // Client ID
 * $client_secret_1 = $ship4wd_custom_registration_options['client_secret_1']; // Client Secret
 * $refresh_token_2 = $ship4wd_custom_registration_options['refresh_token_2']; // Refresh Token
 * $sf_key_3 = $ship4wd_custom_registration_options['sf_key_3']; // SF Key
 */
