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
<body<?php if(isset($css_class)):?> class="<?=$css_class?>"<?php endif; ?>>
<p class="skip"><a href="#content" id="top">skip to content</a></p>
<!-- begin header -->
<?php include("includes/header.php"); ?>	
<!-- end header -->
<!-- begin main container -->
<div class="container">
	<!-- begin main nav -->
	<ul id="mainnav">
		<?php include("includes/nav_public.php"); ?>
	</ul>
	<!-- end main nav -->
	
	<!-- begin content -->
	<div id="content">
		<h1 class="sitename">MIT Outreach Database</h1>
		<h2 class="subhead">Your connection to outreach opportunities at MIT</h2>
		<form action="<?=base_url()?>index.php/home/search" method="post">
		<div id="search">
			<p class="intro">Welcome! MIT’s Outreach Database is a portal for learning about the wide range of MIT’s outreach programs offered to children, families, teachers, adults, and many others. Use this website as a tool to gain information about the amazing scope and depth of the great programming MIT offers the community.  Find out more about the purpose of this site and our definition of an outreach program at the <a href="<?=base_url()?>index.php/about">about us link</a>.</p>
			<p class="intro">Search the database using the keyword search and criteria below. Entering more criteria will net more limited results.</p>
			<hr />
			<h2><?=$heading?></h2>
			<fieldset>
			<div class="container">
				<label for="keywords" class="skip">Keyword search</label>
				<input type="text" name="keywords" id="keywords" class="keywords prompt" value="<?php if (isset($keywords)) print $keywords ?>" />
				<input type="submit" value="Search" name="search" id="topbutton" />
			</div>
			<div class="clear">&nbsp;</div>
			<p class="viewall"><a href="<?=base_url()?>index.php/home/search">View all programs</a></p>
			</fieldset>
			<hr />
			<h2 class="criteria">Search by criteria</h2>
			<?php include("includes/term_checkboxes.php"); ?>
			<div class="buttons">
				<input type="submit" value="<?=$searchbutton?>" name="search" />
			</div>
		</div>
		<?php if($css_class != "results"):?>
		</form>
		<?php else: ?>
		<div id="results">
			<div class="container">
				<div class="headings">
					<h2>Search Results</h2>
				</div>
				<div class="toplink">
					<div class="print"><p><a href="javascript:print()">Print Page</a></p></div>
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<?php if ($programs): ?>
			<?php include("includes/pagination_results.php"); ?>
			<?php foreach ($programs as $program): ?>
			<h3><a href="<?=base_url()?>index.php/program/view/<?=$program->program_id?>/search"><?=$program->title?></a></h3>
			<p><?=$program->description_short?></p>
			<?php endforeach; ?>
			<?php include("includes/pagination_results.php"); ?>
			<?php else: ?>
			<p>No results found. Be creative with your searches and remember that fewer criteria will net you more responses to browse through.</p>
			<?php endif; ?>
		</div>
		</form>
		<?php endif; ?>
	</div>
	<!-- end content -->
	<!-- begin sidebar -->
	<div id="sidebar">
	<?php foreach ($spotlights as $spotlight): ?>
		<div class="spotlight">
			<div class="photo"><div class="inner"><a href="<?=base_url()?>index.php/program/view/<?=$spotlight->program_id?>/spotlight"><img src="<?=base_url()?>images/programs/<?=$spotlight->photo_path?>" alt="" /></a></div></div>
			<p><a href="<?=base_url()?>index.php/program/view/<?=$spotlight->program_id?>/spotlight"><?=$spotlight->title?></a></p>
		</div>
		<p>&nbsp;</p>
	<?php endforeach; ?>
	</div>
	<!-- end sidebar -->
</div>
<!-- end main container -->
<!-- begin footer -->
<?php include("includes/footer.php"); ?>
<!-- end footer -->
</body>
</html>
