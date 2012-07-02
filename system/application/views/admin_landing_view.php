<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | <?php if ($userlevel == "0"): ?>PSC Administrator Database<?php else: ?>Program<?php endif; ?> Management</title>
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
	<div id="content">
		<div class="container">
			<div class="headings">
				<p class="sitename">MIT Outreach Database</p>
				<h1 class="pagename"><?php if ($userlevel == "0"): ?>PSC Administrator Database<?php else: ?>Program<?php endif; ?> Management</h1>
			</div>
			<div class="toplink">
				<div class="outer">
					<div class="inner"><a href="<?=base_url()?>adminprogram/edit">+ Add a new program</a></div>
				</div>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<?php if (isset($message)): ?>
		<p class="message"><?=$message?></p>
		<?php endif; ?>
		<p><strong>Welcome to the MIT Outreach Database, <?=$username?>, and thank you for your interest in adding your outreach programs to our web-based database.</strong></p>
		<?php if ($userlevel == "0"): ?>
			<h2>New admins pending approval</h2>
			<p>To approve these requests, you must add the requestor's email address to one of two Moira lists:</p>
			<ul>
				<li>To grant program administrators access to the database, add them to outreach-progadmins@mit.edu. This allows the user to manage their program submissions only.</li>
				<li>To grant PSC administrators access to the database, add them to outreach-pscadmin@mit.edu. This allows the user to manage the entire database.</li>
			</ul>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Name</th>
					<th>Dept</th>
					<th>Email</th>
				</tr>
			</thead>
			<?php if (isset($newusers[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($newusers as $user): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<td><a href="<?=base_url()?>adminuser/edit/<?=$user->user_id?>"><?=$user->last_name?>, <?=$user->first_name?></a></td>
					<td><?=$user->dlc?></td>	
					<td><?=$user->email?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">No new admins pending approval.</p>
			<?php endif; ?>
			<h2>New programs pending approval</h2>
			<p>Click on the program name below to review program description content, make edits, and approve submission of the program into the database.</p>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Program Name</th>
					<th>Submitted by</th>
					<th>Date Submitted</th>
				</tr>
			</thead>
			<?php if (isset($newprograms[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($newprograms as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<?php if ($userlevel == "0"): ?>
						<td><a href="<?=base_url()?>adminprogram/edit/<?=$program->program_id?>/approve"><?=$program->title?></a></td>
					<?php else: ?>
						<td><a href="<?=base_url()?>adminprogram/preview/<?=$program->program_id?>/approve"><?=$program->title?></a></td>
					<?php endif; ?>
					<td><?=$program->last_name?>, <?=$program->first_name?></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">No new programs pending approval.</p>
			<?php endif; ?>
			<h2>Revised programs pending approval</h2>
			<p>Click on the program name below to review the program description edits, make edits, and approve edits in the program listing.</p>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Program Name</th>
					<th>Revised by</th>
					<th>Date Revised</th>
				</tr>
			</thead>
			<?php if (isset($editedprograms[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($editedprograms as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<?php if ($userlevel == "0"): ?>
						<td><a href="<?=base_url()?>adminprogram/edit/<?=$program->program_id?>/approve"><?=$program->title?></a></td>
					<?php else: ?>
						<td><a href="<?=base_url()?>adminprogram/preview/<?=$program->program_id?>/approve"><?=$program->title?></a></td>
					<?php endif; ?>
					<td><?=$program->last_name?>, <?=$program->first_name?></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">No revised programs pending approval.</p>
			<?php endif; ?>
			<h2>Programs at risk of expiration</h2>
			<p></p>
			<p>The program administrators for these programs received a renewal notice, but have not yet renewed their program information. Their programs will become inactive if not edited by the expiration date below.</p>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Program Name</th>
					<th>Submitted By</th>
					<th>Expiration Date</th>
				</tr>
			</thead>
			<?php if (isset($expiringprograms[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($expiringprograms as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<?php if ($userlevel == "0"): ?>
						<td><a href="<?=base_url()?>adminprogram/edit/<?=$program->program_id?>/list"><?=$program->title?></a></td>
					<?php else: ?>
						<td><a href="<?=base_url()?>adminprogram/preview/<?=$program->program_id?>/list"><?=$program->title?></a></td>
					<?php endif; ?>
					<td><?=$program->last_name?>, <?=$program->first_name?></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate . " +13 month"))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">No programs at risk of expiration.</p>
			<?php endif; ?>
		<?php else: ?>
			<h2>Your active programs</h2>
			<p>Click on the program name below to review program description content. To propose edits to these programs click edit below.</p>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Program Name</th>
					<th>Last Modified</th>
				</tr>
			</thead>
			<?php if (isset($programs[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($programs as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<td><a href="<?=base_url()?>adminprogram/preview/<?=$program->program_id?>/list"><?=$program->title?></a></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">You have no active programs listed in the Outreach Database.</p>
			<?php endif; ?>
			<h2>Your pending new programs</h2>
			<p>These programs are awaiting approval by the Public Service Center database administrator. Contact <a href="mailto:outreach@mit.edu">outreach@mit.edu</a> with questions or if you wish to cancel your submission.</p>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Program Name</th>
					<th>Last Modified</th>
				</tr>
			</thead>
			<?php if (isset($newprograms[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($newprograms as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<td><a href="<?=base_url()?>adminprogram/preview/<?=$program->program_id?>/list"><?=$program->title?></a></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">You have no programs pending approval.</p>
			<?php endif; ?>
			<h2>Your pending un-submitted programs</h2>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Title</th>
					<th>Last Modified</th>
				</tr>
			</thead>
			<?php if (isset($unsubmitted[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($unsubmitted as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<td><a href="<?=base_url()?>adminprogram/preview/<?=$program->program_id?>/approve"><?=$program->title?></a></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">No pending un-submitted new programs.</p>
			<?php endif; ?>
			<h2>Your pending revised programs</h2>
			<p>The edits you proposed to these programs are awaiting review and approval by the Public Service Center database administrator. Contact <a href="mailto:outreach@mit.edu">outreach@mit.edu</a> with questions or if you wish to cancel your edits.</p>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Program Name</th>
					<th>Last Modified</th>
				</tr>
			</thead>
			<?php if (isset($editedprograms[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($editedprograms as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<td><a href="<?=base_url()?>adminprogram/preview/<?=$program->program_id?>/list"><?=$program->title?></a></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">You have no edited programs pending approval.</p>
			<?php endif; ?>
			<h2>Inactive programs</h2>
			<p>These programs have expired and no longer appear in the database because there was no activity on your program listing during a 12 month time-span. You may add a new program to the database by clicking the link at the top of this page.</p>
			<table cellspacing="0" class="data">
			<thead>
				<tr>
					<th>Program Name</th>
					<th>Last Modified</th>
				</tr>
			</thead>
			<?php if (isset($inactiveprograms[0])): ?>
			<tbody>
				<?php $even_odd = ''; ?>
				<?php foreach ($inactiveprograms as $program): ?>
				<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
				<tr class="<?=$even_odd?>">
					<td><?=$program->title?></td>
					<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
			</table>
			<?php else: ?>
			</table>
			<p class="nolisting">You have no inactive programs.</p>
			<?php endif; ?>
		<?php endif; ?>

	</div>
	<!-- end content -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end main container -->
<!-- begin footer -->
<?php include("includes/footer.php"); ?>
<!-- end footer -->
</body>
</html>
