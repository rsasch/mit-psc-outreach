<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | <?php if (isset($userkerb) && $user->kerb == $userkerb): ?>My Profile<?php else: ?><?=$mode?> User<?php endif; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="/mit-psc-outreach/styles/main.css" rel="stylesheet" type="text/css" />
	<script src="/mit-psc-outreach/scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="/mit-psc-outreach/scripts/common.js" type="text/javascript"></script>
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
		<h1 class="pagename"><?php if (isset($userkerb) && $user->kerb == $userkerb): ?>My Profile<?php else: ?><?=$mode?> User<?php endif; ?></h1>
		<?php echo validation_errors(); ?>
		<?php if (!isset($userid)): ?>
		<p>In order to create an account and add your outreach program to the database, you must be a member of the MIT community who administers an MIT outreach program. To obtain an account, you must answer "yes" to the following questions:</p>
		<ol>
			<li>Do you have a valid MIT certificate on your computer?<br />
			To obtain a certificate, go to: <a href="http://ist.mit.edu/services/certificates" rel="external">http://ist.mit.edu/services/certificates</a></li>
			<li>Does your program qualify as outreach?<br />
			To qualify, it must meet all three of these criteria:
			<ul>
				<li>Your program must in some way reach outwards toward the external community.</li>
				<li>Secondly, your program must be active and open. Outreach of this sort can be applied for and actually participated in by community members.</li>
				<li>Lastly, your program must be ongoing or cyclical in some way. This excludes, for example, a one-time lecture but can include lecture series as long as it satisfies the above criteria.</li>
			</ul></li>
		</ol>
		<p>If you have any questions about these criteria and whether you qualify, please email <a href="mailto:outreach@mit.edu">outreach@mit.edu</a>.</p>
		<p>If you answered "yes" to both questions, please provide your profile information below and submit your request. Once your account has been opened, you will be able to login, enter the details about your programs, and edit existing program entries. All fields are required.</p>
		<?php elseif ($user->user_id == $userid): ?>
		<p>To edit profile information, type edits into the fields below. All fields are required.</p>
		<?php else: ?>
		<p>PSC administrators may edit administrator profile information below.</p>
		<?php endif; ?>
		<?=form_open($controller . "/" . $mode . "/" . $user->user_id)?>
			<fieldset>
				<?php if (isset($user)): ?>
					<div class="container">
						<label for="kerb">Admin type</label>
						<input type="text" name="role_name" value="<?=set_value('role_name',$user->role_name)?>" id="role_name" maxlength="50" readonly="readonly" class="readonly" />
					</div>
				<?php endif; ?>
				<div class="container required">
					<label for="first_name">First Name</label>
					<input type="text" name="first_name" value="<?=set_value('name',$user->first_name)?>" id="first_name" class="text" maxlength="50" />
				</div>
				<div class="container required">
					<label for="last_name">Last Name</label>
					<input type="text" name="last_name" value="<?=set_value('name',$user->last_name)?>" id="last_name" class="text" maxlength="50" />
				</div>
				<div class="container required">
					<label for="kerb">MIT Kerberos ID<br />(the ID before the @mit.edu)</label>
					<input type="text" name="kerb" value="<?=set_value('kerb',$user->kerb)?>" id="kerb" maxlength="50"<?php if($mode == "edit"): ?> readonly="readonly" class="readonly"<?php else: ?> class="text"<?php endif; ?> />
				</div>
				<div class="container required">
					<label for="title">Title</label>
					<input type="text" name="title" value="<?=set_value('title',$user->title)?>" id="title" class="text" maxlength="100" />
				</div>
				<div class="container required">
					<label for="dlc">Dept/Lab/Center/Office</label>
					<input type="text" name="dlc" value="<?=set_value('dlc',$user->dlc)?>" id="dlc" class="text" maxlength="100" />
				</div>
				<div class="container required">
					<label for="address">MIT location</label>
					<input type="text" name="address" value="<?=set_value('email',$user->address)?>" id="address" class="text" maxlength="50" />
				</div>
				<div class="container required">
					<label for="email">MIT email</label>
					<input type="text" name="email" value="<?=set_value('email',$user->email)?>" id="email" class="text" maxlength="50" />
				</div>
				<div class="container required">
					<label for="phone">Phone</label>
					<input type="text" name="phone" value="<?=set_value('phone',$user->phone)?>" id="phone" class="text" maxlength="20" />
				</div>
			</fieldset>
			<div class="buttons">
				<input type="hidden" name="user_id" value="<?=set_value('user_id',$user->user_id)?>" class="hidden" />
				<?php if ($userlevel == "0" && $user->add_approval_flag == "1"): ?>
				<input type="submit" value="Deny" name="deny" />
				<input type="submit" value="Approve" name="approve" />
				<?php else: ?>
				<input type="submit" value="Save" name="save" />
				<?php endif; ?>
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
