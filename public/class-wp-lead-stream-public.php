<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://edisonave.com
 * @since      1.0.0
 *
 * @package    Wp_Lead_Stream
 * @subpackage Wp_Lead_Stream/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Lead_Stream
 * @subpackage Wp_Lead_Stream/public
 * @author     Tom Printy <tprinty@edisonave.com>
 */
class Wp_Lead_Stream_Public {

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
		 * defined in Wp_Lead_Stream_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Lead_Stream_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-lead-stream-public.css', array(), $this->version, 'all' );

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
		 * defined in Wp_Lead_Stream_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Lead_Stream_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-lead-stream-public.js', array( 'jquery' ), $this->version, false );

	}
	
	
	/**
	 * Initial Contact from Twilio.
	 *
	 * @since    1.0.0
	 */
	public function wls_twilio_enpoint() {
		
		global $wpdb;

				
		if ( ($caller_greeting = get_option( 'wls_caller_greeting' )) == false ) {
			$caller_greeting = "Thanks for calling please hold.";
		}
		
		if ( ($voice = get_option( 'wls_voice' )) == false ) {
			$voice = "man";
		}		
		
		
		if ( ($forward_phone = get_option( 'wls_forward_phone' )) == false ) {
			$forward_phone = "555-555-1212";
		}
		
		if ( ($whisper_message = get_option( 'wls_whisper_message' )) == false ) {
			$whisper_message = "";
		}
		
		$whisper_url = admin_url('admin-ajax.php')."?action=wls_twillio_whisper";
		
			 
		$response = new \Twilio\TwiML\VoiceResponse();
	
		$response->say($caller_greeting, ['voice' => $voice, 'language' => 'en-US']);
		$dial = $response->dial('');
		$action = admin_url('admin-ajax.php').'?wls_twilio_callstatus';
		
		if (strlen($whisper_message)>=1){
			$dial->number($forward_phone, ['url' => $whisper_url, 'action' => $action]);
		}else{
			$dial->number($forward_phone);
		}
		
		$callerphone = '';
		if ( $_GET['From'] ) {
			$callerphone = sanitize_text_field($_GET['From']);
		}
		if ( $_POST['From'] ) {
			$callerphone = sanitize_text_field($_POST['From']);
		}
		
		
		$status = 'complete';
		if ( $_GET['CallStatus'] ) {
			$status =  sanitize_text_field($_GET['CallStatus']);
		}
		if (($_POST['CallStatus'] )&&($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$status = sanitize_text_field($_POST['CallStatus']);
		}
		
		$sid = '';
		if ( $_GET['CallSid'] ) {
			$sid = sanitize_text_field($_GET['CallSid']);
		}
		if (( $_POST['CallSid'] )&&($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$sid = sanitize_text_field($_POST['CallSid']);
		}
		
		//Log the call
		$wpdb->insert('wp_wpleadstream_contacts_v1',
							   array('contact_type' 	    => 'phone',
									 'contact_phone_number' => $callerphone,
									 'call_status'			=> $status,
									 'call_sid'				=> $sid,
									 'phone_forward'		=> $phone_forward,
									 
							   ),
							   array('%s',
							   		 '%s',
							   		 '%s',
							   		 '%s',
									)
							 );
							 
		print $response;
		
		wp_die();

	}
	
	/**
	 * Call Whisper TWmL from Twilio.
	 *
	 * @since    1.0.0
	 */
	public function wls_twilio_whisper() {
		
		global $wpdb;
		
		if ( ($whisper_message = get_option( 'wls_whisper_message' )) == false ) {
			$whisper_message = "You are being connected to a caller.";
		}
		
		if ( ($voice = get_option( 'wls_voice' )) == false ) {
			$voice = "man";
		}	
		
		$response_url = admin_url('admin-ajax.php')."?action=wls_twillio_response";
		$whisper_url = admin_url('admin-ajax.php')."?action=wls_twillio_whisper";
			 
		$response = new \Twilio\TwiML\VoiceResponse();
		$gather = $response->gather(array('numDigits' => 1, 'action'=>$response_url));	
		$gather->say($whisper_message, ['voice' => $voice, 'language' => 'en-US']);
		$response->say("Sorry I did not understand your response.", ['voice' => $voice, 'language' => 'en-US']);
		$response->redirect($whisper_url);	
		print $response;
		
		wp_die();

	}
	
	/**
	 * Initial Contact from Twilio.
	 *
	 * @since    1.0.0
	 */
	public function wls_twillio_response() {
			
		global $wpdb;
		
		$response_url = admin_url('admin-ajax.php')."?action=wls_twillio_response";
		$whisper_url = admin_url('admin-ajax.php')."?action=wls_twillio_whisper";
			 
		$response =  new \Twilio\Twiml();
				
		$user_pushed = '';
		if ( $_GET['Digits'] ) {
			$user_pushed =  (int) sanitize_text_field($_GET['Digits']);
		}
		if (( $_POST['Digits'] )&&($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$user_pushed =  (int) sanitize_text_field($_POST['Digits']);
		}
		
		if ( ($voice = get_option( 'wls_voice' )) == false ) {
			$voice = "man";
		}	
		
		if ($user_pushed == 1){
			$status = "accepted";
			$response->say("Connecting the call", ['voice' => $voice, 'language' => 'en-US']);
		}else{
			$status = "rejected";
			$response->hangup();
		}
		
		$sid = '';
		if ( $_GET['ParentCallSid'] ) {
			$sid =  sanitize_text_field($_GET['ParentCallSid']);
		}
		if (($_POST['ParentCallSid'] )&&($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$sid = sanitize_text_field($_POST['ParentCallSid']);
		}
		
		
		$wpdb->update( 'wp_wpleadstream_contacts_v1', array( 'call_status' => $status), array( 'call_sid' => $sid ), array( '%s' ) );
		
		print $response;
		wp_die();

	}
	
	/**
	 * Call Status from Twilio.
	 *
	 * @since    1.0.0
	 */
	public function wls_twillio_callstatus() {
		global $wpdb;
		
		$status = 'complete';
		if ( $_GET['DialCallStatus'] ) {
			$status =  sanitize_text_field($_GET['DialCallStatus']);
		}
		if (($_POST['DialCallStatus'] )&&($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$status = sanitize_text_field($_POST['DialCallStatus']);
		}
		
		$sid = '';
		if ( $_GET['ParentCallSid'] ) {
			$sid =  sanitize_text_field($_GET['ParentCallSid']);
		}
		if (($_POST['ParentCallSid'] )&&($_SERVER['REQUEST_METHOD'] === 'POST')) {
			$sid = sanitize_text_field($_POST['ParentCallSid']);
		}
		
		$wpdb->update( 'wp_wpleadstream_contacts_v1', array( 'call_status' => $status), array( 'call_sid' => $sid ), array( '%s' ) );
		
		wp_die();

	}
}
