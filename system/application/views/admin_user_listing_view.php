<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | Administrators</title>
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
		<p class="sitename">MIT Outreach Database</p>
		<h1 class="pagename">Administrators</h1>
		<h2>Active PSC administrators</h2>
		<p>Click on the name below to view and edit PSC administrator profile details.</p>
		<table cellspacing="0" class="data">
		<thead>
			<tr>
				<th>Name</th>
				<th>Dept</th>
				<th>Email</th>
			</tr>
		</thead>
		<?php if (isset($pscusers[0])): ?>
		<tbody>
			<?php $even_odd = ''; ?>
			<?php foreach ($pscusers as $user): ?>
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
		<p class="nolisting">No active PSC administrators.</p>
		<?php endif; ?>
		<h2>Active program administrators</h2>
		<p>Click on the name below to view and edit program administrator profile details.</p>
		<table cellspacing="0" class="data">
		<thead>
			<tr>
				<th>Name</th>
				<th>Dept</th>
				<th>Email</th>
			</tr>
		</thead>
		<?php if (isset($progusers[0])): ?>
		<tbody>
			<?php $even_odd = ''; ?>
			<?php foreach ($progusers as $user): ?>
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
		<p class="nolisting">No active program administrators.</p>
		<?php endif; ?>
		<h2>Inactive administrators</h2>
		<p>Click on the name below to view and edit profile details. To re-activate these administrators, add the administrator's email address to the Moira list <a href="mailto:outreach-progadmins@mit.edu">outreach-progadmins@mit.edu</a> for program administrators and <a href="mailto:outreach-pscadmin@mit.edu">outreach-pscadmin@mit.edu</a> for PSC administrators.</p>
		<table cellspacing="0" class="data">
		<thead>
			<tr>
				<th>Name</th>
				<th>Admin</th>
				<th>Dept</th>
				<th>MIT Kerberos ID</th>
			</tr>
		</thead>
		<?php if (isset($inactiveusers[0])): ?>
		<tbody>
			<?php $even_odd = ''; ?>
			<?php foreach ($inactiveusers as $user): ?>
			<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
			<tr class="<?=$even_odd?>">
				<td><a href="<?=base_url()?>adminuser/edit/<?=$user->user_id?>"><?=$user->last_name?>, <?=$user->first_name?></a></td>
				<td><?=$user->role_name?></td>
				<td><?=$user->dlc?></td>
				<td><?=$user->kerb?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
		<?php else: ?>
		</table>
		<p class="nolisting">No active program administrators.</p>
		<?php endif; ?>
	</div>
	<!-- end content -->
</div>
<!-- end main container -->
<!-- begin footer -->
<?php include("includes/footer.php"); ?>
<!-- end footer -->
</body>
</html>
