<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="<?=base_url()?>styles/main.css" rel="stylesheet" type="text/css" />
	<script src="<?=base_url()?>scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>scripts/common.js" type="text/javascript"></script>
</head>
<body class="preview">
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
	
	<div class="program">
		<p class="sitename">MIT Outreach Database</p>
		<h1 class="pagename">Preview Program</h1>
		<?php include("includes/program_details.php"); ?>
		<div class="clear">&nbsp;</div>
		<h4>Administrative Contacts</h4>
		<?php if ($program->admin_contact1_name): ?>
		<p><a href="mailto:<?=$program->admin_contact1_email?>"><?=$program->admin_contact1_name?></a><br />
		<?=$program->admin_contact1_address?><br />
		Phone: <?=$program->admin_contact1_phone?></a></p>
		<?php endif; ?>
		<?php if ($program->admin_contact2_name): ?>
		<p><a href="mailto:<?=$program->admin_contact2_email?>"><?=$program->admin_contact2_name?></a><br />
		<?=$program->admin_contact2_address?><br />
		Phone: <?=$program->admin_contact2_phone?></a></p>
		<?php endif; ?>
		<h4>Search text</h4>
		<p>The following text will not appear in your program profile but will be displayed in on the search results page" with the text below it.</p>
		<p><?=$program->description_short?></p>

		<?php if ($mode != "list" || $program->add_inprogress_flag == '1'): ?>
		<p>Your program has not yet been submitted. You may go back and make edits, save the content you've entered, or submit it now.</p>
		<?php endif; ?>
		<form action="http://localhost:8888/mit-psc-outreach/<?=("adminprogram/edit/" . $program->program_id . "/$mode")?>" method="post">
			<div class="buttons">
				<input type="hidden" name="mode" value="<?=$mode?>" class="hidden" />
				<input type="submit" value="Edit program" name="edit" />		
				<?php if ($mode == "approve"): ?>
					<input type="submit" value="Approve" name="approve" />
					<input type="submit" value="Deny" name="deny" />
				<?php elseif ($mode != "list" || $program->add_inprogress_flag == '1'): ?>
					<input type="submit" value="Save for later" name="save" />
					<input type="submit" value="Submit" name="submit" />
				<?php endif; ?>
			</div>
		</form>
	</div>
	<!-- end content -->
</div>
<!-- end main container -->
<!-- begin footer -->
<?php include("includes/footer.php"); ?>
<!-- end footer -->
</body>
</html>
