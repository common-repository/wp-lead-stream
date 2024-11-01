<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://edisonave.com
 * @since      1.0.0
 *
 * @package    Wp_Lead_Stream
 * @subpackage Wp_Lead_Stream/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Lead_Stream
 * @subpackage Wp_Lead_Stream/admin
 * @author     Tom Printy <tprinty@edisonave.com>
 */
class Wp_Lead_Stream_Admin {

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
		 * defined in Wp_Lead_Stream_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Lead_Stream_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-lead-stream-admin.css', array(), $this->version, 'all' );
		
		//Needed for Datatables/
		wp_enqueue_style( $this->plugin_name .'bootstrap_style', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all');
		wp_enqueue_style( $this->plugin_name .'datatables' , plugin_dir_url( __FILE__ ) . 'css/jquery.dataTables.css', array(), $this->version, 'all');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		

		
		//Needed for Datatables
		wp_enqueue_script( $this->plugin_name.'datatables_js', plugin_dir_url( __FILE__ ) . 'js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name .'datatables_bootstrap', plugin_dir_url( __FILE__ ) . 'js/dataTables.bootstrap.min.js', array('jquery'), $this->version, true);
	
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-lead-stream-admin.js', array( 'jquery' ), $this->version, true );
		
		
	}
	
	/**
	 * Function to format phone inspired by The Barton Organization 
	 * https://thebarton.org/php-format-phone-number-function/
	 *
	 * @since    1.0.0
	 */
	function format_phone_us($phone) {
		if(!isset($phone{3})) { return ''; }
	 	// note: strip out everything but numbers 
		$phone = preg_replace("/[^0-9]/", "", $phone);
		$length = strlen($phone);
		switch($length) {
		  case 7:
		    return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
		  break;
		  case 10:
		   return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "1-$1-$2-$3", $phone);
		  break;
		  case 11:
		  return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3-$4", $phone);
		  break;
		  default:
		    return $phone;
		  break;
	  	}
	}


	
	/**
	 * The admin menus and associated screens
	 *
	 * @since    1.0.0
	 */

	function admin_menu() {
		add_menu_page("", "WP Lead Stream", 'manage_options', 'wp_lead_stream_admin',  array( $this, 'wp_lead_stream_admin'), 'dashicons-megaphone', 74);
		add_submenu_page("wp_lead_stream_admin", "Settings", "Settings", 'manage_options', "wp_lead_stream_settings", array( $this, "wp_lead_stream_settings"));
		
		//Actions for the pages above
		$this->add_admin_page( 'wp_lead_stream_settings_process' );
		
	}


	/**
	 * The admin notice and associated screens
	 *
	 * @since    1.0.0
	 */
	function admin_notice(){
		if( get_transient( 'wpleadstream-admin-notice' ) ){
        
        	if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
    			//plugin is activated, do something
				?>
			        <div class="notice notice-success is-dismissible">
			            <p>Thank you for installing WP Lead Stream! <strong>You are awesome</strong>.</p>
			        </div>
			     <?php
			}else{
				  ?>
			        <div class="notice notice-error">
			            <p>Thank you for installing WP Lead Stream! To take full advantage of this plugin please install the <a href="https://www.gravityforms.com/">Gravity Forms</a> plugin. <strong>You are awesome</strong>.</p>
			        </div>
			     <?php
				
			}
        
      
        	/* Delete transient, only display this notice once. */
        	delete_transient( 'wpleadstream-admin-notice' );
    	}
	}


	/**
	 * The admin process options page 
	 *
	 * @since    1.0.0
	 */
	function wp_lead_stream_settings_process(){
		
		
		$forward_phone = trim($this->admin_post('forward_phone'));
		$whisper_message = trim($this->admin_post('whisper_message'));
		$caller_greeting = trim($this->admin_post('caller_greeting'));
		$voice = trim($this->admin_post('voice'));
		
		if ( get_option( 'wls_forward_phone' ) !== false ) {
 
		    // The option already exists, so update it.
		    update_option( 'wls_forward_phone', $forward_phone );
		 
		} else {
		 
		    // The option hasn't been created yet, so add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( 'wls_forward_phone', $forward_phone, $deprecated, $autoload );
		}
		
		
		if ( get_option( 'wls_whisper_message' ) !== false ) {
 
		    // The option already exists, so update it.
		    update_option( 'wls_whisper_message', $whisper_message );
		 
		} else {
		 
		    // The option hasn't been created yet, so add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( 'wls_whisper_message', $whisper_message, $deprecated, $autoload );
		}
		
		if ( get_option( 'wls_caller_greeting' ) !== false ) {
 
		    // The option already exists, so update it.
		    update_option( 'wls_caller_greeting', $caller_greeting );
		 
		} else {
		 
		    // The option hasn't been created yet, so add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( 'wls_caller_greeting', $caller_greeting, $deprecated, $autoload );
		}
		
		if ( get_option( 'wls_voice' ) !== false ) {
 
		    // The option already exists, so update it.
		    update_option( 'wls_voice', $voice );
		 
		} else {
		 
		    // The option hasn't been created yet, so add it with $autoload set to 'no'.
		    $deprecated = null;
		    $autoload = 'no';
		    add_option( 'wls_voice', $voice, $deprecated, $autoload );
		}
		
		
		
		
    	wp_redirect($this->admin_link('wp_lead_stream_settings', '', false), 303);
	  	exit;
	}
	
	function wp_lead_stream_settings(){
		global $wpdb;
		
		
		$forward_phone = "000-000-0000";
		$whisper_message = "";
		$caller_greeting = "";
		$voice = "man";
		
		if ( ($forward_phone = get_option( 'wls_forward_phone' )) == false ) {
			$forward_phone = "000-000-0000";
		}
		
		if ( ($whisper_message = get_option( 'wls_whisper_message' )) == false ) {
			$whisper_message = "";
		}
		
		if ( ($caller_greeting = get_option( 'wls_caller_greeting' )) == false ) {
			$caller_greeting = "";
		}
		
		if ( ($voice = get_option( 'wls_voice' )) == false ) {
			$voice = "man";
		}		
		require 'partials/wp-lead-stream-settings-display.php';
	}
	

	
	
	function wp_lead_stream_admin(){
		global $wpdb;
		
		$query_select = "SELECT * FROM `{$wpdb->prefix}wpleadstream_contacts_v1` ORDER BY time DESC";
		$lastfiveleads = $wpdb->get_results($query_select);
		
		require 'partials/wp-lead-stream-admin-display.php';
	}


	//Helpers
	
   /**
   * A safe alternative to accessing potentially unset $_POST variables.
   *
   * @param string $name 
   * @return mixed
   * @author Robert Kosek, Wood Street Inc.
   */
	function admin_post($name) {
	    // prevents a warning.
	    if(array_key_exists($name, $_POST) === false) {
	      return null;
	    }
	    return is_string($_POST[$name]) ? stripslashes($_POST[$name]) : $_POST[$name];
	}
	
	
	function admin_link($hook, $query_str=false, $echo=true) {
    	$url = admin_url("admin.php?page=${hook}");
	    
	    if($query_str && !empty($query_str))
	      $url .= '&' . (is_string($query_str) ? $query_str : http_build_query($query_str));
	        
	    if($echo)
	      echo $url;
	    else
	      return $url;
	}
	
	function add_admin_page($hook) {
	    global $_registered_pages;
	    $hookname = get_plugin_page_hookname($hook, 'admin.php');
	    if(!empty($hookname)) {
	      add_action($hookname, array($this, $hook));
	      $_registered_pages[$hookname] = true;
	    }
	}

}
