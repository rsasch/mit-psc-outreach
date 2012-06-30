<?php 

/*
	Synchronize users between moira list files and PSC database
*/

// error_reporting(E_ALL);
error_reporting(0);

define('BASEPATH', '/');

$log .= date("D M j G:i:s") . " -- synch_users started\n";

$notifylist = "/usr/local/dcm/psc/notifylist";
$pscadminlist = "/usr/local/dcm/psc/pscadminlist";
$projadminlist = "/usr/local/dcm/psc/progadminslist";

// Moira list user ids
if($fh = fopen($pscadminlist,"r")) {
	$adminList[0] = array();
	while (!feof($fh)){
		$user = trim(fgets($fh,9999));
		if ($user) {
			array_push($adminList[0], $user);
		}
	}
	fclose($fh);
}

if($fh = fopen($notifylist,"r")) {
	while (!feof($fh)){
		$user = trim(fgets($fh,9999));
		if ($user) {
			array_push($adminList[0], $user);
		}
	}
	fclose($fh);
}

if($fh = fopen($projadminlist,"r")) {
	$adminList[1] = array();
	while (!feof($fh)){
		$user = trim(fgets($fh,9999));
		if ($user) {
			array_push($adminList[1], $user);
		}
	}
	fclose($fh);
}


// get database setup from CodeIgniter 
require_once('system/application/config/database.php');
$link = mysql_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);
$db_selected = mysql_select_db($db['default']['database'], $link);

// put all users currently in database into an array of email addresses/kerbs
$sql = "SELECT kerb FROM user WHERE  role_id = 0";
$result = mysql_query($sql);
$DBusers[0] = array();
while ($row = mysql_fetch_row($result)) {
	array_push($DBusers[0], $row[0]);
}

$sql = "SELECT kerb FROM user WHERE  role_id = 1";
$result = mysql_query($sql);
$DBusers[1] = array();
while ($row = mysql_fetch_row($result)) {
	array_push($DBusers[1], $row[0]);
}

// find users in Moira list that are not in the DB or inactive in the DB
foreach ($adminList as $role_id => $users) {
	foreach ($adminList[$role_id] as $user) {
		$sql = "SELECT * FROM user where kerb = '" . $user . "'";
		$result = mysql_query($sql);
		if (mysql_num_rows($result) < 1) {
			$sql = "INSERT INTO user (kerb, email, role_id, active_flag, add_approval_flag) VALUES('" . $user . "','" . $user . "@mit.edu','" . $role_id . "','1','0')";
			$result = mysql_query($sql);
		}
		else {
			$returneduser = mysql_fetch_assoc($result);
			if ($returneduser["active_flag"] == "0" || $returneduser["role_id"] != $role_id) {

				$sql = "UPDATE user SET active_flag = '1',  role_id = '" . $role_id . "' where kerb = '" . $user . "'";
				$result = mysql_query($sql);
			}
		}
	}
}

// find users in DB that are not in the Moira list
foreach ($DBusers as $userlist) {
	foreach ($userlist as $user) {
		if (!in_array($user, $adminList[0]) && !in_array($user, $adminList[1])) {
			$sql = "UPDATE user SET active_flag = '0' where kerb = '" . $user . "'";
			$result = mysql_query($sql);
		}
	}
}

mysql_close($link);

$log .= date("D M j G:i:s") . " -- synch_users finished\n\n";

file_put_contents('/var/www/html/outreach/system/logs/log-synch_users', $log, FILE_APPEND);
