<?php

/**
 * SwpmMailjetIntegration
 */

class SwpmMailjetIntegration {

	public function __construct() {
		if ( class_exists( 'SimpleWpMembership' ) ) {

			// Register some actions with the Simple WP Membership plugin's hooks
			add_action( 'swpm_addon_settings_section', array( &$this, 'settings_ui' ) );
			add_action( 'swpm_addon_settings_save', array( &$this, 'settings_save' ) );

			// On init, load the languages files
			add_action( 'init', array( &$this, 'swpm_load_plugin_textdomain' ) );

			// Insert the Newsletter field in the SWPM Registration form
			add_filter( 'swpm_registration_form_before_terms_and_conditions', array( &$this, 'add_newsletter_field_to_registration_form' ), 20 );

			// Insert the Newsletter field in the SWPM Profile Edit form
			add_filter( 'swpm_edit_profile_form_after_membership_level', array( &$this, 'add_newsletter_field_to_edit_form' ), 20 );

		}
	}

	// Function that load the translation files for this addon
	public function swpm_load_plugin_textdomain() {
		// Load the translation files
		$loaded = load_plugin_textdomain( SWPM_MAILJET_INTEGRATION_PLUGIN_NAME, false, SWPM_MAILJET_INTEGRATION_PLUGIN_NAME . '/languages' );
	}

	// Function that load the addon settings and show it in the Admin Pages
	public function settings_ui() {
		// Get the settings from WP
		$settings = SwpmSettings::get_instance();
		// Check if the Official Mailjet Plugin is installed and active or not
		$swpm_mji_mailjet_plugin_is_active = is_plugin_active('mailjet-for-wordpress/wp-mailjet.php');
		// Check if this SWPM Mailjet Integration addon is enabled or not
		$swpm_mji_enable                   = $settings->get_value( 'swpm-addon-mailjet-integration-enable' );
		// Extract the settings for this addon
		$swpm_mji_subscription_mode        = $settings->get_value( 'swpm-addon-mailjet-integration-subscription-mode' );

		// If the Official Mailjet plugin is not enabled, set the field to disable, so we can't use this addon
		if (!$swpm_mji_mailjet_plugin_is_active) {
			$swpm_mji_global_option_edit_status = 'disabled';
			$swpm_mji_enable = ''; // And force to disable this addon
		}
		else { // If the Official Mailjet plugin is enabled, allow the edit of the options
			$swpm_mji_global_option_edit_status = '';
		}

		// If the Mailjet Integration is not enabled, set the field to disable, so the other options cannot be edited
		$swpm_mji_options_edit_status  = empty($swpm_mji_enable) ? 'disabled' : '';

		// And show the Settings HTML Form
		require_once (SWPM_MAILJET_INTEGRATION_PLUGIN_FOLDER . '/views/settings.php');
	}

	// Function that save the addon settings
	public function settings_save() {
		// Show sucess message
		$message = array( 'succeeded' => true, 'message' => '<p>' . BUtils::_( 'Settings updated!' ) . '</p>' );
		SwpmTransfer::get_instance()->set( 'status', $message );

		// Get settings values from the Admin Form
		$swpm_mji_enable                 = filter_input( INPUT_POST, 'swpm-addon-mailjet-integration-enable' );
		$swpm_mji_subscription_mode      = filter_input( INPUT_POST, 'swpm-addon-mailjet-integration-subscription-mode' );

		// Save the settings to the WP DB
		$settings = SwpmSettings::get_instance();
		$settings->set_value( 'swpm-addon-mailjet-integration-enable', empty( $swpm_mji_enable ) ? "" : $swpm_mji_enable  );
		$settings->set_value( 'swpm-addon-mailjet-integration-subscription-mode', sanitize_text_field( $swpm_mji_subscription_mode ) );

		// Save the values
		$settings->save();
	}

	// Function that generate the HTML Form fields that will be inserted into SWPM Forms
	private function generate_mailjet_newsletter_html_field( $state) {
		// Init variables
		$position = "";
		$output = "";
		$show = "yes";

		// If state is 'hidden', check the checkbox and hide the field from the form
		if ( $state == "hidden" ) {
			$state = "checked disabled";
			$position = "style='opacity:0; position:absolute; left:-9999px;'";
			$show = "no";
		}
		// And if the state is not "checked", then uncheck it
		else if ( $state != "checked" ) {
			$state = "";
		}

		// If we want to show the field, add the first part of the row to the table
		if ($show == "yes") {
			$output .= "            <tr>\n";
			$output .= "                <td colspan='2' style='text-align: center;'>\n";
			$output .= "                <label>";
		}

		// Show the hidden field 'mailjet_subscribe_extra_field', which is mandatory to allow the Official Mailjet Pluginto to use the data from this HTML form
		$output .= "<input type='hidden' id='mailjet_subscribe_extra_field' name='mailjet_subscribe_extra_field' value='on' />";
		// And show the 'mailjet_subscribe_ok' checkbox, to allow the user to chose to Subscribe or not
		$output .= "<input type='checkbox' name='mailjet_subscribe_ok' id='mailjet_subscribe_ok' value='1' class='checkbox' " . $position . " " . $state . " />";

		// If we want to show the field, add the last part of the row the table
		if ($show == "yes") {
			$output .= " " . __('I want to subscribe to the Newsletter', SWPM_MAILJET_INTEGRATION_PLUGIN_NAME)."</label>";
			$output .= "                </td>";
			$output .= "            </tr>";
		}

		// Return the HTML code
		return $output;
	}

	// Function that will show the Newsletter field on the Registration Form
	public function add_newsletter_field_to_registration_form() {
		// Init value
		$output = '';

		// Check if the Official Mailjet Plugin is installed and active or not
		$swpm_mji_mailjet_plugin_is_active = is_plugin_active('mailjet-for-wordpress/wp-mailjet.php');

		// Check if this SWPM Mailjet Integration addon is enabled or not
		$settings = SwpmSettings::get_instance();
		$enabled  = $settings->get_value( 'swpm-addon-mailjet-integration-enable' );

		// If any of those two is not enabled, do nothing and exit now
		if (empty($enabled) || !$swpm_mji_mailjet_plugin_is_active) {
			return $output;
		}

		// Get the Subscription Mode, so we know how we should show the Newsletter subscription field
		$swpm_mji_subscription_mode = $settings->get_value('swpm-addon-mailjet-integration-subscription-mode');

		// Generate the HTML code that we will then insert into the SWPM Registration form
		$output = $this->generate_mailjet_newsletter_html_field($swpm_mji_subscription_mode);

		// Show the HTML code in the SWPM Registration form
		echo $output;
	}

	// Function that will show the Newsletter field on the Profile Edit Form
	public function add_newsletter_field_to_edit_form() {
		// Init value
		$output = '';

		// Check if the Official Mailjet Plugin is installed and active or not
		$swpm_mji_mailjet_plugin_is_active = is_plugin_active('mailjet-for-wordpress/wp-mailjet.php');

		// Check if this SWPM Mailjet Integration addon is enabled or not
		$settings = SwpmSettings::get_instance();
		$enabled  = $settings->get_value( 'swpm-addon-mailjet-integration-enable' );

		// If any of those two is not enabled, do nothing and exit now
		if ( empty( $enabled ) || !$swpm_mji_mailjet_plugin_is_active ) {
			return $output;
		}

		// Use SWPM to get the username of the current user
		$current_username = SwpmMemberUtils::get_logged_in_members_username();

		// Extract infos about this user
		$wp_user_info = get_user_by('login', $current_username);

		// If we've not been able to detect the User, exit the function now
		if (empty($wp_user_info)) {
			return $output;
		}

		// Export the User ID to a variable
		$wp_user_id = $wp_user_info->ID;

		// Extract the value from the Wordpress Metadata Table for te user
		$newsletter_state = (int)get_user_meta($wp_user_id, 'mailjet_subscribe_ok', true);

		// Convert the state to the correct values
		$current_subscription_state = ($newsletter_state == 1) ? 'checked' : '';

		// Generate the HTML code that we will then insert into the SWPM Profile Edit form
		$output = $this->generate_mailjet_newsletter_html_field($current_subscription_state);

		// Show the HTML code in the SWPM Profile Edit form
		echo $output;
	}
}
