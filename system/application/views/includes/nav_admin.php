		<li><a <?=echoNavItem("/mit-psc-outreach/admin")?>><?php if ($userlevel == "0"): ?>Database<?php else: ?>Program<?php endif; ?> Management</a></li>
		<?php if ($userlevel == "0"): ?>
			<li><a <?=echoNavItem("/mit-psc-outreach/adminprogram")?>>Programs</a></li>
			<li><a <?=echoNavItem("/mit-psc-outreach/adminuser")?>>Administrators</a></li>
			<li><a <?=echoNavItem("/mit-psc-outreach/adminterm")?>>Search Criteria</a></li>
			<li><a <?=echoNavItem("/mit-psc-outreach/adminmessage")?>>Email Management</a></li>
		<?php endif; ?>
		<li><a <?=echoNavItem("/mit-psc-outreach/adminuser/edit/$userid")?>>My Profile</a></li>
		<li><a href="<?=str_replace("https", "http", base_url())?>">Logout</a></li>