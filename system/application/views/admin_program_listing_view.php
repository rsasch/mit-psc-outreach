<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | Programs</title>
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
		<div class="container">
			<div class="headings">
				<p class="sitename">MIT Outreach Database</p>
				<h1 class="pagename">Programs</h1>
			</div>
			<div class="toplink">
				<div class="outer">
					<div class="inner"><a href="/mit-psc-outreach/adminprogram/edit">+ Add a new program</a></div>
				</div>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<?php if (isset($message)): ?>
		<p class="message"><?=$message?></p>
		<?php endif; ?>
		<h2>Active programs</h2>
		<p>Click on the program name below to view program description. You may also edit the content, change the assigned program administrator, and/or make the program inactive.</p>
		<table cellspacing="0" class="data">
		<thead>
			<tr>
				<th>Program Name</th>
				<th>Submitted by</th>
				<th>Last Modified</th>
				<th>Options</th>
			</tr>
		</thead>
		<?php if (isset($activeprograms[0])): ?>
		<tbody>
			<?php $even_odd = ''; ?>
			<?php foreach ($activeprograms as $program): ?>
			<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
			<tr class="<?=$even_odd?>">
					<?php if ($userlevel == "0"): ?>
						<td><a href="/mit-psc-outreach/adminprogram/edit/<?=$program->program_id?>/list"><?=$program->title?></a></td>
					<?php else: ?>
						<td><a href="/mit-psc-outreach/adminprogram/preview/<?=$program->program_id?>/list"><?=$program->title?></a></td>
					<?php endif; ?>
				<td><?=$program->last_name?>, <?=$program->first_name?></td>
				<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				<td><a href="/mit-psc-outreach/adminprogram/inactivate/<?=$program->program_id?>">inactivate</a></td>
			<?php endforeach; ?>
		</tbody>
		</table>
		<?php else: ?>
		</table>
		<p class="nolisting">No active programs.</p>
		<?php endif; ?>
		<h2>Inactive programs</h2>
		<p>Click on the program name below to view program description. You may also edit the content, change the assigned program administrator, and/or make the program active.</p>
		<table cellspacing="0" class="data">
		<thead>
			<tr>
				<th>Program Name</th>
				<th>Submitted by</th>
				<th>Last Modified</th>
				<th>Options</th>
			</tr>
		</thead>
		<?php if (isset($inactiveprograms[0])): ?>
		<tbody>
			<?php $even_odd = ''; ?>
			<?php foreach ($inactiveprograms as $program): ?>
			<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
			<tr class="<?=$even_odd?>">
					<?php if ($userlevel == "0"): ?>
						<td><a href="/mit-psc-outreach/adminprogram/edit/<?=$program->program_id?>/approve"><?=$program->title?></a></td>
					<?php else: ?>
						<td><a href="/mit-psc-outreach/adminprogram/preview/<?=$program->program_id?>/approve"><?=$program->title?></a></td>
					<?php endif; ?>
				<td><?=$program->last_name?>, <?=$program->first_name?></td>
				<td><?=date("n/j/y", strtotime($program->program_moddate))?></td>
				<td><a href="/mit-psc-outreach/adminprogram/activate/<?=$program->program_id?>">activate</a></td>
			<?php endforeach; ?>
		</tbody>
		</table>
		<?php else: ?>
		</table>
		<p class="nolisting">No active programs.</p>
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
