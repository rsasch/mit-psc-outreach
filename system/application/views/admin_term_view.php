<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>PSC Outreach Database | Manage Search Criteria</title>
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
		<h1 class="pagename">Manage Search Criteria</h1>
		<p>Use the add a new search criteria function sparingly. If you do add new criteria, be sure to update the program information for all applicable programs.</p>
		<p>If you wish to delete existing search criteria, this request must be made via IS&amp;T.</p>
		<?php echo validation_errors(); ?>
		<?php $i = 1; ?>
		<?php foreach ($allTerms as $category => $terms): ?>
			<form action="<?=site_url("adminterm/add")?>" method="post">
			<h2><?=$category?></h2>
			<fieldset class="category">
				<ul>
				<?php $even_odd = ''; ?>
				<?php foreach ($terms as $term): ?>
					<?php $even_odd = ( 'odd' != $even_odd ) ? 'odd' : ''; ?>
					<li class="<?=$even_odd?>"><?=$term->term_name?></li>
				<?php endforeach; ?>
				</ul>
				<div class="container required">
					<label class="skip" for="term_name">New criterion</label>
					<input type="text" name="term_name" value="" id="term_name" class="text prompt" maxlength="50" />
					<input type="hidden" name="category_id" value="<?=$categories[$i-1]->category_id?>" class="hidden" />
					<input type="submit" value="Add" name="submit" />
				</div>
			</fieldset>
			<?php $i++; ?>
			</form>
		<?php endforeach; ?>
	</div>
	<!-- end content -->
</div>
<!-- end main container -->
<!-- begin footer -->
<?php include("includes/footer.php"); ?>
<!-- end footer -->
</body>
</html>
