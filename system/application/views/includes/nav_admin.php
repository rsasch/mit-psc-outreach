		<li><a <?=echoNavItem(base_url() . "index.php/admin")?>><?php if ($userlevel == "0"): ?>Database<?php else: ?>Program<?php endif; ?> Management</a></li>
		<?php if ($userlevel == "0"): ?>
			<li><a <?=echoNavItem(base_url() . "index.php/adminprogram")?>>Programs</a></li>
			<li><a <?=echoNavItem(base_url() . "index.php/adminuser")?>>Administrators</a></li>
			<li><a <?=echoNavItem(base_url() . "index.php/adminterm")?>>Search Criteria</a></li>
			<li><a <?=echoNavItem(base_url() . "index.php/adminmessage")?>>Email Management</a></li>
		<?php endif; ?>
		<li><a <?=echoNavItem(base_url() . "index.php/adminuser/edit/$userid")?>>My Profile</a></li>
		<li><a href="<?=str_replace("https", "http", base_url())?>">Logout</a></li>