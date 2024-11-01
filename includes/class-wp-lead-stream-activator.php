<?php

/**
 * Fired during plugin activation
 *
 * @link       http://edisonave.com
 * @since      1.0.0
 *
 * @package    Wp_Lead_Stream
 * @subpackage Wp_Lead_Stream/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Lead_Stream
 * @subpackage Wp_Lead_Stream/includes
 * @author     Tom Printy <tprinty@edisonave.com>
 */
class Wp_Lead_Stream_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		
		//Create the Primary WP table that we will use for lead tracking
		$table_name = $wpdb->prefix . 'wpleadstream_contacts_v1';
		
		$sql = "CREATE TABLE $table_name (
		    id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			contact_type = tinytext, 
			contact_first_name tinytext,
			contact_last_name tinytext,
			contact_email tinytext,
			contact_phone_number tinytext,
			contact_message longtext,
			email_forward_address tinytext,
			phone_forward tinytext,
			ip_address tinytext,
			call_status tinytext,
			call_sid tinytext,
			PRIMARY KEY  (id)
		);";
		
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		set_transient( 'wpleadstream-admin-notice', true, 5 );
		
	}

}
