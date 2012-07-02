<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | <?=$mode?> Program</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="<?=base_url()?>styles/main.css" rel="stylesheet" type="text/css" />
	<script src="<?=base_url()?>scripts/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>scripts/common.js" type="text/javascript"></script>
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
	<div id="content" class="validate">
		<p class="sitename">MIT Outreach Database</p>
		<h1 class="pagename"><?=$mode?> Program</h1>
		<?php echo validation_errors(); ?>
		<?php if ($mode == "add"): ?>
			<p>Please complete the fields below. Required fields are indicated with an asterisk.</p>
			<p>You may save your inputted information by clicking the "save for later" link at the bottom of the page and then return to complete the form later.</p>
		<?php elseif ($userlevel != '0'): ?>
			<p>Make your edits in the fields below and then submit the listing to the Public Service Center database administrator.</p>
		<?php endif; ?>
		<form action="http://localhost:8888/mit-psc-outreach/<?=("adminprogram/edit/" . $program->program_id . "/" . $mode)?>" method="post" enctype="multipart/form-data">		
			<fieldset>
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="hidden" />
				<input type="hidden" name="program_id" value="<?=set_value('program_id',$program->program_id)?>" class="hidden" />
				<div class="container required">
					<label for="title">Program Title</label>
					<input type="text" name="title" value="<?=set_value('title',$program->title)?>" id="title" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->title_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->title_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="dlc">Sponsoring MIT Dept/Lab/Center/Office</label>
					<input type="text" name="dlc" value="<?=set_value('dlc',$program->dlc)?>" id="dlc" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->dlc_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->dlc_moddate))?></p>
					<?php endif; ?>
				</div>
				<h2>Primary Public Contact (PPC)</h2>
				<p>PPCs receive public inquiries because their contact information will appear in the database in the program entry for public viewing. We require two PPCs in case one person is no longer reachable or affiliated with the program.</p>
				<div class="container required">
					<label for="public_contact1_name">Name</label>
					<input type="text" name="public_contact1_name" value="<?=set_value('public_contact1_name',$program->public_contact1_name)?>" id="public_contact1_name" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->public_contact1_name_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact1_name_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container">
					<label for="public_contact1_org">Company/Org</label>
					<input type="text" name="public_contact1_org" value="<?=set_value('public_contact1_org',$program->public_contact1_org)?>" id="public_contact1_org" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->public_contact1_org_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact1_org_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="public_contact1_address">Address<span class="skip" id="public_contact1_address_maxlength">255</span></label>
					<textarea name="public_contact1_address" id="public_contact1_address" rows="6" cols="26" class="text"><?=set_value('public_contact1_address',$program->public_contact1_address)?></textarea>
					<?php if ($userlevel == "0" && isset($program->public_contact1_address_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact1_address_moddate))?></p>
					<?php endif; ?>
					<p id="public_contact1_address_notify" class="skip notify">&nbsp;</p>
				</div>
				<div class="container required">
					<label for="public_contact1_phone">Phone</label>
					<input type="text" name="public_contact1_phone" value="<?=set_value('public_contact1_phone',$program->public_contact1_phone)?>" id="public_contact1_phone" class="text" maxlength="20" />
					<?php if ($userlevel == "0" && isset($program->public_contact1_phone_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact1_phone_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="public_contact1_email">Email</label>
					<input type="text" name="public_contact1_email" value="<?=set_value('public_contact1_email',$program->public_contact1_email)?>" id="public_contact1_email" class="text" maxlength="50" />
					<?php if ($userlevel == "0" && isset($program->public_contact1_email_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact1_email_moddate))?></p>
					<?php endif; ?>
				</div>
				<h2>Secondary Public Contact</h2>
				<div class="container clone">
					<input type="checkbox" name="clone_public_1" id="clone_public_1" value="public2" />
					<label for="clone_public_1">make same as primary public contact</label>
				</div>
				<div class="container">
					<label for="public_contact2_name">Name</label>
					<input type="text" name="public_contact2_name" value="<?=set_value('public_contact2_name',$program->public_contact2_name)?>" id="public_contact2_name" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->public_contact2_name_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact2_name_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container">
					<label for="public_contact2_org">Company/Org</label>
					<input type="text" name="public_contact2_org" value="<?=set_value('public_contact2_org',$program->public_contact2_org)?>" id="public_contact2_org" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->public_contact2_org_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact2_org_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container">
					<label for="public_contact2_address">Address<span class="skip" id="public_contact2_address_maxlength">255</span></label>
					<textarea name="public_contact2_address" id="public_contact2_address" rows="6" cols="26" class="text"><?=set_value('public_contact2_address',$program->public_contact2_address)?></textarea>
					<?php if ($userlevel == "0" && isset($program->public_contact2_address_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact2_address_moddate))?></p>
					<?php endif; ?>
					<p id="public_contact2_address_notify" class="skip notify">&nbsp;</p>
				</div>
				<div class="container">
					<label for="public_contact2_phone">Phone</label>
					<input type="text" name="public_contact2_phone" value="<?=set_value('public_contact2_phone',$program->public_contact2_phone)?>" id="public_contact2_phone" class="text" maxlength="20" />
					<?php if ($userlevel == "0" && isset($program->public_contact2_phone_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact2_phone_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container">
					<label for="public_contact2_email">Email</label>
					<input type="text" name="public_contact2_email" value="<?=set_value('public_contact2_email',$program->public_contact2_email)?>" id="public_contact2_email" class="text" maxlength="50" />
					<?php if ($userlevel == "0" && isset($program->public_contact2_email_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->public_contact2_email_moddate))?></p>
					<?php endif; ?>
				</div>
				<h2>Administrative Contacts (AC)</h2>
				<p>ACs are accountable for managing the program and its listing and will only be used by Public Service Center staff to contact you about your program listing. ACs should have MIT certificates. Moira lists are also allowed. We require two in case one of the contacts is no longer reachable or affiliated with the program.    ACs may be the same as public contacts.</p>
				<h3>Primary Administrative Contact (APC)</h3>
				<div class="container clone">
					<input type="checkbox" name="clone_public_2" id="clone_public_2" value="admin1" />
					<label for="clone_public_2">make same as primary public contact</label>
				</div>
				<div class="container required">
					<label for="admin_contact1_name">Name</label>
					<input type="text" name="admin_contact1_name" value="<?=set_value('admin_contact1_name',$program->admin_contact1_name)?>" id="admin_contact1_name" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->admin_contact1_name_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact1_name_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="admin_contact1_dlc">Office name and job title</label>
					<input type="text" name="admin_contact1_dlc" value="<?=set_value('admin_contact1_dlc',$program->admin_contact1_dlc)?>" id="admin_contact1_dlc" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->admin_contact1_dlc_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact1_dlc_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="admin_contact1_address">Address<span class="skip" id="admin_contact1_address_maxlength">255</span></label>
					<textarea name="admin_contact1_address" id="admin_contact1_address" rows="6" cols="26" class="text"><?=set_value('admin_contact1_address',$program->admin_contact1_address)?></textarea>
					<?php if ($userlevel == "0" && isset($program->admin_contact1_address_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact1_address_moddate))?></p>
					<?php endif; ?>
					<p id="admin_contact1_address_notify" class="skip notify">&nbsp;</p>
				</div>
				<div class="container required">
					<label for="admin_contact1_phone">Phone</label>
					<input type="text" name="admin_contact1_phone" value="<?=set_value('admin_contact1_phone',$program->admin_contact1_phone)?>" id="admin_contact1_phone" class="text" maxlength="20" />
					<?php if ($userlevel == "0" && isset($program->admin_contact1_phone_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact1_phone_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="admin_contact1_email">Email</label>
					<input type="text" name="admin_contact1_email" value="<?=set_value('admin_contact1_email',$program->admin_contact1_email)?>" id="admin_contact1_email" class="text" maxlength="50" />
					<?php if ($userlevel == "0" && isset($program->admin_contact1_email_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact1_email_moddate))?></p>
					<?php endif; ?>
				</div>
				<h3>Secondary Administrative Contact (SAC)</h3>
				<div class="container clone">
					<input type="checkbox" name="clone_public_3" id="clone_public_3" value="admin2" />
					<label for="clone_public_3">make same as primary public contact</label>
				</div>
				<div class="container required">
					<label for="admin_contact2_name">Name</label>
					<input type="text" name="admin_contact2_name" value="<?=set_value('admin_contact2_name',$program->admin_contact2_name)?>" id="admin_contact2_name" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->admin_contact2_name_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact2_name_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="admin_contact2_dlc">Office name and job title</label>
					<input type="text" name="admin_contact2_dlc" value="<?=set_value('admin_contact2_dlc',$program->admin_contact2_dlc)?>" id="admin_contact2_dlc" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->admin_contact2_dlc_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact2_dlc_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="admin_contact2_address">Address<span class="skip" id="admin_contact2_address_maxlength">255</span></label>
					<textarea name="admin_contact2_address" id="admin_contact2_address" rows="6" cols="26" class="text"><?=set_value('admin_contact2_address',$program->admin_contact2_address)?></textarea>
					<?php if ($userlevel == "0" && isset($program->admin_contact2_address_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact2_address_moddate))?></p>
					<?php endif; ?>
					<p id="admin_contact2_address_notify" class="skip notify">&nbsp;</p>
				</div>
				<div class="container required">
					<label for="admin_contact2_phone">Phone</label>
					<input type="text" name="admin_contact2_phone" value="<?=set_value('admin_contact2_phone',$program->admin_contact2_phone)?>" id="admin_contact2_phone" class="text" maxlength="20" />
					<?php if ($userlevel == "0" && isset($program->admin_contact2_phone_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact2_phone_moddate))?></p>
					<?php endif; ?>
				</div>
				<div class="container required">
					<label for="admin_contact2_email">Email</label>
					<input type="text" name="admin_contact2_email" value="<?=set_value('admin_contact2_email',$program->admin_contact2_email)?>" id="admin_contact2_email" class="text" maxlength="50" />
					<?php if ($userlevel == "0" && isset($program->admin_contact2_email_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->admin_contact2_email_moddate))?></p>
					<?php endif; ?>
				</div>
				<h2>Program Details</h2>
				<div class="container required">
					<label for="description">Description<span class="skip" id="description_maxlength">1000</span></label>
					<textarea name="description" id="description" rows="6" cols="26" class="text"><?=set_value('description',$program->description)?></textarea>
					<?php if ($userlevel == "0" && isset($program->description_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->description_moddate))?></p>
					<?php endif; ?>
					<p id="description_notify" class="notify">&nbsp;</p>
				</div>
				<p>Provide a one-sentence description of your program that will be shown on the search results page under the name your program. </p>
				<div class="container required">
					<label for="description_short">Search blurb<span class="skip" id="description_short_maxlength">150</span></label>
					<textarea name="description_short" id="description_short" rows="6" cols="26" class="text"><?=set_value('description_short',$program->description_short)?></textarea>
					<?php if ($userlevel == "0" && isset($program->description_short_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->description_short_moddate))?></p>
					<?php endif; ?>
					<p id="description_short_notify" class="notify">&nbsp;</p>
				</div>
				<p>Add any aspects of interest, and be sure to include likely search elements like these: Who is eligible to participate? Is it open to individuals or groups? How frequently does it run? Is it free or is there a fee?  What criteria do you have for participants? To participate in this program who should do the requesting (individuals, teachers, etc.)? What is the format (lecture, research, tour, experiments, classes, etc.)?</p>
				<div class="container required">
					<label for="additional_info">Additional Details<span class="skip" id="additional_info_maxlength">500</span></label>
					<textarea name="additional_info" id="additional_info" rows="6" cols="26" class="text"><?=set_value('additional_info',$program->additional_info)?></textarea>
					<?php if ($userlevel == "0" && isset($program->additional_info_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->additional_info_moddate))?></p>
					<?php endif; ?>
					<p id="additional_info_notify" class="notify">&nbsp;</p>
				</div>
				<div class="container">
					<label for="url">Program website</label>
					<input type="text" name="url" value="<?=set_value('url',$program->url)?>" id="url" class="text" maxlength="100" />
					<?php if ($userlevel == "0" && isset($program->url_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->url_moddate))?></p>
					<?php endif; ?>
				</div>
				<?php if ($userlevel == "0"): ?>
				<div class="container required">
					<label for="user_id">Program administrator</label>
					<select id="user_id" name="user_id">
					<option value="">-- select --</option>
					<?php foreach ($users as $user): ?>
						<?php if ($user->active_flag == "1"): ?>
						<option value="<?=$user->user_id?>"<?php if ($user->user_id == $program->user_id): ?> selected="selected"<?php endif;?>><?=$user->last_name?>, <?=$user->first_name?></option>
						<?php endif; ?>
					<?php endforeach; ?>
					</select>
				</div>
				<?php else: ?>
					<input type="hidden" name="user_id" value="<?=$userid?>" class="hidden" />					
				<?php endif; ?>
			</fieldset>
			<h2>Search Criteria</h2>
			<p>These criteria are how Outreach Database users will find your program. You must select at least one box in each section and you may check all that apply. Email <a href="mailto:outreach@mit.edu">outreach@mit.edu</a> with suggested criteria to add in the future.</p>
			<?php include("includes/term_checkboxes.php"); ?>
			<h2>Almost done!</h2>
			<p>If you are finished entering all required information about your program, please proceed to preview your information. <strong>You will be able to submit your program from the preview page.</strong> If you would like to come back later to complete your submission you can save it for later.</p>
			<fieldset>
				<h2><label for="photo">Program Image</label></h2>
				<p>Image file cannot be larger than 1MB and will be re-sized if more than 156 pixels in width.</p>
				<div class="container">
					<input type="button" name="clear_photo" id="clear_photo" value="Clear" /><input type="file" name="photo" id="photo" class="file" />
					<?php if ($userlevel == "0" && isset($program->photo_path_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->photo_path_moddate))?></p>
					<?php endif; ?>
					<?php if (isset($program->photo_path)): ?>
					<div class="clear">&nbsp;</div>
					<p><img src="<?=base_url()?>images/programs/<?=set_value('photo_path',$program->photo_path)?>" id="photo_path" alt="" />
					<input type="hidden" name="empty_photo" value="" class="hidden" /></p>
					<?php endif; ?>
				</div>
				<h2><label for="logo">Sponsor Image</label></h2>
				<p>Image file cannot be larger than 1MB and will be re-sized if more than 156 pixels in width.</p>
				<div class="container">
					<input type="button" name="clear_logo" id="clear_logo" value="Clear" />
					<input type="file" name="logo" id="logo" class="file" />
					<?php if ($userlevel == "0" && isset($program->logo_path_moddate)): ?>
						<p class="moddate"><?=date("m/d/y", strtotime($program->logo_path_moddate))?></p>
					<?php endif; ?>
					<?php if (isset($program->logo_path)): ?>
					<div class="clear">&nbsp;</div>
					<p><img src="<?=base_url()?>images/programs/<?=set_value('photo_path',$program->logo_path)?>" id="logo_path" alt="" />
					<input type="hidden" name="empty_logo" value="" class="hidden" /></p>
					<?php endif; ?>
				</div>
			</fieldset>
			<div class="buttons">
				<input type="submit" value="Save for later" name="save" />				
				<input type="submit" value="Preview program information" name="preview" />				
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
