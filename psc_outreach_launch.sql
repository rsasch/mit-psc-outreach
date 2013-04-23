-- MySQL dump 10.11
--

USE psc_outreach;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL auto_increment,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
INSERT INTO `category` VALUES (1,'Area of Interest'),(2,'Program Participant'),(3,'Location'),(4,'Time Frame');
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL auto_increment,
  `message_name` varchar(100) NOT NULL,
  `message_text` varchar(5000) NOT NULL,
  `message_order` int(5) NOT NULL,
  PRIMARY KEY  (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
INSERT INTO `message` VALUES (2,'Confirmation of account creation','Congratulations! You now have a program administrator account with the MIT Outreach Database.\n\nTo enter your MIT outreach program into the database, click \"For MIT Program Administrators\" in the left column.  Your MIT certificate will log you into the program administrator interface, where you can enter your program details.\n\nYou will be asked to enter the following information about your outreach program. More information about these items is available on the website:\n\n     *   A one paragraph program description\n     *   A one sentence (about 150 words or less) program description for search results\n     *   Contact info to be listed on the website\n     *   Two administrative contacts (for internal use)\n     *   Program URL\n     *   A photograph that represents the program\'s activities\n     *   A program logo or logo of the sponsoring MIT department/lab/center\n\nWe keep aware of database programs by moderating the website activity. Once your program is included in the database, you may request edits to content at any time.  If, after 12 months, you have not edited your program, you will receive an email notification asking you to confirm the continued accuracy of the posted program details. If you do not confirm accuracy or update your account at that time, your program will become inactive and will no longer be listed in the database.\n\nWe also want to let you know about the PSC email bulletin that lets students know about volunteer opportunities. To post volunteer opportunities for your program, please submit your information via the Public Service Center\'s website: http://mit.edu/mitpsc/guides/csb-posting-form.html\n\nThank you for posting your program in the MIT Outreach Database. Please contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',1),(3,'Request for new account denied','Thank you for your request for an Outreach Database program administrator account. We couldn\'t open an account for you at this time. From what we can tel, you are either not a member of the MIT community or not an administrator of an MIT outreach program. Here\'s a reminder of our definition of an outreach program for purposes of the Outreach Database.\n\nTo qualify, it must meet all three of these criteria:\n     *   Your program must in some way reach outwards toward the external community.\n     *   Secondly, your program must be active and open. Outreach of this sort can be applied for and actually participated in by community members. \n     *   Lastly, your program must be ongoing or cyclical in some way. This excludes, for example, a one-time lecture but can include lecture series as long as it satisfies the above criteria.\n\nIf you have any questions or if you think you do qualify as an outreach program administrator, please feel free to contact me at the information below. Thank you.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',2),(4,'Messages to program admin of new program request','Thank you for requesting that your outreach program be added to the MIT Outreach Database. You will receive email notification within a week (or sooner!) if your program is activated.\n\nTo post volunteer opportunities for your program, please submit your information via the Public Service Center’s website: http://mit.edu/mitpsc/guides/csb-posting-form.html\n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',3),(5,'Request for new program approved','Dear Outreach Program Administrator,\n\nCongratulations! You now have a new outreach program listed in the MIT Outreach Database.\n\nTo edit your program details, go to the MIT Outreach Database, click \"For MIT Program Administrators\" in the left column and choose the program you wish to edit.\n\nWe keep aware of database programs by moderating the website activity. If, after 12 months, you have not made any edits to your program, you will receive an email notification asking you to confirm the continued accuracy of the posted program details. If you do not confirm accuracy or update your account at that time, your program will become inactive and will no longer be listed in the database.\n\nWe also want to let you know about the PSC email bulletin that lets students know about volunteer opportunities. To post volunteer opportunities for your program, please submit your information via the Public Service Center\'s website: http://mit.edu/mitpsc/guides/csb-posting-form.html\n\nThank you for posting your program in the MIT Outreach Database. Please contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',4),(6,'Request for new program denied','Thank you for submitting an outreach program for inclusion in the MIT Outreach Database. At this time, we are not including your program in the database either because the information submitted was unclear or your program does not fit our definition of an MIT outreach program. To qualify, it must meet all three of these criteria:\n\n     *   Your program must in some way reach outwards toward the external community.\n     *   Secondly, your program must be active and open. Outreach of this sort can be applied for and actually participated in by community members. \n     *   Lastly, your program must be ongoing or cyclical in some way. This excludes, for example, a one-time lecture but can include lecture series as long as it satisfies the above criteria.\n\nIf you\'d like to discuss your program further and whether it might be a fit for the MIT Outreach Database, please contact me at the information below.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',5),(7,'Message to program administrator of program edits','Dear Outreach Program Administrator,\n\nThank you for requesting that your outreach program be edited in the MIT Outreach Database. You will receive email notification within a week (or sooner!) if your edits are activated.\n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',6),(8,'Request for program edits approved','Dear Outreach Program Administrator,\n\nYou recently submitted edits to an existing outreach program in the MIT Outreach Database. Those edits are now activated in the database.  Thank you for keeping your program information up-to-date!\n\n\nWe keep aware of database programs by moderating the website activity. If, after 12 months, you have not made any edits to your program, you will receive an email notification asking you to confirm the continued accuracy of the posted program details. If you do not confirm accuracy or update your account at that time, your program will become inactive and will no longer be listed in the database.\n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',7),(9,'Request for program edits denied','Dear Outreach Program Administrator,\n\nThank you for submitting edits for an existing MIT Outreach Database outreach program.  At this time, we are not implementing your edits.\n\nIf you’d like to discuss your program further or receive clarification please contact me at the information below.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',8),(10,'Request to renew program listing or face expiration','Dear Outreach Program Administrator,\n\nWe noticed that you have not updated information about your MIT outreach program in over a year.  \n\nTo keep information in the database accurate, we ask that you please go to the \"For MIT Program Administrators\" section of the Outreach Database within the next 30 days to confirm accuracy of the posted information and/or update the program details.  Otherwise, your program listing will become inactive and disappear from the database.\n\nIf you have received this email via carbon copy it is because you are listed as an MIT administrative contact on this outreach program’s listing.  If the program administrator to whom this message was sent no longer oversees this program, please contact me at outreach@outreach.com or x3-5555, so that we can update the listing and give editing access for this program to a new administrator.\n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555',9),(11,'Final notice of program listing expiration','Dear Outreach Program Administrator,\n\nThis email is a final request to confirm the accuracy of information about your outreach program listed in the MIT Outreach Database or to update the content.  If you do not take action in the next 30 days, your program will become inactive and will no longer be listed in the database.\n\nTo keep/update your program listing, go to the \"For MIT Program Administrators\" section of the Outreach Database:.\n\nIf you have received this email via carbon copy it is because you are listed as an MIT administrative contact on this outreach program’s listing.  If the program administrator to whom this message was sent no longer oversees this program, please contact me at outreach@outreach.com or x3-5555, so that we can update the listing and give editing access for this program to a new administrator.\n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',10),(12,'Notice of program expiration','Dear Outreach Program Administrator,\n\nPlease note that your outreach program listing is now inactive and has been removed from display for users of the MIT Outreach database.\n\nIf this program is still active and you’d like to see it included once again in the Outreach Database, you will need to add it as a new program by going to the \"For MIT Program Administrators\" section of the Outreach Database.\n\nIf you have received this email via carbon copy it is because you are listed as an MIT administrative contact on this outreach program’s listing.  If the program administrator to whom this message was sent no longer oversees this program, please contact me at outreach@outreach.com or x3-5555, so that we can give access to the new program administrator so that they can enter this listing as a new program in the database.\n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',11),(14,'Request for new account received','Thank you for requesting an administrator account to add and manage MIT outreach programs in the MIT Outreach Database. You will receive email notification within a week (or sooner!) about new account activation.   \n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',0),(15,'Notification that account has been made inactive (other than expiration)','Dear Outreach Program Administrator,\n\nYour outreach program listing has changed status to inactive and has been removed from display for users of the MIT Outreach database.\n\nIf this program is still active and you’d like to see it included once again in the Outreach Database, please contact me at the information below.\n\nIf you have received this email via carbon copy it is because you are listed as an MIT administrative contact on this outreach program’s listing.  If the program administrator to whom this message was sent no longer oversees this program, please contact me at outreach@outreach.com or x3-5555, so that we can give access to the new program administrator.\n\nPlease contact me with any questions.\n\nSincerely,\nJane Doe\nMIT Public Service Center\noutreach@outreach.com\nx3-5555\n',12);
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE `program` (
  `program_id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `description` varchar(1000) NOT NULL,
  `description_short` varchar(150) NOT NULL,
  `additional_info` varchar(500) NOT NULL,
  `admin_contact1_name` varchar(100) default NULL,
  `admin_contact1_dlc` varchar(100) NOT NULL,
  `admin_contact1_address` varchar(255) default NULL,
  `admin_contact1_phone` varchar(20) default NULL,
  `admin_contact1_email` varchar(50) default NULL,
  `admin_contact2_name` varchar(100) default NULL,
  `admin_contact2_dlc` varchar(100) NOT NULL,
  `admin_contact2_address` varchar(255) default NULL,
  `admin_contact2_phone` varchar(20) default NULL,
  `admin_contact2_email` varchar(50) default NULL,
  `public_contact1_name` varchar(100) NOT NULL,
  `public_contact1_address` varchar(255) NOT NULL,
  `public_contact1_phone` varchar(20) NOT NULL,
  `public_contact1_email` varchar(50) NOT NULL,
  `public_contact2_name` varchar(100) NOT NULL,
  `public_contact2_address` varchar(255) NOT NULL,
  `public_contact2_phone` varchar(20) NOT NULL,
  `public_contact2_email` varchar(50) NOT NULL,
  `url` varchar(100) default NULL,
  `photo_path` varchar(50) default NULL,
  `logo_path` varchar(50) default NULL,
  `title_edit` varchar(100) default NULL,
  `description_edit` varchar(1000) default NULL,
  `description_short_edit` varchar(150) default NULL,
  `additional_info_edit` varchar(500) default NULL,
  `admin_contact1_name_edit` varchar(100) default NULL,
  `admin_contact1_dlc_edit` varchar(100) default NULL,
  `admin_contact1_address_edit` varchar(255) default NULL,
  `admin_contact1_phone_edit` varchar(20) default NULL,
  `admin_contact1_email_edit` varchar(50) default NULL,
  `admin_contact2_name_edit` varchar(100) default NULL,
  `admin_contact2_dlc_edit` varchar(100) default NULL,
  `admin_contact2_address_edit` varchar(255) default NULL,
  `admin_contact2_phone_edit` varchar(20) default NULL,
  `admin_contact2_email_edit` varchar(50) default NULL,
  `public_contact1_name_edit` varchar(100) default NULL,
  `public_contact1_address_edit` varchar(255) default NULL,
  `public_contact1_phone_edit` varchar(20) default NULL,
  `public_contact1_email_edit` varchar(50) default NULL,
  `public_contact2_name_edit` varchar(100) default NULL,
  `public_contact2_address_edit` varchar(255) default NULL,
  `public_contact2_phone_edit` varchar(20) default NULL,
  `public_contact2_email_edit` varchar(50) default NULL,
  `url_edit` varchar(100) default NULL,
  `photo_path_edit` varchar(50) default NULL,
  `logo_path_edit` varchar(50) default NULL,
  `title_moddate` date default NULL,
  `description_moddate` date default NULL,
  `description_short_moddate` date default NULL,
  `additional_info_moddate` date default NULL,
  `admin_contact1_name_moddate` date default NULL,
  `admin_contact1_dlc_moddate` date default NULL,
  `admin_contact1_address_moddate` date default NULL,
  `admin_contact1_phone_moddate` date default NULL,
  `admin_contact1_email_moddate` date default NULL,
  `admin_contact2_name_moddate` date default NULL,
  `admin_contact2_dlc_moddate` date default NULL,
  `admin_contact2_address_moddate` date default NULL,
  `admin_contact2_phone_moddate` date default NULL,
  `admin_contact2_email_moddate` date default NULL,
  `public_contact1_name_moddate` date default NULL,
  `public_contact1_address_moddate` date default NULL,
  `public_contact1_phone_moddate` date default NULL,
  `public_contact1_email_moddate` date default NULL,
  `public_contact2_name_moddate` date default NULL,
  `public_contact2_address_moddate` date default NULL,
  `public_contact2_phone_moddate` date default NULL,
  `public_contact2_email_moddate` date default NULL,
  `url_moddate` date default NULL,
  `program_moddate` date NOT NULL,
  `photo_path_moddate` date default NULL,
  `logo_path_moddate` date default NULL,
  `user_id` int(11) NOT NULL,
  `add_approval_flag` binary(1) default '0',
  `edit_approval_flag` binary(1) default '0',
  `delete_approval_flag` binary(1) default '0',
  `active_flag` binary(1) default '0',
  `11month_flag` binary(1) default '0',
  `12month_flag` binary(1) default '0',
  `dlc` varchar(100) default NULL,
  `dlc_edit` varchar(100) default NULL,
  `dlc_moddate` date default NULL,
  `add_inprogress_flag` binary(1) default '1',
  `public_contact2_org` varchar(50) default NULL,
  `public_contact1_org` varchar(50) default NULL,
  `public_contact2_org_moddate` date default NULL,
  `public_contact1_org_moddate` date default NULL,
  `public_contact2_org_edit` varchar(50) default NULL,
  `public_contact1_org_edit` varchar(50) default NULL,
  PRIMARY KEY  (`program_id`),
  FULLTEXT KEY `title` (`title`,`description`,`description_short`,`additional_info`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
INSERT INTO `program` VALUES (27,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue. Nam tincidunt congue enim, ut porta lorem lacinia consectetur.','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris.','Donec ut libero sed arcu vehicula ultricies a non tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut gravida lorem.','Jane Doe','Public Service Center','77 Massachusetts Avenue, 4-104\nCambridge, MA 02139','617-253-8968','janedoe@outreach.com','CityDays Coordinator','Public Service Center','77 Massachusetts Avenue, 4-104\nCambridge, MA 02139','617-253-5555','staff@outreach.com','Jane Doe','77 Massachusetts Avenue, 4-104\nCambridge, MA 02139','617-253-5555','staff@outreach.com','','','','','http://web.mit.edu/mitpsc/volunteering/programs/citydays/','photo-citydays1.jpg','26.jpg.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-04-05','2010-06-28','2010-04-12','2010-04-07',31,'0','0','0','1','0','0','Public Service Center',NULL,'2010-04-05','0','','Public Service Center','2010-06-28','2010-04-05',NULL,NULL),(30,'Donec viverra','Donec viverra mi quis quam pulvinar at malesuada arcu rhoncus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In rutrum accumsan ultricies.','Donec viverra mi quis quam pulvinar at malesuada arcu rhoncus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.','Maecenas convallis ullamcorper ultricies. Curabitur ornare, ligula semper consectetur sagittis, nisi diam iaculis velit, id fringilla sem nunc vel mi. Nam dictum, odio nec pretium volutpat, arcu ante placerat erat, non tristique elit urna et turpis.','John Doe','Public Service Center, Fellowships Administrator','77 Massachusetts Avenue, W20-549\nCambridge, MA 02139','617-258-5555','jillsmith@outreach.com ','Jill Smith','Public Service Center','77 Massachusetts Ave., 4-104\nCambridge, MA 02139','617-253-5555','staff@outreach.com','John Doe','77 Massachusetts Avenue, W20-549\nCambridge, MA 02139','617-258-5555','johndoe@outreach.com','','','','','http://mit.edu/mitpsc/resources/internshipsandfellowships/index.html','hussain-johnson.jpg','scolnik_businesswheelchair1.jpg.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2010-06-28','2010-04-05','2010-04-05','2010-04-09','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-04-05','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-04-05','2010-06-28','2010-06-28','2010-04-07',31,'0','0','0','1','0','0','MIT Public Service Center',NULL,'2010-06-28','0','','Public Service Center','2010-04-05','2010-04-05',NULL,NULL),(45,'Fusce vel volutpat','Fusce vel volutpat elit. Nam sagittis nisi dui. Suspendisse lectus leo, consectetur in tempor sit amet, placerat quis neque. Etiam luctus porttitor lorem, sed suscipit est rutrum non. Curabitur lobortis nisl a enim congue semper. Aenean commodo ultrices imperdiet. Vestibulum ut justo vel sapien venenatis tincidunt. Phasellus eget dolor sit amet ipsum dapibus condimentum vitae quis lectus. Aliquam ut massa in turpis dapibus convallis. Praesent elit lacus, vestibulum at malesuada et, ornare et est.','Fusce vel volutpat elit. Nam sagittis nisi dui. Suspendisse lectus leo, consectetur in tempor sit amet, placerat quis neque.','Ut augue nunc, sodales ut euismod non, adipiscing vitae orci. Mauris ut placerat justo. Mauris in ultricies enim. Quisque nec est eleifend nulla ultrices egestas quis ut quam.','Adam Jones','Education Officer','MIT Room 13-2082','617-253-0916','susang@mit.edu','Susan Dalton','Assistant Director, CMSE','MIT Room 13-2110','617-253-7632','adamjones@outreach.com','Adam Jones','77 Massachusetts Ave., Room 13-2082\nCambridge, MA 02139','617-253-0916','adamjones@outreach.com','','','','','http://web.mit.edu/cmse/education/step.html','step1.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-06-28','2010-04-21','2010-04-21','2010-06-28','2010-04-21','2010-04-21','2010-04-21','2010-04-21','2010-06-28','2010-04-21',NULL,31,'0','0','0','1','0','0','Center for Materials Science and Engineering',NULL,'2010-04-21','0','','MIT','2010-04-21','2010-04-21',NULL,NULL),(47,'Quisque mi metus','Quisque mi metus, ornare sit amet fermentum et, tincidunt et orci. Fusce eget orci a orci congue vestibulum. Ut dolor diam, elementum et vestibulum eu, porttitor vel elit. Curabitur venenatis pulvinar tellus gravida ornare. Sed et erat faucibus nunc euismod ultricies ut id justo.','Quisque mi metus, ornare sit amet fermentum et, tincidunt et orci. Fusce eget orci a orci congue vestibulum.','Nullam cursus suscipit nisi, et ultrices justo sodales nec. Fusce venenatis facilisis lectus ac semper. Aliquam at massa ipsum. Quisque bibendum purus convallis nulla ultrices ultricies. Nullam aliquam, mi eu aliquam tincidunt, purus velit laoreet tortor, viverra pretium nisi quam vitae mi.','Jane Doe','MIT Public Service Center, Volunteer & Outreach Administrator','77 Massachusetts Avenue, 4-104\nCambridge, MA 02139','617-253-8968','janedoe@outreach.com','MIT Giving Tree planners','MIT Public Service Center','77 Massachusetts Avenue, 4-104\nCambridge, MA 02139','617-253-5555','mitgivingtree@mit.edu','Jane Doe','77 Massachusetts Avenue, 4-104\nCambridge, MA 02139','617-253-8968','mitgivingtree@mit.edu','','','','','http://mit.edu/mitpsc/volunteering/programs/givingtree/','Dsc034251.jpg','Dsc034251.jpg.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28','2010-06-28',31,'0','0','0','1','0','0','MIT Public Service Center',NULL,'2010-06-28','0','','MIT Public Service Center','2010-06-28','2010-06-28',NULL,NULL);
UNLOCK TABLES;

--
-- Table structure for table `program_term`
--

DROP TABLE IF EXISTS `program_term`;
CREATE TABLE `program_term` (
  `program_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  PRIMARY KEY  (`program_id`,`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_term`
--

LOCK TABLES `program_term` WRITE;
INSERT INTO `program_term` VALUES (25,2),(25,5),(25,6),(25,11),(25,21),(26,2),(26,5),(26,6),(26,11),(26,21),(27,1),(27,2),(27,5),(27,6),(27,7),(27,8),(27,9),(27,10),(27,13),(27,14),(27,21),(28,1),(28,2),(28,3),(28,4),(28,5),(28,6),(28,7),(28,8),(28,9),(28,10),(28,11),(28,12),(28,13),(28,14),(28,15),(28,16),(28,17),(28,18),(28,19),(28,20),(28,21),(29,2),(29,5),(29,7),(29,10),(29,13),(29,16),(29,18),(29,19),(29,20),(29,21),(30,1),(30,2),(30,5),(30,6),(30,7),(30,8),(30,9),(30,10),(30,13),(30,14),(30,15),(30,16),(30,18),(30,19),(30,20),(30,21),(31,1),(31,2),(31,3),(31,4),(31,5),(31,6),(31,9),(31,11),(31,14),(31,21),(33,5),(33,6),(33,13),(33,20),(34,1),(34,2),(34,4),(34,5),(34,6),(34,7),(34,8),(34,9),(34,10),(34,11),(34,20),(35,1),(35,2),(35,5),(35,6),(35,7),(35,9),(35,11),(35,12),(35,14),(35,15),(35,18),(35,19),(35,20),(36,2),(36,4),(36,5),(36,6),(36,20),(36,21),(37,1),(37,2),(37,5),(37,6),(37,11),(37,21),(38,2),(38,5),(38,6),(38,12),(38,21),(39,2),(39,3),(39,4),(39,5),(39,9),(39,11),(39,14),(39,15),(39,18),(39,19),(40,2),(40,3),(40,4),(40,6),(40,11),(40,15),(40,18),(40,19),(40,21),(41,1),(41,2),(41,5),(41,6),(41,7),(41,8),(41,9),(41,10),(41,13),(41,14),(41,21),(42,1),(42,5),(42,6),(42,11),(42,21),(43,1),(43,5),(43,6),(43,11),(43,21),(44,1),(44,5),(44,6),(44,11),(44,21),(45,2),(45,5),(45,6),(45,12),(45,21),(46,2),(46,5),(46,6),(46,12),(46,21),(47,3),(47,4),(47,5),(47,10),(47,11),(47,14),(47,18);
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(25) NOT NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
INSERT INTO `role` VALUES (0,'PSC administrator'),(1,'program administrator');
UNLOCK TABLES;

--
-- Table structure for table `term`
--

DROP TABLE IF EXISTS `term`;
CREATE TABLE `term` (
  `term_id` int(11) NOT NULL auto_increment,
  `term_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY  (`term_id`),
  FULLTEXT KEY `term_name` (`term_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `term`
--

LOCK TABLES `term` WRITE;
INSERT INTO `term` VALUES (1,'Mathematics',1),(2,'Sciences',1),(3,'Grades K-5',2),(4,'Grades 6-8',2),(5,'Cambridge (including MIT\'s Cambridge campus)',3),(6,'Engineering / Technology',1),(7,'Social Sciences',1),(8,'Arts / Humanities',1),(9,'Other academic areas',1),(10,'Non-academic areas',1),(11,'Grades 9–12',2),(12,'K–12 Teachers (for professional development)',2),(13,'Other adults',2),(14,'Boston (city)',3),(15,'U.S. locations outside Cambridge and Boston',3),(16,'International locations',3),(17,'No location : Online only',3),(18,'Before or during school hours',4),(19,'After school',4),(20,'Weekends / breaks during school year',4),(21,'Summer break',4);
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL auto_increment,
  `first_name` varchar(50) default NULL,
  `kerb` varchar(50) NOT NULL,
  `title` varchar(100) default NULL,
  `email` varchar(50) default NULL,
  `phone` varchar(20) default NULL,
  `role_id` int(11) NOT NULL,
  `active_flag` binary(1) NOT NULL default '0',
  `add_approval_flag` binary(1) default NULL,
  `dlc` varchar(100) default NULL,
  `address` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES (1,'Rebecca','rsa','Web Developer','rsa@mit.edu','(617) 254-9123',0,'1','0','IS&T DCAD','N42-240aa','Asch'),(31,'DCAD','dcadtest','Test Program Admin','dcadtest@mit.edu','555-777-1111',1,'1','0','DCAD','N42','Tester');
UNLOCK TABLES;

