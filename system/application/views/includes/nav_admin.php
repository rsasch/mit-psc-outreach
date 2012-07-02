		<li><a <?=echoNavItem(base_url() . "admin")?>><?php if ($userlevel == "0"): ?>Database<?php else: ?>Program<?php endif; ?> Management</a></li>
		<?php if ($userlevel == "0"): ?>
			<li><a <?=echoNavItem(base_url() . "adminprogram")?>>Programs</a></li>
			<li><a <?=echoNavItem(base_url() . "adminuser")?>>Administrators</a></li>
			<li><a <?=echoNavItem(base_url() . "adminterm")?>>Search Criteria</a></li>
			<li><a <?=echoNavItem(base_url() . "adminmessage")?>>Email Management</a></li>
		<?php endif; ?>
		<li><a <?=echoNavItem(base_url() . "adminuser/edit/$userid")?>>My Profile</a></li>
		<li><a href="<?=str_replace("https", "http", base_url())?>">Logout</a></li>