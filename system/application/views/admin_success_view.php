<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | Confirmation of program submission</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="<?=base_url()?>styles/main.css" rel="stylesheet" type="text/css" />
	<script src="<?=base_url()?>scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>scripts/common.js" type="text/javascript"></script>
</head>
<?php if (isset($userid)): ?>
<body class="admin">
<?php else: ?>
<body>
<?php endif; ?>
<p class="skip"><a href="#content" id="top">skip to content</a></p>
<!-- begin header -->
<?php include("includes/header.php"); ?>	
<!-- end header -->
<!-- begin main container -->
<div class="container">
	<!-- begin main nav -->
	<div id="mainnav">
		<ul>
		<?php if (isset($userid)): ?>
		<?php include("includes/nav_admin.php"); ?>
		<?php else: ?>
		<?php include("includes/nav_public.php"); ?>
		<?php endif; ?>
		</ul>
		<?php if (isset($userid)): ?>
		<p>Currently logged in as <?=$userkerb?>@mit.edu</p>
		<?php endif; ?>
	</div>
	<!-- end main nav -->
	
	<!-- begin content -->
	<div id="content" class="validate">
		<p class="sitename">MIT Outreach Database</p>
		<h1 class="pagename">Confirmation of program submission</h1>
		<h2>Your program has been submitted</h2>
		<p>Thank you for submitting your outreach program for inclusion in the MIT Outreach Database! The Public Service Center database administrator will get back to you within a week.</p>
		<p>We want to make sure your program information stays current. Once your program is included, you may make edits to it at any time. If you haven't made any edits in 12 months, we'll contact you to remind you to confirm the accuracy of the information.</p>
		<h2>Do you know of other MIT outreach programs that are not included the database?</h2>
		<p>Let us know at <a href="mailto:outreach@mit.edu">outreach@mit.edu</a> and please also encourage the program administrator to sign up for an outreach account via our homepage: <a href="<?=base_url()?>"><?=base_url()?></a>.</p>
		<h2>Do you need volunteers to help with your outreach program?</h2>
		<p>List your volunteer opportunity in the Public Service Center's weekly e-bulletin. Submit your information here: <a href="http://mit.edu/mitpsc/guides/csb-posting-form.html" rel="external">http://mit.edu/mitpsc/guides/csb-posting-form.html</a></p>
		<h2>Questions about the Outreach Database?</h2>
		<p>We'd love to hear from you. Please contact Kristi Gundrum Kebinger, MIT Public Service Center, <a href="mailto:outreach@mit.edu">outreach@mit.edu</a>, x3-8968.</p>
		<p><a href="<?=base_url()?>admin">Return to Program Management homepage</a></p>
	</div>
	<!-- end content -->
</div>
<!-- end main container -->
<!-- begin footer -->
<?php include("includes/footer.php"); ?>
<!-- end footer -->
</body>
</html>
