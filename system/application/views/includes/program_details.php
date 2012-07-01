	<h2><?=$program->title?></h2>
	<p class="dlc"><?=$program->dlc?></p>
	<!-- begin content -->
	<div id="content">
		<h3>Description</h3>
		<p><?=$program->description?></p>
		<h3>Additional Details</h3>
		<p><?=$program->additional_info?></p>
		<p><strong>Website:</strong> <a href="<?=$program->url?>" rel="external"><?=$program->url?></a></p>
		<p><strong>Area of Interest:</strong> <?=join(", ", $terms[1])?></p>
		<p><strong>Program participant:</strong> <?=join(", ", $terms[2])?></p>
		<p><strong>Location:</strong> <?=join(", ", $terms[3])?></p>
		<p><strong>Time Frame:</strong> <?=join(", ", $terms[4])?></p>
		<h3>Contacts</h3>
		<?php if ($program->public_contact1_name): ?>
		<p><a href="mailto:<?=$program->public_contact1_email?>"><?=$program->public_contact1_name?></a><br />
		<?=$program->public_contact1_address?><br />
		Phone: <?=$program->public_contact1_phone?><br />
		<a href="mailto:<?=$program->public_contact1_email?>"><?=$program->public_contact1_email?></a></p>
		<?php endif; ?>
		<?php if ($program->public_contact2_name): ?>
		<p><a href="mailto:<?=$program->public_contact2_email?>"><?=$program->public_contact2_name?></a><br />
		<?=$program->public_contact2_address?><br />
		Phone: <?=$program->public_contact2_phone?><br />
		<a href="mailto:<?=$program->public_contact2_email?>"><?=$program->public_contact2_email?></a></p>
		<?php endif; ?>
	</div>
	<!-- end content -->
	
	<!-- begin sidebar -->
	<div id="sidebar">
		<?php if ($program->photo_path): ?>
		<div class="photo">
			<div class="inner"><img src="/mit-psc-outreach/images/programs/<?=$program->photo_path?>" alt="" /></div>
		</div>
		<?php endif; ?>
		<?php if ($program->logo_path): ?>
		<div class="logo">
			<div class="inner"><img src="/mit-psc-outreach/images/programs/<?=$program->logo_path?>" alt="" /></div>
		</div>
		<?php endif; ?>
		<p>&nbsp;</p>
	</div>
	<!-- end sidebar -->
