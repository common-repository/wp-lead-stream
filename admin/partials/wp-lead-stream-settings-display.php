<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://edisonave.com
 * @since      1.0.0
 *
 * @package    Wp_Lead_Stream
 * @subpackage Wp_Lead_Stream/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap wp-lead-stream-panel clr">
	<h1>WP Lead Stream Settings</h1>
	
	
	<div class="left clr">

				<form method="post" action="<?php $this->admin_link("wp_lead_stream_settings_process", 'noheader=true'); ?>" >

					
					<div class="oceanwp-panels clr">

						<p class="description">
							Set these fields to enable call forwarding via twillio.
						<table class="form-table">
							<tbody>
								<tr>
									<th scope="row">
										<label for="voice">Voice</label>
									</th>
									<td>
										 <select name="voice">
										  <option value="man" <?php if ($voice == "man") echo 'selected="selected"'; ?>>man</option>
										  <option value="woman" <?php if ($voice == "woman") echo 'selected="selected"'; ?>>woman</option>
										  <option value="Alice" <?php if ($voice == "Alice") echo 'selected="selected"'; ?>>Alice</option>
										</select> 
										<br />What Voice would you like Twilio to use
									</td>
									
								</tr>
								
								<tr>
									<th scope="row">
										<label for="caller_greeting">Caller Greeting</label>
									</th>
									<td>
										<textarea name="caller_greeting" rows="2" cols="60"><?php echo $caller_greeting; ?></textarea>
										<br />Greeting played to the caller. Make is short and to the point.
									</td>
								</tr>
								
								<tr>
									<th scope="row">
										<label for="twilio_sid">Destination Number</label>
									</th>
									<td>
										<input name="forward_phone" type="text" id="forward_phone" value="<?php echo $forward_phone; ?>" class="regular-text">
										<br />Phone number to forward incomming calls to.
									</td>
								</tr>
								<tr>
									<th scope="row">
										<label for="whisper_message">Whisper Message</label>
									</th>
									<td>
										 <textarea name="whisper_message" rows="7" cols="60"><?php echo $whisper_message; ?></textarea>
										 <br />Leave empty for no whisper message.
									</td>
								</tr>
							</tbody>
						</table>

						
						<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p>
					</div>
				</form>
				
				<h3>Twillio Voice Webhooks</h3>
				Your URL is: <?php echo admin_url('admin-ajax.php'); ?>?action=wls_twillio

			</div>


</div>