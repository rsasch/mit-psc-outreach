#!/usr/bin/php

<?php 

/*
	Check for PSC programs that haven't been modified in 11 or 12 months or more
*/

error_reporting(0);
// $log .= date("D M j G:i:s") . " -- check_expirations started\n";

// get database setup from CodeIgniter 
define('BASEPATH', '/');
require_once('system/application/config/database.php');
$link = mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);
$db_selected = mysql_select_db($db['default']['database'], $link);

//**** 11 month notify
$program_sql = "SELECT program_id, admin_contact1_email, admin_contact2_email, program.title, email FROM program, user WHERE program.user_id = user.user_id && program.active_flag = '1' && 11month_flag = '0' AND program_moddate BETWEEN '0000-00-00' AND '" . date("Y-m-d",strtotime("-11 month")) . "' ORDER BY program_moddate";
$message_sql = "SELECT message_text from message where message_id ='10'";

// get message
$message_result = mysql_query($message_sql);
$temp = mysql_fetch_row($message_result);
$message = $temp[0];

//get programs
$program_result = mysql_query($program_sql);

// send messages to program admins
while ($program_result && $row = mysql_fetch_assoc($program_result)) {
	// mail message
	$to = $row["email"];
	$subject = "Update Outreach Database program listing: " . $row["title"];
	$headers = 'From: PSC Outreach Database <outreach-notify@mit.edu>' . "\r\n";
	$headers .= 'Reply-To: PSC Outreach Database <outreach-notify@mit.edu>' . "\r\n";
	$headers .= 'Cc: ' . $row["admin_contact1_email"] . ', ' . $row["admin_contact2_email"] . "\r\n";
	ini_set('sendmail_from', 'outreach-notify@mit.edu');	
	mail($to, $subject, $message, $headers);

	$message_sql = "UPDATE program SET 11month_flag = '1' WHERE program_id = '" . $row["program_id"] . "'";
	$message_result = mysql_query($message_sql);
}
//**** end 11 month notify


//**** 12 month notify
$program_sql = "SELECT program_id, admin_contact1_email, admin_contact2_email, program.title, email FROM program, user WHERE program.user_id = user.user_id && program.active_flag = '1' && 11month_flag = '1' AND program_moddate BETWEEN '0000-00-00' AND '" . date("Y-m-d",strtotime("-12 month")) . "' ORDER BY program_moddate";
$message_sql = "SELECT message_text from message where message_id ='11'";

// get message
$message_result = mysql_query($message_sql);
$temp = mysql_fetch_row($message_result);
$message = $temp[0];

//get programs
$program_result = mysql_query($program_sql);

// send messages to program admins
while ($program_result && $row = mysql_fetch_assoc($program_result)) {
	// mail message
	$to = $row["email"];
	$subject = "Final notice: Update Outreach Database listing: " . $row["title"];
	$headers = 'From: PSC Outreach Database <outreach-notify@mit.edu>' . "\r\n";
	$headers .= 'Reply-To: PSC Outreach Database <outreach-notify@mit.edu>' . "\r\n";
	$headers .= 'Cc: ' . $row["admin_contact1_email"] . ', ' . $row["admin_contact2_email"] . "\r\n";
	ini_set('sendmail_from', 'outreach-notify@mit.edu');	
	mail($to, $subject, $message, $headers);

	$message_sql = "UPDATE program SET 12month_flag = '1' WHERE program_id = '" . $row["program_id"] . "'";
	$message_result = mysql_query($message_sql);
}
//**** end 12 month notify


//**** 13 month inactivate
$program_sql = "SELECT program_id, admin_contact1_email, admin_contact2_email, program.title, email FROM program, user WHERE program.user_id = user.user_id && program.active_flag = '1' && 11month_flag = '1' && 12month_flag = '1' AND program_moddate BETWEEN '0000-00-00' AND '" . date("Y-m-d",strtotime("-13 month")) . "' ORDER BY program_moddate";
$message_sql = "SELECT message_text from message where message_id ='12'";

// get message
$message_result = mysql_query($message_sql);
$temp = mysql_fetch_row($message_result);
$message = $temp[0];

//get programs
$program_result = mysql_query($program_sql);

// send messages to program admins
while ($program_result && $row = mysql_fetch_assoc($program_result)) {
	// mail message
	$to = $row["email"];
	$subject = "Notice of program expiration: " . $row["title"];
	$headers = 'From: PSC Outreach Database <outreach-notify@mit.edu>' . "\r\n";
	$headers .= 'Reply-To: PSC Outreach Database <outreach-notify@mit.edu>' . "\r\n";
	$headers .= 'Cc: ' . $row["admin_contact1_email"] . ', ' . $row["admin_contact2_email"] . "\r\n";
	ini_set('sendmail_from', 'outreach-notify@mit.edu');	
	mail($to, $subject, $message, $headers);

	$message_sql = "UPDATE program SET 11month_flag = '0', 12month_flag = '0', program.active_flag = '0' WHERE program_id = '" . $row["program_id"] . "'";	
	$message_result = mysql_query($message_sql);
}
//**** end 13 month inactivate

mysql_close($link);

// $log .= date("D M j G:i:s") . " -- check_expirations finished\n\n";

// file_put_contents('/var/www/html/outreach/system/logs/log-check_expirations', $log, FILE_APPEND);

