<?php

// Make sure Gravity Forms is active and already loaded.
if (class_exists("GFForms")) {
    	
    // The Add-On Framework is not loaded by default.
    // Use the following function to load the appropriate files.
    GFForms::include_addon_framework();
    
    class WPLeadStreamGFAddOn extends GFAddOn {
        // The following class variables are used by the Framework.
        // They are defined in GFAddOn and should be overridden.
        // The version number is used for example during add-on upgrades.
        protected $_version = "1.0";
        
        // The Framework will display an appropriate message on the plugins page if necessary
        protected $_min_gravityforms_version = "1.8.7";
        
        // A short, lowercase, URL-safe unique identifier for the add-on.
        // This will be used for storing options, filters, actions, URLs and text-domain localization.
        protected $_slug = "wpleadstream";
        
        // Relative path to the plugin from the plugins folder.
        protected $_path = "wp-lead-stream/wp-lead-srteam.php";
        
        // Full path the the plugin.
        protected $_full_path = __FILE__;
        
        // Title of the plugin to be used on the settings page, form settings and plugins page.
        protected $_title = "Gravity Forms WP Lead Stream";
        
        // Short version of the plugin title to be used on menus and other places where a less verbose string is useful.
        protected $_short_title = "WPLeadStream";
       
	    /**
         * The init_frontend() function is called during the WordPress init hook but only on the front-end.
         * Runs after WordPress has finished loading but before any headers are sent.
         * GFAddOn::init_frontend() handles the loading of the scripts and styles
         * so don't forget to call parent::init_frontend() unless you want to handle the script loading differently.
         */
        public function init_frontend() {
            parent::init_frontend();
            add_action('gform_after_submission', array($this, 'after_submission'), 10, 2);
        }

        /**
         * This is the target for the gform_after_submission action hook.
         * Executed at the end of the submission process (after form validation, notification, and entry creation).
         *
         * @param array $entry The Entry Object containing the submitted form values
         * @param array $form  The Form Object containing all the form and field settings
         *
         * @return bool
         */
        function after_submission($entry, $form) {
            global $wpdb;
            
			$addon_settings = $this->get_form_settings( $form );
			
			
            if (!$addon_settings) {
                return;
            }
			
			
			if($addon_settings["isEnabled"]){
				
	            $first_name_field = rgar( $entry, $addon_settings["first_name"]);
	            $last_name_field  = rgar( $entry, $addon_settings["last_name"]);
	            $email_field = rgar($entry, $addon_settings["email"]);
				$phone_number_field = rgar( $entry, $addon_settings["phone_number"]);
				$message_field = rgar($entry,$addon_settings["message"]);
				$ip = rgar($entry, 'ip');
            
				$notifications = $form['notifications'];
				$to_email = "";
				
				
				foreach($notifications as $notification){
					if($notification['isActive'] == 1){
						if (($notification['toType'] == "email")&&($notification['to'] != '{admin_email}')){
							$to_email .= $notification['to'].',';
						}
					}
				}
			
				$to_email = rtrim($to_email,',');
				
				//Log the data in the database
				$wpdb->insert('wp_wpleadstream_contacts_v1',
							   array('contact_type' 	    => 'form',
							   		 'contact_first_name' 	=> $first_name_field ,
							   	     'contact_last_name'  	=> $last_name_field,
									 'contact_email' 		=> $email_field,
									 'contact_phone_number' => $phone_number_field,
									 'contact_message'		=> $message_field,
									 'email_forward_address'=> $to_email,
									 'ip_address'			=> $ip,
									 'call_status'			=> 'complete',
									 
							   ),
							   array('%s',
							   		 '%s',
							   		 '%s',
							   		 '%s',
							   		 '%s',
							   		 '%s',
							   		 '%s',
							   		 '%s',
							   		 '%s',
									)
							 );
							 
					
			}
        }

        /**
         * Override the form_settings_field() function and return the configuration for the Form Settings.
         * Updating is handled by the Framework.
         *
         * @param array $form The Form object
         *
         * @return array
         */
        public function form_settings_fields($form) {
           
		   $fields = GFAddOn::get_form_fields_as_choices( $form );
		   
		   $choices = array();
		   foreach($fields as $field){
		   	 $choice = array(
		               		'label' => esc_html__( $field['label'], 'WPLeadStream' ),
		                    'value' => $field['value'],
		               );
			 array_push($choices, $choice);
		   }
		   
		   
		    return array(
                array(
                    "title"  => __("WP Lead Stream Settings", "WPLeadStream"),
                    "fields" => array(
                        array(
                            "name"     => "enableWPLeadStream",
                            "tooltip"  => __("Activate this setting to track entries on this form."),
                            "label"    => __("WP Lead Stream Activate", "gravitycontacts"),
                            "onclick"  => "jQuery(this).closest('form').submit();", // refresh the page so show/hide the settings below. Settings are not saved until the save button is pressed.
                            "type"     => "checkbox",
                            "choices"  => array(
                                array(
                                    "label" => __("Activate this setting to track entries on this form.", "WPLeadStream"),
                                    "name"  => "isEnabled"
                                )
                            )
                        ),
                        
                        array(
		                    'label'   => esc_html__( 'First Name Field', 'WPLeadStream' ),
		                    'type'    => 'select',
		                    'name'    => 'first_name',
		                    'tooltip' => esc_html__( 'Select the first name field', 'WPLeadStream' ),
		                    'choices' => $choices
		                ),
		                
						array(
		                    'label'   => esc_html__( 'Last Name Field', 'WPLeadStream' ),
		                    'type'    => 'select',
		                    'name'    => 'last_name',
		                    'tooltip' => esc_html__( 'Select the last name field', 'WPLeadStream' ),
		                    'choices' => $choices
		                ),
		                
		                
		                array(
		                    'label'   => esc_html__( 'Email Field', 'WPLeadStream' ),
		                    'type'    => 'select',
		                    'name'    => 'email',
		                    'tooltip' => esc_html__( 'Select the email field', 'WPLeadStream' ),
		                    'choices' => $choices
		                ),
                        
						array(
		                    'label'   => esc_html__( 'Phone Number Field', 'WPLeadStream' ),
		                    'type'    => 'select',
		                    'name'    => 'phone_number',
		                    'tooltip' => esc_html__( 'Select the phone number field', 'WPLeadStream' ),
		                    'choices' => $choices
		                ),
						
						array(
		                    'label'   => esc_html__( 'Message Field', 'WPLeadStream' ),
		                    'type'    => 'select',
		                    'name'    => 'message',
		                    'tooltip' => esc_html__( 'Select the message field', 'WPLeadStream' ),
		                    'choices' => $choices
		                ),
						
						
                        // This field isn't strictly necessary. If you don't include one then a generic update button will be generated for you.
                        array(
                            "type"     => "save",
                            "value"    => __("Update WP Lead Stream Settings", "WPLeadStream"),
                            "messages" => array(
                                "success" => __("WP Lead Stream settings updated", "WPLeadStream"),
                                "error"   => __("There was an error while saving the WP Lead Stream Settings", "WPLeadStream")
                            )
                        )
                    )
                )
            );
        }
        

        /**
         * Define a custom title for the Add-On Settings page
         *
         * @return string
         */
        public function plugin_settings_title() {
            return "Gravity Forms WP Lead Stream Add-On Settings";
        }
		
        
		
        
    }
	new WPLeadStreamGFAddOn();

}


	