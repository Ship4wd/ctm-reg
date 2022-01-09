<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.valleydevelopers.com/
 * @since      1.0.0
 *
 * @package    Ctm_Reg
 * @subpackage Ctm_Reg/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ctm_Reg
 * @subpackage Ctm_Reg/public
 * @author     Valley Developers <contact@valleydevelopers.com>
 */
class Ctm_Reg_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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
		 global $post;
		 if ( has_shortcode( $post->post_content, 'include_form' ) ) {
				wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css', array(), $this->version, 'all' );
				wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css', array(), $this->version, 'all' );
				wp_enqueue_style('int-tel-input', plugin_dir_url( __DIR__ ) ."/dist/js/vendors/int-tel-input/css/intlTelInput.css", array(), $this->version, 'all' );
 				wp_enqueue_style( $this->plugin_name, plugin_dir_url( __DIR__ ) . 'dist/ctm-reg.min.css', array(), $this->version, 'all' );
		 }

		 add_action('wp_head', 'blackListEmailsScript');
	   function blackListEmailsScript(){
	     global $post;
	     if ( has_shortcode( $post->post_content, 'include_form' ) ) {
	     ?>
	         <script type="text/javascript">
	           const blackListEmails = "<?php print_r(blackListEmail()); ?>";
	           const _blackListEmails = blackListEmails.split(',');
	           const statesData = "<?php print_r(GetDDLVals('states-data')); ?>";
	           const _statesData = statesData.split(',');
	         </script>
	     <?php
	     }
	   }

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		global $post;
		if ( has_shortcode( $post->post_content, 'include_form' ) ) {
		  wp_enqueue_script('popper', '//cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js', array('jquery'), $this->version, true);
		  wp_enqueue_script('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js', array('jquery'), $this->version, true);
			wp_enqueue_script('jbvalidator', '//cdn.jsdelivr.net/npm/@emretulek/jbvalidator@latest/dist/jbvalidator.min.js', array('jquery'), $this->version, true);
			wp_enqueue_script('int-tel-input-defer', plugin_dir_url( __DIR__ ) ."dist/js/vendors/int-tel-input/js/intlTelInput.js", array('jquery'), $this->version, true);
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ctm-reg-public.js', array( 'jquery' ), $this->version, false );
			wp_localize_script( $this->plugin_name, 'ctm_reg', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
		}
	}
}
