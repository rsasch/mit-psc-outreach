INSTALLATION INSTRUCTIONS FOR PSC OUTREACH APPLICATION
=====================================================

 *	Environment is apache, mysql and php
 *  Create a new mysql database called psc_outreach
 *	Create mysql user with SELECT, INSERT, UPDATE, DELETE privileges on psc_outreach and 
	update system/application/config/database.php with that user's credentials at the 
	lines that begin:

		$db['default']['username']
		$db['default']['password']

 *	Set the base_url of the application in system/application/config/config.php by filling
 	in the following value:

 		$config['base_url']

