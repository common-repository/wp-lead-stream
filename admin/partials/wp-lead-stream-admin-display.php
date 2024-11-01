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
	<h1>WP Lead Stream</h1>
	<p>All your leads from this site in one place.</p>
	
	<div class="left clr">

				<h2>Leads Report</h2>
				<table id="leadstream" class="table table-striped table-bordered dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;">
					<thead>
						<tr>
							<th>Time</th>
							<th>Type</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Forward Email</th>
							<th>Forward Phone</th>
							<th>Status</th>
						</tr>
					</thead>
        			<tbody>
					<?php 
						foreach($lastfiveleads as $lead){
							print "<tr>";
							print "<td>".$lead->time."</td>";
							print "<td>".$lead->contact_type."</td>";
							print "<td>".$lead->contact_first_name."</td>";
							print "<td>".$lead->contact_last_name."</td>";
							print "<td>".$this->format_phone_us($lead->contact_phone_number)."</td>";
							print "<td>".$lead->contact_email."</td>";
							
							print "<td>".$lead->email_forward_address."</td>";
							
							print "<td>".$this->format_phone_us($lead->phone_forward)."</td>";
							print "<td>".$lead->call_status."</td>";
							print "</tr>";
						}
					?>
					</tbody>
        			<tfoot>
						<tr>
							<th>Time</th>
							<th>Type</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Forward Email</th>
							<th>Forward Phone</th>
							<th>Status</th>
						</tr>
					 </tfoot>
				</table>

	</div>


</div>