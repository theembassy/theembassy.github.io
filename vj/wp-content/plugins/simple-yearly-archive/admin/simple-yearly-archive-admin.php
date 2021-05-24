<?php
/*
 * The dashboard-specific functionality of the plugin
 *
 * @package WordPress_Plugins
 * @subpackage SimpleYearlyArchive_Admin
 */

class SimpleYearlyArchive_Admin {
	/**
	 * Instance of this class.
	 *
	 * @since    1.7.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.7.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.7.0
	 */
	private function __construct() {

		/*
		 * Call $plugin_slug from public plugin class.
		 */
		$plugin = SimpleYearlyArchive::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		$this->plugin_version = $plugin->get_plugin_version();
		$this->plugin_path = $plugin->get_plugin_path();
		$this->text_domain = $plugin->text_domain;

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		if( !get_option('sya_dateformatchanged2012') || get_option('sya_dateformatchanged2012') == 0 ) {
			add_action('admin_notices', array( $this, 'dateformat_changed_message' ));
		}

		if( !get_option('sya_dateformatchanged2015') || get_option('sya_dateformatchanged2015') == 0 ) {
			if( preg_match('/\%/', get_option('sya_dateformat')) ) {
				update_option("sya_dateformat", $this->_strftime_to_date_format( get_option('sya_dateformat') ));
			}

			add_action('admin_notices', array( $this, 'dateformat_changed_message_172' ));
		}

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( realpath( dirname( __FILE__ ) ) ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		require_once( 'authorplugins.inc.php' );
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.7.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if( $this->plugin_screen_hook_suffix == $screen->id ) {
			//wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'admin/assets/css/os_authorplugins_style.css', __FILE__ ), array(), $this->plugin_version );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.7.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if( $this->plugin_screen_hook_suffix == $screen->id ) {
			//wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'admin/assets/js/os_authorplugins_script.js', __FILE__ ), array( 'jquery' ), $this->plugin_version );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		*
		*/
		$this->plugin_screen_hook_suffix = add_options_page(
				__( 'Simple Yearly Archive', $this->plugin_slug ),
				__( 'Simple Yearly Archive', $this->plugin_slug ),
				'manage_options',
				$this->plugin_slug,
				array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.7.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.7.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings' ) . '</a>'
			),
			$links
		);

	}


	/**
	 * Convert a strftime format string to a date format string
	 *
	 * @since 1.7.2
	 * @author scripts@schloebe.de
	 *
	 * @param string $date_format a strftime format
	 * @return string
	 */
	private function _strftime_to_date_format( $date_format ) {
	    $caracs = array(
	        '%d' => 'd', '%a' => 'D', '%e' => 'j', '%A' => 'l', '%u' => 'N', '%ww' => 'w', '%j' => 'z',
	        '%V' => 'W',
	        '%B' => 'F', '%m' => 'm', '%b' => 'M',
	        '%G' => 'o', '%Y' => 'Y', '%y' => 'y',
	        '%P' => 'a', '%p' => 'A', '%l' => 'g', '%I' => 'h', '%H' => 'H', '%M' => 'i', '%S' => 's',
	        '%z' => 'O', '%Z' => 'T',
	        '%s' => 'U'
	    );

	    return strtr((string)$date_format, $caracs);
	}


	/**
	 * Notify users that date format has changed with version 1.2.6
	 *
	 * @since 1.2.6
	 * @author scripts@schloebe.de
	 */
	function dateformat_changed_message() {
		echo "<div id='wpversionfailedmessage' class='error fade'><p>" . sprintf( __('The date format changed in Simple Yearly Archive 1.2.6! Please <a href="%s">save the options once</a> to assign the new date format to the system! <strong>Do not forget to change the date format string!</strong>', $this->text_domain), admin_url( 'options-general.php?page=' . $this->plugin_slug ) ) . "</p></div>";
	}

	/**
	 * Notify users that date format has changed with version 1.7.2
	 *
	 * @since 1.7.2
	 * @author scripts@schloebe.de
	 */
	function dateformat_changed_message_172() {
		echo "<div id='wpversionfailedmessage' class='error fade'><p>" . sprintf( __('The date format changed in Simple Yearly Archive 1.7.2! Your date format has automatically been converted to the new date() format. Please review and <a href="%s">save the options once</a> to assign the new date format to the system! <strong>Do not forget to review the archive output in the frontend!</strong>', $this->text_domain), admin_url( 'options-general.php?page=' . $this->plugin_slug ) ) . "</p></div>";
	}
}