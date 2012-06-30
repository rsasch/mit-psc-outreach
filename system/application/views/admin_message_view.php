<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | Notification Management</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="/mit-psc-outreach/styles/main.css" rel="stylesheet" type="text/css" />
	<script src="/mit-psc-outreach/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="/mit-psc-outreach/scripts/common.js" type="text/javascript"></script>
</head>
<body class="admin">
<p class="skip"><a href="#content" id="top">skip to content</a></p>
<!-- begin header -->
<?php include("includes/header.php"); ?>	
<!-- end header -->
<!-- begin main container -->
<div class="container">
	<!-- begin main nav -->
	<div id="mainnav">
		<ul>
		<?php include("includes/nav_admin.php"); ?>
		</ul>
		<?php if (isset($userid)): ?>
		<p>Currently logged in as <?=$userkerb?>@mit.edu</p>
		<?php endif; ?>
	</div>
	<!-- end main nav -->
	<!-- begin content -->
	<div id="content">
		<p class="sitename">MIT Outreach Database</p>
		<h1 class="pagename">Notification Management</h1>
		<p>To edit automated email messages, type edits into the fields below.</p>
		<?=form_open("adminmessage/edit")?>
			<fieldset>
			<?php foreach ($messages as $message): ?>
				<div class="container">
					<label for="message<?=$message->message_id?>" class="heading"><?=$message->message_name?></label>
					<textarea id="message<?=$message->message_id?>" name="message<?=$message->message_id?>" rows="6" cols="46" class="bigtext"><?=$message->message_text?></textarea>
				</div>
			<?php endforeach; ?>
			</fieldset>
			<div class="buttons">
				<input type="submit" value="Save" name="save" />				
			</div>
		<?=form_close()?>
	</div>
	<!-- end content -->
</div>
<!-- end main container -->
<!-- begin footer -->
<?php include("includes/footer.php"); ?>
<!-- end footer -->
</body>
</html>
