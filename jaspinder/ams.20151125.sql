-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.57-community - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-11-25 15:40:28
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table ams.addresses
DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `address_type_id` tinyint(1) NOT NULL,
  `address1` varchar(255) NOT NULL DEFAULT '',
  `address2` varchar(255) NOT NULL DEFAULT '',
  `address3` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `postcode` varchar(20) NOT NULL DEFAULT '' COMMENT 'zip / postcode',
  `state` varchar(255) NOT NULL DEFAULT '' COMMENT 'state / province /county',
  `country_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.addresses: ~0 rows (approximately)
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;


-- Dumping structure for table ams.address_types
DROP TABLE IF EXISTS `address_types`;
CREATE TABLE IF NOT EXISTS `address_types` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.address_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `address_types` DISABLE KEYS */;
INSERT INTO `address_types` (`id`, `name`) VALUES
	(1, 'Billing'),
	(2, 'Home');
/*!40000 ALTER TABLE `address_types` ENABLE KEYS */;


-- Dumping structure for table ams.ci_sessions
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table ams.ci_sessions: 0 rows
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table ams.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `first_name` varchar(32) NOT NULL DEFAULT '',
  `last_name` varchar(32) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `postcode` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(32) NOT NULL DEFAULT '',
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `dob` varchar(20) NOT NULL DEFAULT '',
  `weight` varchar(4) NOT NULL DEFAULT '',
  `status_id` int(11) unsigned DEFAULT NULL,
  `gender_id` char(1) NOT NULL DEFAULT '',
  `inquiry_date` date DEFAULT NULL,
  `assessment_date` date DEFAULT NULL,
  `service_start_date` date DEFAULT NULL,
  `service_end_date` date DEFAULT NULL,
  `reason_id` int(11) unsigned DEFAULT NULL,
  `payor_id` varchar(255) DEFAULT NULL,
  `case_manager_id` int(11) unsigned DEFAULT NULL,
  `referred_by` varchar(10) NOT NULL DEFAULT '',
  `referred` varchar(10) NOT NULL DEFAULT '',
  `physician_id` int(11) unsigned DEFAULT NULL,
  `diagnosis` varchar(100) NOT NULL DEFAULT '',
  `code` varchar(100) NOT NULL DEFAULT '',
  `med_record` varchar(100) NOT NULL DEFAULT '',
  `location_id` int(11) unsigned DEFAULT NULL,
  `accountingid` varchar(100) NOT NULL DEFAULT '',
  `ambulatory_id` int(11) unsigned DEFAULT NULL,
  `client_type_id` int(11) unsigned DEFAULT NULL,
  `ssn` varchar(20) NOT NULL DEFAULT '',
  `priority_id` int(11) unsigned DEFAULT NULL,
  `telephonyid` varchar(20) NOT NULL DEFAULT '',
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `name` (`first_name`,`last_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ams.clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;


-- Dumping structure for table ams.client_addresses
DROP TABLE IF EXISTS `client_addresses`;
CREATE TABLE IF NOT EXISTS `client_addresses` (
  `client_id` int(11) unsigned NOT NULL,
  `address_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`client_id`,`address_id`),
  KEY `address_id` (`address_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.client_addresses: ~0 rows (approximately)
/*!40000 ALTER TABLE `client_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_addresses` ENABLE KEYS */;


-- Dumping structure for table ams.client_contacts
DROP TABLE IF EXISTS `client_contacts`;
CREATE TABLE IF NOT EXISTS `client_contacts` (
  `client_id` int(11) unsigned NOT NULL,
  `contact_id` bigint(20) unsigned NOT NULL,
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`,`contact_id`),
  KEY `contact_id` (`contact_id`),
  KEY `client_id` (`client_id`),
  KEY `is_default` (`is_default`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.client_contacts: ~0 rows (approximately)
/*!40000 ALTER TABLE `client_contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_contacts` ENABLE KEYS */;


-- Dumping structure for table ams.client_documents
DROP TABLE IF EXISTS `client_documents`;
CREATE TABLE IF NOT EXISTS `client_documents` (
  `client_id` int(11) unsigned NOT NULL,
  `document_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`client_id`,`document_id`),
  KEY `document_id` (`document_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.client_documents: ~0 rows (approximately)
/*!40000 ALTER TABLE `client_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_documents` ENABLE KEYS */;


-- Dumping structure for table ams.client_notes
DROP TABLE IF EXISTS `client_notes`;
CREATE TABLE IF NOT EXISTS `client_notes` (
  `client_id` int(11) unsigned NOT NULL,
  `note_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`client_id`,`note_id`),
  KEY `note_id` (`note_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.client_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `client_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_notes` ENABLE KEYS */;


-- Dumping structure for table ams.companies
DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_auto_incrementer` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.companies: ~5 rows (approximately)
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`id`, `name`, `address`, `phone`, `logo`, `created_by`, `created_on`, `active`, `invoice_auto_incrementer`, `is_deleted`) VALUES
	(1, 'The Test Company', 'Address 123', '+44123456789', '54c67fd42601f.png', 1, '2013-01-25 00:00:00', 1, 0, 1),
	(12, 'testcompany2', '2538 Amber Valley Drive', '2125551217', '', 1, '2015-09-28 17:22:54', 1, 0, 1),
	(13, 'CC Agency', 'CC Address 1', 'CC Phone 1', '', 1, '2015-09-28 18:34:10', 1, 0, 1),
	(14, 'Clear Channel', 'Address Line 1', '', '', 1, '2015-09-29 17:48:48', 1, 0, 0),
	(15, 'Black Webs', 'London', '', '', 1, '2015-10-29 18:06:24', 1, 0, 0);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;


-- Dumping structure for table ams.company_contacts
DROP TABLE IF EXISTS `company_contacts`;
CREATE TABLE IF NOT EXISTS `company_contacts` (
  `company_id` int(11) NOT NULL,
  `contact_id` bigint(20) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`company_id`,`contact_id`),
  KEY `company_id` (`company_id`),
  KEY `contact_id` (`contact_id`),
  KEY `is_default` (`is_default`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.company_contacts: ~3 rows (approximately)
/*!40000 ALTER TABLE `company_contacts` DISABLE KEYS */;
INSERT INTO `company_contacts` (`company_id`, `contact_id`, `is_default`) VALUES
	(1, 5, 1),
	(12, 4, 1),
	(13, 7, 1);
/*!40000 ALTER TABLE `company_contacts` ENABLE KEYS */;


-- Dumping structure for table ams.company_custom_fields
DROP TABLE IF EXISTS `company_custom_fields`;
CREATE TABLE IF NOT EXISTS `company_custom_fields` (
  `custom_field_id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`custom_field_id`,`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.company_custom_fields: ~0 rows (approximately)
/*!40000 ALTER TABLE `company_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_custom_fields` ENABLE KEYS */;


-- Dumping structure for table ams.company_documents
DROP TABLE IF EXISTS `company_documents`;
CREATE TABLE IF NOT EXISTS `company_documents` (
  `company_id` int(11) NOT NULL,
  `document_id` bigint(20) NOT NULL,
  PRIMARY KEY (`company_id`,`document_id`),
  KEY `company_id` (`company_id`),
  KEY `document_id` (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.company_documents: ~0 rows (approximately)
/*!40000 ALTER TABLE `company_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_documents` ENABLE KEYS */;


-- Dumping structure for table ams.company_grid_columns
DROP TABLE IF EXISTS `company_grid_columns`;
CREATE TABLE IF NOT EXISTS `company_grid_columns` (
  `company_id` int(11) unsigned NOT NULL,
  `grid_column_id` smallint(5) unsigned NOT NULL,
  `grid_column_type_id` tinyint(3) unsigned NOT NULL,
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`company_id`,`grid_column_id`,`grid_column_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.company_grid_columns: ~0 rows (approximately)
/*!40000 ALTER TABLE `company_grid_columns` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_grid_columns` ENABLE KEYS */;


-- Dumping structure for table ams.company_notes
DROP TABLE IF EXISTS `company_notes`;
CREATE TABLE IF NOT EXISTS `company_notes` (
  `company_id` int(11) unsigned NOT NULL,
  `note_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`company_id`,`note_id`),
  KEY `company_id` (`company_id`),
  KEY `note_id` (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.company_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `company_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_notes` ENABLE KEYS */;


-- Dumping structure for table ams.company_settings
DROP TABLE IF EXISTS `company_settings`;
CREATE TABLE IF NOT EXISTS `company_settings` (
  `company_id` int(11) unsigned NOT NULL,
  `vat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `show_alternative_job_number` tinyint(1) NOT NULL DEFAULT '0',
  `show_custom_job_tags` tinyint(1) NOT NULL DEFAULT '0',
  `gmt_offset` varchar(10) NOT NULL DEFAULT 'UTC',
  `sequencial_number_id` tinyint(1) NOT NULL DEFAULT '0',
  `allow_invoice_number_format` tinyint(1) NOT NULL DEFAULT '0',
  `invoice_number_format` varchar(50) NOT NULL DEFAULT '',
  `invoice_merge_same_day_visit` tinyint(1) NOT NULL DEFAULT '0',
  `calender_view` varchar(50) NOT NULL DEFAULT '',
  `body_font_color` varchar(50) NOT NULL DEFAULT '',
  `working_hours_start_time` time DEFAULT NULL,
  `working_hours_end_time` time DEFAULT NULL,
  `resource_working_hours_from` time DEFAULT NULL,
  `resource_working_hours_to` time DEFAULT NULL,
  `basic_number_of_hours` decimal(10,2) NOT NULL DEFAULT '0.00',
  `allow_survey` tinyint(1) NOT NULL DEFAULT '0',
  `default_invitees` varchar(255) NOT NULL DEFAULT '',
  `default_timesheet_access` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.company_settings: ~5 rows (approximately)
/*!40000 ALTER TABLE `company_settings` DISABLE KEYS */;
INSERT INTO `company_settings` (`company_id`, `vat`, `show_alternative_job_number`, `show_custom_job_tags`, `gmt_offset`, `sequencial_number_id`, `allow_invoice_number_format`, `invoice_number_format`, `invoice_merge_same_day_visit`, `calender_view`, `body_font_color`, `working_hours_start_time`, `working_hours_end_time`, `resource_working_hours_from`, `resource_working_hours_to`, `basic_number_of_hours`, `allow_survey`, `default_invitees`, `default_timesheet_access`) VALUES
	(1, 0.00, 0, 0, 'UM12', 0, 0, '', 0, '', '', NULL, NULL, NULL, NULL, 0.00, 0, '', ''),
	(12, 0.00, 0, 0, 'UTC', 0, 0, '', 0, '', '', NULL, NULL, NULL, NULL, 0.00, 0, '', ''),
	(13, 0.00, 0, 0, 'UTC', 0, 0, '', 0, '', '', NULL, NULL, NULL, NULL, 0.00, 0, '', ''),
	(14, 0.00, 0, 0, 'UTC', 0, 0, '', 0, '', '', NULL, NULL, NULL, NULL, 0.00, 0, '', ''),
	(15, 0.00, 0, 0, 'UTC', 0, 0, '', 0, '', '', NULL, NULL, NULL, NULL, 0.00, 0, '', '');
/*!40000 ALTER TABLE `company_settings` ENABLE KEYS */;


-- Dumping structure for table ams.configurations
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE IF NOT EXISTS `configurations` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.configurations: ~6 rows (approximately)
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
INSERT INTO `configurations` (`id`, `text`, `value`, `is_deleted`) VALUES
	(1, 'ENCLOSED', 'ENCLOSED', 0),
	(2, 'FSU DOUBLE SIDED', 'FSU DOUBLE SIDED', 0),
	(3, 'FSU SINGLE SIDED', 'FSU SINGLE SIDED', 0),
	(4, 'MK', 'MK', 0),
	(5, 'MK1', 'MK1', 0),
	(6, 'MK1A', 'MK1A', 0);
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;


-- Dumping structure for table ams.contacts
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contact_type_id` tinyint(3) NOT NULL,
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `postcode` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `fax` varchar(20) NOT NULL DEFAULT '',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.contacts: ~8 rows (approximately)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `contact_type_id`, `first_name`, `last_name`, `address`, `postcode`, `email`, `phone`, `mobile`, `fax`, `created_by`, `created_on`, `is_deleted`) VALUES
	(1, 2, 'Joe', 'Customer', '2538 Amber Valley Drive', '30519', 'test12354@gmail.com', '2125551217', '2125551217', '', 1, '2015-09-28 18:59:47', 0),
	(2, 2, 'site3', 'contact2', 'Woodhall Spa', 'LN10 6BN', 'site3.contact2@testcompany.com', '', '', '', 1, '2015-09-28 19:03:14', 0),
	(3, 2, 'site3', 'contact3', 'Address', 'LN10 6BN', 'site3.contact3@testcompany.com', '2125551217', '2125551217', '', 1, '2015-09-28 19:04:24', 0),
	(4, 1, 'Joe', 'Customer', '', '', 'test12354@gmail.com', '2125551217', '2125551217', '', 1, '2015-09-28 17:22:54', 0),
	(5, 1, 'Jonathan', 'Dawson', 'Woodhall Spa', 'LN10 6BN', 'test12354@gmail.com', '', '', '', 1, '2015-09-28 17:23:41', 0),
	(6, 2, 'Joe', 'Customer', '2538 Amber Valley Drive', '30519', 'test12354@gmail.com', '2125551217', '2125551217', '', 1, '2015-09-28 17:30:55', 0),
	(7, 1, 'Tom', 'Black', '', '', 'tom@cc.com', '0800 599 9510', '0000 000 0000', '', 1, '2015-09-28 18:34:10', 0),
	(8, 2, 'tes', 'test', 'etst', '', 'test', 'tes', 'ttest', 'test', 1, '2015-09-29 18:08:23', 0);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;


-- Dumping structure for table ams.contact_types
DROP TABLE IF EXISTS `contact_types`;
CREATE TABLE IF NOT EXISTS `contact_types` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.contact_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `contact_types` DISABLE KEYS */;
INSERT INTO `contact_types` (`id`, `name`) VALUES
	(1, 'Company'),
	(2, 'Site');
/*!40000 ALTER TABLE `contact_types` ENABLE KEYS */;


-- Dumping structure for table ams.custom_fields
DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '',
  `default` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  `options` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.custom_fields: ~0 rows (approximately)
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;


-- Dumping structure for table ams.documents
DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `document_type_id` tinyint(3) unsigned NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `uploaded_by` int(11) unsigned NOT NULL,
  `uploaded_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mime_type` varchar(100) NOT NULL,
  `is_image` tinyint(1) NOT NULL,
  `thumbnail_name` varchar(255) NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `permission` text,
  `raw_data` text,
  `remember_code` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_type_id` (`document_type_id`),
  KEY `uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.documents: ~0 rows (approximately)
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;


-- Dumping structure for table ams.document_types
DROP TABLE IF EXISTS `document_types`;
CREATE TABLE IF NOT EXISTS `document_types` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.document_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `document_types` DISABLE KEYS */;
INSERT INTO `document_types` (`id`, `name`) VALUES
	(1, 'Company'),
	(2, 'Site');
/*!40000 ALTER TABLE `document_types` ENABLE KEYS */;


-- Dumping structure for table ams.form_section
DROP TABLE IF EXISTS `form_section`;
CREATE TABLE IF NOT EXISTS `form_section` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.form_section: ~2 rows (approximately)
/*!40000 ALTER TABLE `form_section` DISABLE KEYS */;
INSERT INTO `form_section` (`id`, `name`, `sort_order`, `is_deleted`) VALUES
	(1, 'ENTRY FORM', 1, 0),
	(2, 'RISK ASSESSMENT', 2, 0);
/*!40000 ALTER TABLE `form_section` ENABLE KEYS */;


-- Dumping structure for table ams.form_types
DROP TABLE IF EXISTS `form_types`;
CREATE TABLE IF NOT EXISTS `form_types` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.form_types: ~3 rows (approximately)
/*!40000 ALTER TABLE `form_types` DISABLE KEYS */;
INSERT INTO `form_types` (`id`, `name`, `is_deleted`) VALUES
	(1, 'SURVEY FORM', 0),
	(2, 'INSTALL FORM', 1),
	(3, 'INSTALL FORM', 0);
/*!40000 ALTER TABLE `form_types` ENABLE KEYS */;


-- Dumping structure for table ams.grid_columns
DROP TABLE IF EXISTS `grid_columns`;
CREATE TABLE IF NOT EXISTS `grid_columns` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `grid_column_type_id` tinyint(3) unsigned NOT NULL,
  `column_name` varchar(50) NOT NULL,
  `column_label` varchar(50) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `searchable` tinyint(1) NOT NULL DEFAULT '0',
  `sortable` tinyint(1) NOT NULL DEFAULT '0',
  `cs_class` varchar(20) NOT NULL DEFAULT '',
  `company_setting_column` varchar(50) NOT NULL DEFAULT '',
  `check_group` tinyint(1) NOT NULL DEFAULT '0',
  `sort_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `default_order_by` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.grid_columns: ~6 rows (approximately)
/*!40000 ALTER TABLE `grid_columns` DISABLE KEYS */;
INSERT INTO `grid_columns` (`id`, `grid_column_type_id`, `column_name`, `column_label`, `visible`, `searchable`, `sortable`, `cs_class`, `company_setting_column`, `check_group`, `sort_id`, `default_order_by`) VALUES
	(1, 1, 'full_name', 'Name', 1, 1, 1, '', '', 0, 1, 0),
	(2, 1, 'email', 'Email', 1, 1, 1, '', '', 0, 2, 0),
	(3, 1, 'company_name', 'Agency', 1, 1, 1, '', '', 0, 3, 0),
	(4, 1, 'phone', 'Phone', 1, 1, 1, '', '', 0, 4, 0),
	(5, 1, 'Group', 'group', 1, 1, 1, 'nowrap', '', 0, 5, 0),
	(6, 1, 'status', 'Status', 1, 1, 1, '', '', 0, 6, 0);
/*!40000 ALTER TABLE `grid_columns` ENABLE KEYS */;


-- Dumping structure for table ams.grid_column_types
DROP TABLE IF EXISTS `grid_column_types`;
CREATE TABLE IF NOT EXISTS `grid_column_types` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `cache_key` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.grid_column_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `grid_column_types` DISABLE KEYS */;
INSERT INTO `grid_column_types` (`id`, `name`, `cache_key`) VALUES
	(1, 'User Grid', '_user_grid_'),
	(2, 'User Popup Grid', '_user_pgrid_');
/*!40000 ALTER TABLE `grid_column_types` ENABLE KEYS */;


-- Dumping structure for table ams.groups
DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.groups: ~4 rows (approximately)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'admin', 'Administrator'),
	(2, 'management_company', 'Company (user)'),
	(8, 'staff', 'Staff'),
	(9, 'engineer', 'Engineer');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table ams.login_attempts
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.login_attempts: ~0 rows (approximately)
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;


-- Dumping structure for table ams.notes
DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_type_id` tinyint(3) unsigned NOT NULL,
  `note` text NOT NULL,
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;


-- Dumping structure for table ams.notes_types
DROP TABLE IF EXISTS `notes_types`;
CREATE TABLE IF NOT EXISTS `notes_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.notes_types: ~2 rows (approximately)
/*!40000 ALTER TABLE `notes_types` DISABLE KEYS */;
INSERT INTO `notes_types` (`id`, `name`) VALUES
	(1, 'Company'),
	(2, 'Site');
/*!40000 ALTER TABLE `notes_types` ENABLE KEYS */;


-- Dumping structure for table ams.panels
DROP TABLE IF EXISTS `panels`;
CREATE TABLE IF NOT EXISTS `panels` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.panels: ~5 rows (approximately)
/*!40000 ALTER TABLE `panels` DISABLE KEYS */;
INSERT INTO `panels` (`id`, `text`, `value`, `is_deleted`) VALUES
	(1, 'PANEL 01', 'PANEL 01', 0),
	(2, 'PANEL 02', 'PANEL 02', 0),
	(3, 'PANEL 03', 'PANEL 03', 0),
	(4, 'PANEL 04', 'PANEL 04', 0),
	(5, 'NOT SURE', 'NOT SURE', 0);
/*!40000 ALTER TABLE `panels` ENABLE KEYS */;


-- Dumping structure for table ams.questions
DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_type_id` tinyint(3) unsigned NOT NULL,
  `form_section_id` tinyint(3) unsigned NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `help_text` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '',
  `allowed_types` varchar(255) NOT NULL DEFAULT '',
  `max_size` smallint(8) unsigned NOT NULL DEFAULT '0',
  `table` varchar(50) NOT NULL DEFAULT '',
  `options` text,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.questions: ~36 rows (approximately)
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` (`id`, `form_type_id`, `form_section_id`, `description`, `help_text`, `type`, `allowed_types`, `max_size`, `table`, `options`, `sort_order`, `is_deleted`) VALUES
	(1, 1, 1, 'DATE', '', 'date', '', 0, '', NULL, 1, 0),
	(2, 1, 1, 'EXISTING STRUCTURE / BILL BOARD', '', 'text', '', 0, '', NULL, 2, 0),
	(3, 1, 1, 'PROPOSED BUILD METHOD / SHELTER', '', 'text', '', 0, '', NULL, 3, 0),
	(4, 1, 1, 'FOOTHPATH WIDTH', '', 'text', '', 0, '', NULL, 4, 0),
	(5, 1, 1, 'FOOTHPATH SLOPE', '', 'text', '', 0, '', NULL, 5, 0),
	(6, 1, 1, 'SLAB SIZE', '', 'text', '', 0, '', NULL, 6, 0),
	(7, 1, 1, 'SURFACE / COLOR', '', 'text', '', 0, '', NULL, 7, 0),
	(8, 1, 1, 'COMMENTS', '', 'textarea', '', 0, '', NULL, 8, 0),
	(9, 1, 2, 'Railings & Brick Walls', '', 'yes_no', '', 0, '', NULL, 22, 0),
	(10, 1, 2, 'Other Street Furniture', '', 'yes_no', '', 0, '', NULL, 14, 0),
	(11, 1, 2, 'Trees (roots, overhanging branches etc..)', '', 'yes_no', '', 0, '', NULL, 15, 0),
	(12, 1, 2, 'Embankments / Slopes', '', 'yes_no', '', 0, '', NULL, 16, 0),
	(13, 1, 2, 'Adverse Camber - poor visibility of site for oncoming drivers', '', 'yes_no', '', 0, '', NULL, 17, 0),
	(14, 1, 2, 'Ad Cants on Kerb side', '', 'yes_no', '', 0, '', NULL, 18, 0),
	(15, 1, 2, 'Cycle Route', '', 'yes_no', '', 0, '', NULL, 19, 0),
	(16, 1, 2, 'Traffic Calming / Central reservations', '', 'yes_no', '', 0, '', NULL, 20, 0),
	(17, 1, 2, 'Speed Limit of Road', '', 'text', '', 0, '', NULL, 21, 0),
	(18, 1, 2, 'Central Reservations', '', 'text', '', 0, '', NULL, 9, 0),
	(19, 1, 2, 'Any Other Hazards?', '', 'textarea', '', 0, '', NULL, 10, 0),
	(20, 1, 2, 'State details and solutions to reduce the risk at the site', '', 'textarea', '', 0, '', NULL, 11, 0),
	(21, 1, 2, 'NRSWA Opening Notice Req', '', 'yes_no', '', 0, '', NULL, 12, 0),
	(22, 1, 2, 'NRSWA LA letter of exemption, Reference', '', 'text', '', 0, '', NULL, 13, 0),
	(23, 2, 1, 'Test Question', '', 'upload', 'gif|jpeg|png', 65535, '', '', 1, 1),
	(24, 2, 0, 'Test', 'Test', 'upload', 'jpg|png', 65535, '', '', 0, 1),
	(25, 3, 0, 'Screen Fitted Level and Square?', '', 'yes_no', '', 0, '', '', 10, 1),
	(26, 3, 0, 'Screen Holding Brackets Fitted?', '', 'yes_no', '', 0, '', '', 7, 1),
	(27, 3, 0, 'Screen Bottom Mounting Skids Fitted?', '', 'yes_no', '', 0, '', '', 3, 0),
	(28, 3, 0, 'All Bolts and Nuts Fitted Securely?', '', 'yes_no', '', 0, '', '', 4, 1),
	(29, 3, 0, 'Static Backlight Brackets Fitted?', '', 'yes_no', '', 0, '', '', 8, 1),
	(30, 3, 0, 'Static LED Diffuser Fitted?', '', 'yes_no', '', 0, '', '', 1, 0),
	(31, 3, 0, 'Static LED Diffuser Connection Joined?', '', 'yes_no', '', 0, '', '', 9, 0),
	(32, 3, 0, 'Static LED Diffuser Protective Film Removed?', '', 'yes_no', '', 0, '', '', 2, 0),
	(33, 3, 0, 'Static Poster Completed?', '', 'yes_no', '', 0, '', '', 5, 0),
	(34, 3, 0, 'Static Backlight Screen Lanyard Fitted?', '', 'yes_no', '', 0, '', '', 6, 1),
	(35, 3, 0, 'Photo 1', '', 'upload', 'jpg|jpeg|png', 65535, '', '', 11, 0),
	(36, 3, 0, 'Photo 2', '', 'upload', 'jpg|jpeg|png', 65535, '', '', 12, 0);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;


-- Dumping structure for table ams.ranking
DROP TABLE IF EXISTS `ranking`;
CREATE TABLE IF NOT EXISTS `ranking` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.ranking: ~81 rows (approximately)
/*!40000 ALTER TABLE `ranking` DISABLE KEYS */;
INSERT INTO `ranking` (`id`, `text`, `value`, `is_deleted`) VALUES
	(1, '0', '0', 0),
	(2, '1', '1', 0),
	(3, '2', '2', 0),
	(4, '3', '3', 0),
	(5, '4', '4', 0),
	(6, '5', '5', 0),
	(7, '6', '6', 0),
	(8, '7', '7', 0),
	(9, '8', '8', 0),
	(10, '9', '9', 0),
	(11, '10', '10', 0),
	(12, '11', '11', 0),
	(13, '12', '12', 0),
	(14, '13', '13', 0),
	(15, '14', '14', 0),
	(16, '15', '15', 0),
	(17, '16', '16', 0),
	(18, '17', '17', 0),
	(19, '18', '18', 0),
	(20, '19', '19', 0),
	(21, '20', '20', 0),
	(22, '21', '21', 0),
	(23, '22', '22', 0),
	(24, '23', '23', 0),
	(25, '24', '24', 0),
	(26, '25', '25', 0),
	(27, '26', '26', 0),
	(28, '27', '27', 0),
	(29, '28', '28', 0),
	(30, '29', '29', 0),
	(31, '30', '30', 0),
	(32, '31', '31', 0),
	(33, '32', '32', 0),
	(34, '33', '33', 0),
	(35, '34', '34', 0),
	(36, '35', '35', 0),
	(37, '36', '36', 0),
	(38, '37', '37', 0),
	(39, '38', '38', 0),
	(40, '39', '39', 0),
	(41, '40', '40', 0),
	(42, '41', '41', 0),
	(43, '42', '42', 0),
	(44, '43', '43', 0),
	(45, '44', '44', 0),
	(46, '45', '45', 0),
	(47, '46', '46', 0),
	(48, '47', '47', 0),
	(49, '48', '48', 0),
	(50, '49', '49', 0),
	(51, '50', '50', 0),
	(52, '51', '51', 0),
	(53, '52', '52', 0),
	(54, '53', '53', 0),
	(55, '54', '54', 0),
	(56, '55', '55', 0),
	(57, '56', '56', 0),
	(58, '57', '57', 0),
	(59, '58', '58', 0),
	(60, '59', '59', 0),
	(61, '60', '60', 0),
	(62, '61', '61', 0),
	(63, '62', '62', 0),
	(64, '63', '63', 0),
	(65, '64', '64', 0),
	(66, '65', '65', 0),
	(67, '66', '66', 0),
	(68, '67', '67', 0),
	(69, '68', '68', 0),
	(70, '69', '69', 0),
	(71, '70', '70', 0),
	(72, '71', '71', 0),
	(73, '72', '72', 0),
	(74, '73', '73', 0),
	(75, '74', '74', 0),
	(76, '75', '75', 0),
	(77, '76', '76', 0),
	(78, '77', '77', 0),
	(79, '78', '78', 0),
	(80, '79', '79', 0),
	(81, '80', '80', 0);
/*!40000 ALTER TABLE `ranking` ENABLE KEYS */;


-- Dumping structure for table ams.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `default` text NOT NULL,
  `value` text,
  `options` text,
  PRIMARY KEY (`setting_id`),
  KEY `key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.settings: ~6 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`setting_id`, `key`, `title`, `description`, `type`, `default`, `value`, `options`) VALUES
	(1, 'currency', 'Currency', 'The currency symbol for use on products, services, etc.', 'text', '&pound;', '&pound;', NULL),
	(2, 'contact_email', 'Contact E-mail', 'All e-mails from users, guests and the site will go to this e-mail address.', 'text', 'support@ams.com', 'support@ams.com', NULL),
	(3, 'cp_theme', 'Backend Theme', 'Select the theme you want users to see by default.', 'select', 'bracket', 'bracket', '{"bracket":"V2"}'),
	(4, 'gmt_offset', 'Timezone', '', 'codeigniter_timezone', 'UTC', 'UTC', '{"front":"front","bracket":"V2","ace":"V2 Alternate"}'),
	(5, 'application_name', 'Application Name', ' ', 'text', 'AMS', 'AMS', NULL),
	(6, 'application_title', 'Application Title', ' ', 'text', 'AMS.com', 'AMS.com', NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table ams.shelter_types
DROP TABLE IF EXISTS `shelter_types`;
CREATE TABLE IF NOT EXISTS `shelter_types` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.shelter_types: ~16 rows (approximately)
/*!40000 ALTER TABLE `shelter_types` DISABLE KEYS */;
INSERT INTO `shelter_types` (`id`, `text`, `value`, `is_deleted`) VALUES
	(1, 'INSIGNIA', 'INSIGNIA', 0),
	(2, 'LANDMARK', 'LANDMARK', 0),
	(3, 'TRANSIT', 'TRANSIT', 0),
	(4, 'TRUEFORM', 'TRUEFORM', 0),
	(5, 'PRINCIPAL', 'PRINCIPAL', 0),
	(6, 'TRUEFORM GULL WING', 'TRUEFORM GULL WING', 0),
	(7, 'HERITAGE', 'HERITAGE', 0),
	(8, 'FREE STANDING UNIT', 'FREE STANDING UNIT', 0),
	(9, 'EOLE', 'EOLE', 0),
	(10, 'UNIVERSAL', 'UNIVERSAL', 0),
	(11, 'LANDMARK LONDON', 'LANDMARK LONDON', 0),
	(12, 'BSL', 'BSL', 0),
	(13, 'SIGMA', 'SIGMA', 0),
	(14, 'ALPHA', 'ALPHA', 0),
	(15, 'TIMELINE', 'TIMELINE', 0),
	(16, 'TRAFALGAR', 'TRAFALGAR', 0);
/*!40000 ALTER TABLE `shelter_types` ENABLE KEYS */;


-- Dumping structure for table ams.sites
DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `code` varchar(20) NOT NULL DEFAULT '',
  `district_no` varchar(20) NOT NULL DEFAULT '',
  `site_ref` varchar(20) NOT NULL DEFAULT '',
  `address` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(100) NOT NULL DEFAULT '',
  `town` varchar(100) NOT NULL DEFAULT '',
  `postcode` varchar(10) NOT NULL DEFAULT '',
  `current_score` varchar(100) NOT NULL DEFAULT '',
  `upload_date` date DEFAULT NULL,
  `colour_code` varchar(20) NOT NULL DEFAULT '',
  `static_scroller` varchar(50) NOT NULL DEFAULT '',
  `shelter_fsu` varchar(50) NOT NULL DEFAULT '',
  `easting` varchar(50) NOT NULL DEFAULT '',
  `northing` varchar(50) NOT NULL DEFAULT '',
  `shelter_type` varchar(50) NOT NULL DEFAULT '',
  `site_configuration` varchar(50) NOT NULL DEFAULT '',
  `height` varchar(50) NOT NULL DEFAULT '',
  `panel` varchar(50) NOT NULL DEFAULT '',
  `ranking` varchar(50) NOT NULL DEFAULT '',
  `embargo_start_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT '',
  `power_build_pack_requested` date DEFAULT NULL,
  `power_build_pack_received_ttc` date DEFAULT NULL,
  `actual_power_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `power_build_date` date DEFAULT NULL,
  `meter_build_date` date DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table ams.sites: ~4 rows (approximately)
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;
INSERT INTO `sites` (`id`, `company_id`, `code`, `district_no`, `site_ref`, `address`, `street`, `town`, `postcode`, `current_score`, `upload_date`, `colour_code`, `static_scroller`, `shelter_fsu`, `easting`, `northing`, `shelter_type`, `site_configuration`, `height`, `panel`, `ranking`, `embargo_start_date`, `status`, `power_build_pack_requested`, `power_build_pack_received_ttc`, `actual_power_cost`, `power_build_date`, `meter_build_date`, `created_on`, `created_by`, `is_deleted`) VALUES
	(9, 14, '0072', '6401', '18598', 'Holburn St  Nr Union Grove Aberdeen', 'Holburn St  Nr Union Grove Aberdeen', 'ABERDEEN CITY OF', 'AB10 6BX', '', '2015-09-29', '', 'STATIC', 'SHELTER', '', '', '', '', '', '', '', NULL, '', NULL, NULL, 0.00, NULL, NULL, '2015-09-29 18:36:09', 1, 1),
	(10, 14, '0072', '6401', '18598', 'Holburn St  Nr Union Grove Aberdeen', 'Holburn St  Nr Union Grove Aberdeen', 'ABERDEEN CITY OF', 'AB10 6BX', '', '2015-09-30', '', 'STATIC', 'SHELTER', '393264.34', '805633.8', 'INSIGNIA', 'MK1A', '2220', 'PANEL 04', '12', '2015-09-30', 'POWER INSTALLED', '2015-06-15', '2015-07-15', 190.00, '2015-07-05', '2015-07-16', '2015-09-30 10:52:46', 1, 1),
	(11, 14, '0218', '6401', '67210', 'o/s 179 Union St S.S City Centre Aberdeen', 'o/s 179 Union St S.S City Centre Aberdeen', 'ABERDEEN CITY OF', 'AB10 1LG', '', '2015-10-21', '', 'STATIC', 'SHELTER', '', '', '', '', '', '', '', NULL, '', NULL, NULL, 0.00, NULL, NULL, '2015-10-21 08:36:16', 1, 1),
	(12, 14, '00001', '12345', 'LG0001', 'LONG ROAD', 'SIDCUP', 'KENT', 'DA14 5TD', '', '2015-10-29', '', 'STATIC', 'SHELTER', 'TEST', 'TEST', 'INSIGNIA', 'FSU DOUBLE SIDED', 'TEST', 'PANEL 02', '', '2015-10-29', 'APPLICATION IN PROCESS', '2015-10-29', '2015-10-29', 250.00, '2015-10-29', '2015-10-29', '2015-10-29 14:38:26', 1, 0);
/*!40000 ALTER TABLE `sites` ENABLE KEYS */;


-- Dumping structure for table ams.site_contacts
DROP TABLE IF EXISTS `site_contacts`;
CREATE TABLE IF NOT EXISTS `site_contacts` (
  `site_id` int(11) unsigned NOT NULL,
  `contact_id` bigint(20) unsigned NOT NULL,
  `is_default` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`site_id`,`contact_id`),
  KEY `contact_id` (`contact_id`),
  KEY `site_id` (`site_id`),
  KEY `is_default` (`is_default`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.site_contacts: ~5 rows (approximately)
/*!40000 ALTER TABLE `site_contacts` DISABLE KEYS */;
INSERT INTO `site_contacts` (`site_id`, `contact_id`, `is_default`) VALUES
	(4, 1, 0),
	(4, 2, 0),
	(4, 6, 0),
	(4, 3, 1),
	(8, 8, 1);
/*!40000 ALTER TABLE `site_contacts` ENABLE KEYS */;


-- Dumping structure for table ams.site_documents
DROP TABLE IF EXISTS `site_documents`;
CREATE TABLE IF NOT EXISTS `site_documents` (
  `site_id` int(11) unsigned NOT NULL,
  `document_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`site_id`,`document_id`),
  KEY `document_id` (`document_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.site_documents: ~0 rows (approximately)
/*!40000 ALTER TABLE `site_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_documents` ENABLE KEYS */;


-- Dumping structure for table ams.site_forms
DROP TABLE IF EXISTS `site_forms`;
CREATE TABLE IF NOT EXISTS `site_forms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(11) unsigned NOT NULL,
  `form_type_id` tinyint(3) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `added_on` datetime DEFAULT NULL,
  `added_by` int(11) unsigned NOT NULL DEFAULT '0',
  `completed_on` datetime DEFAULT NULL,
  `completed_by` int(11) unsigned NOT NULL DEFAULT '0',
  `submitted_on` datetime DEFAULT NULL,
  `submitted_by` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.site_forms: ~9 rows (approximately)
/*!40000 ALTER TABLE `site_forms` DISABLE KEYS */;
INSERT INTO `site_forms` (`id`, `site_id`, `form_type_id`, `status`, `added_on`, `added_by`, `completed_on`, `completed_by`, `submitted_on`, `submitted_by`) VALUES
	(1, 10, 1, 2, '2015-10-09 15:47:18', 1, '2015-10-15 08:31:52', 1, NULL, 0),
	(2, 10, 2, 2, '2015-10-18 14:49:18', 1, '2015-10-24 07:01:12', 1, NULL, 0),
	(3, 10, 3, 2, '2015-10-26 08:31:24', 1, '2015-10-26 08:32:22', 1, NULL, 0),
	(4, 11, 1, 2, '2015-10-26 08:33:40', 1, '2015-10-26 08:39:45', 14, NULL, 0),
	(5, 10, 3, 2, '2015-10-29 12:05:57', 1, '2015-10-29 12:09:23', 1, '2015-10-29 12:09:41', 19),
	(6, 10, 3, 2, '2015-10-29 12:10:08', 1, NULL, 0, '2015-10-29 12:10:47', 19),
	(7, 10, 3, 1, '2015-10-29 12:12:55', 1, NULL, 0, NULL, 0),
	(8, 12, 3, 2, '2015-10-29 14:39:25', 1, NULL, 0, '2015-10-29 15:18:04', 1),
	(9, 12, 3, 1, '2015-10-29 15:26:48', 1, NULL, 0, NULL, 0);
/*!40000 ALTER TABLE `site_forms` ENABLE KEYS */;


-- Dumping structure for table ams.site_form_feedback
DROP TABLE IF EXISTS `site_form_feedback`;
CREATE TABLE IF NOT EXISTS `site_form_feedback` (
  `site_form_id` int(11) unsigned NOT NULL,
  `site_id` int(11) unsigned NOT NULL,
  `form_type_id` tinyint(3) unsigned NOT NULL,
  `question_id` int(11) unsigned NOT NULL,
  `answer` text NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`site_form_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.site_form_feedback: ~44 rows (approximately)
/*!40000 ALTER TABLE `site_form_feedback` DISABLE KEYS */;
INSERT INTO `site_form_feedback` (`site_form_id`, `site_id`, `form_type_id`, `question_id`, `answer`, `notes`) VALUES
	(5, 10, 3, 25, 'NA', ''),
	(5, 10, 3, 26, 'Yes', ''),
	(5, 10, 3, 27, 'Yes', ''),
	(5, 10, 3, 28, 'Yes', ''),
	(5, 10, 3, 29, 'NA', ''),
	(5, 10, 3, 30, 'NA', 'J'),
	(5, 10, 3, 31, 'NA', ''),
	(5, 10, 3, 32, 'NA', ''),
	(5, 10, 3, 33, 'Yes', ''),
	(5, 10, 3, 34, 'NA', ''),
	(6, 10, 3, 25, 'NA', ''),
	(6, 10, 3, 26, 'NA', ''),
	(6, 10, 3, 27, 'NA', ''),
	(6, 10, 3, 28, 'NA', ''),
	(6, 10, 3, 29, 'NA', ''),
	(6, 10, 3, 30, 'NA', ''),
	(6, 10, 3, 31, 'NA', ''),
	(6, 10, 3, 32, 'NA', ''),
	(6, 10, 3, 33, 'NA', ''),
	(6, 10, 3, 34, 'NA', ''),
	(7, 10, 3, 25, 'No', ''),
	(8, 12, 3, 25, 'Yes', ''),
	(8, 12, 3, 26, 'Yes', ''),
	(8, 12, 3, 27, 'Yes', ''),
	(8, 12, 3, 28, 'Yes', ''),
	(8, 12, 3, 29, 'Yes', ''),
	(8, 12, 3, 30, 'Yes', ''),
	(8, 12, 3, 31, 'Yes', ''),
	(8, 12, 3, 32, 'Yes', ''),
	(8, 12, 3, 33, 'Yes', ''),
	(8, 12, 3, 34, 'Yes', ''),
	(8, 12, 3, 35, '563238626e53b.jpg', 'Just taken mobile photo'),
	(8, 12, 3, 36, '563238ac019e7.jpg', ''),
	(9, 12, 3, 25, 'NA', ''),
	(9, 12, 3, 26, 'NA', ''),
	(9, 12, 3, 27, 'NA', ''),
	(9, 12, 3, 28, 'NA', ''),
	(9, 12, 3, 29, 'NA', ''),
	(9, 12, 3, 30, 'NA', ''),
	(9, 12, 3, 31, 'NA', ''),
	(9, 12, 3, 32, 'NA', ''),
	(9, 12, 3, 33, 'NA', ''),
	(9, 12, 3, 34, 'NA', ''),
	(9, 12, 3, 35, '', '');
/*!40000 ALTER TABLE `site_form_feedback` ENABLE KEYS */;


-- Dumping structure for table ams.site_notes
DROP TABLE IF EXISTS `site_notes`;
CREATE TABLE IF NOT EXISTS `site_notes` (
  `site_id` int(11) unsigned NOT NULL,
  `note_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`site_id`,`note_id`),
  KEY `note_id` (`note_id`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.site_notes: ~0 rows (approximately)
/*!40000 ALTER TABLE `site_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `site_notes` ENABLE KEYS */;


-- Dumping structure for table ams.statuses
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(50) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ams.statuses: ~7 rows (approximately)
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` (`id`, `text`, `value`, `is_deleted`) VALUES
	(1, 'APPLICATION IN PROCESS', 'APPLICATION IN PROCESS', 0),
	(2, 'APPLICATION SENT', 'APPLICATION SENT', 0),
	(3, 'APPROVED', 'APPROVED', 0),
	(4, 'AWAITING COUNCIL INFO', 'AWAITING COUNCIL INFO', 0),
	(5, 'DEEMED CONSENT', 'DEEMED CONSENT', 0),
	(6, 'NOT FOR ADSHEL LIVE', 'NOT FOR ADSHEL LIVE', 0),
	(7, 'POWER INSTALLED', 'POWER INSTALLED', 0);
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;


-- Dumping structure for table ams.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `workhours` varchar(100) DEFAULT NULL,
  `gmt_offset` varchar(20) NOT NULL DEFAULT 'UTC',
  `gps_device_id` varchar(100) NOT NULL DEFAULT '',
  `latitude` decimal(11,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `hourly_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table ams.users: ~12 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `avatar`, `postcode`, `workhours`, `gmt_offset`, `gps_device_id`, `latitude`, `longitude`, `hourly_rate`, `is_deleted`) VALUES
	(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '08tpcqSvwNDkVUTmM3D8V.', 1268889823, 1448445833, 1, 'Super', 'admin1', '+919876611459', '56333653aea7d.jpg', '', NULL, 'UP1', '', NULL, NULL, 0.00, 0),
	(13, '86.139.82.243', 'client manager', '$2y$08$yL9Sy7JGLJ/wRCw2CVnWeeg0kbA24YA6estOexEEj7JeN8R4fAW3O', NULL, 'manager@blackwebs.co.uk', NULL, NULL, NULL, NULL, 1443612033, 1443622362, 1, 'Client', 'Manager', '0800 599 9510', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 1),
	(14, '86.139.82.243', 'client user', '$2y$08$hItOoltX9JSDwh.ubs5cFe8i.KdATpoAhfkGYoMNoqhl.hFUjpgQ6', NULL, 'user@blackwebs.co.uk', NULL, NULL, NULL, 'XWlNv3d1yWr42dkMQZKOe.', 1443612102, 1445848945, 1, 'Client', 'User', '0800 599 9510', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 1),
	(15, '122.173.201.64', 'test admin', '$2y$08$OnlOe5m0OD7y8zjk/bAa6OvNoySfNji5y91Jed279HqzyWlJch8oa', NULL, 'test.admin@admin.com', NULL, NULL, NULL, NULL, 1443622222, NULL, 1, 'test', 'admin', '121312312', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 1),
	(16, '86.166.202.118', 'cc user', '$2y$08$WLzbBINf4tMWG.AfSRNxOeA3wSqJDoOGuojJxrTKeLSmQtKB70/Pu', NULL, 'ccuser@blackwebs.co.uk', NULL, NULL, NULL, 'Zi2qjAki7AwJGQZSsZVM8O', 1445850333, 1445886409, 1, 'cc', 'user', '0800', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 1),
	(17, '86.166.202.118', 'test staff', '$2y$08$ECFRPJC9Nu6OTFRZeLShcO6U7KUMCCFMct0Ahm7iyxl5nSSsTlS0q', NULL, 'staff@blackwebs.co.uk', NULL, NULL, NULL, '0mntw3DSQQtWsVF2869hZ.', 1446120116, 1446120133, 1, 'Test', 'Staff', '0800 599 9510', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 1),
	(18, '86.166.202.118', 'cc user1', '$2y$08$o0/lzFMunYJ44Y1wySn0gOjGm0asx4HeR/SSXBfJ5glI5aE5jhvqG', NULL, 'ccuser1@blackwebs.co.uk', NULL, NULL, NULL, 'asahheBHDRhkUZYPhsNuse', 1446120205, 1446120213, 1, 'CC', 'User', '0800 599 9510', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 1),
	(19, '86.166.202.118', 'engineer user', '$2y$08$eCpjdByd3U7L.Q7A1F4sHOXuGqGuy8FaGOYpfWwhiw5KNxhrEn8jm', NULL, 'engine@blackwebs.co.uk', NULL, NULL, NULL, 'W/Lb6PHgL/nCt7QDHmB0d.', 1446120249, 1446129439, 1, 'Engineer', 'User', '0800 599 9510', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 1),
	(20, '86.166.202.118', 'cc user2', '$2y$08$htw7d0ZqvI4fSo/U/XayaeJy25WEiL.zFgfYneI7kDpt0gtkkDIpW', NULL, 'ccuser2@blackwebs.co.uk', NULL, NULL, NULL, 'INW2AVkS4wUui5EhvT8mUO', 1446127235, 1446195826, 1, 'cc', 'user', '0800 599 9510', NULL, NULL, NULL, 'UP1', '', NULL, NULL, 0.00, 0),
	(22, '86.166.202.118', 'op user', '$2y$08$jDc3/AVDpXE56OgL9bynyuLrn6xQpEyzbqrYLU.N/KH2sumGts1Jy', NULL, 'op@blackwebs.co.uk', NULL, NULL, NULL, 'lXG7Qd6C9ko10N8xEwH8W.', 1446129423, 1446141707, 1, 'op', 'user', '08005 99550', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 0),
	(23, '86.166.202.118', 'external  staff', '$2y$08$J/0eTxggvawE7f7AkH4WEe.N9MDpaSaBCF0okFLbPhE/kEBjOX9am', NULL, 'extstaff@test.com', NULL, NULL, NULL, 'NhrqZkD77mRhi8R1pmoPUO', 1446141685, 1446141711, 1, 'External ', 'Staff', '0707070707 ', NULL, NULL, NULL, 'UP1', '', NULL, NULL, 0.00, 0),
	(24, '86.166.202.118', 'black webs', '$2y$08$nPNDWTxQ4WtJiskLxuqqYeKAfdwTdIakSPZxELm6Q94i32/Zx6Wci', NULL, 'tom@blackwebs.co.uk', NULL, NULL, NULL, 'UiMgyl7ap6.RSlr0.0hRFO', 1446142015, 1446142024, 1, 'black', 'webs', '0800 599 9510', NULL, NULL, NULL, 'UTC', '', NULL, NULL, 0.00, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table ams.users_groups
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table ams.users_groups: ~18 rows (approximately)
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
	(1, 1),
	(12, 1),
	(15, 1),
	(8, 2),
	(9, 2),
	(10, 2),
	(13, 2),
	(18, 2),
	(23, 2),
	(11, 3),
	(14, 3),
	(16, 3),
	(24, 3),
	(17, 8),
	(20, 8),
	(21, 8),
	(19, 9),
	(22, 9);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;


-- Dumping structure for table ams.user_clients
DROP TABLE IF EXISTS `user_clients`;
CREATE TABLE IF NOT EXISTS `user_clients` (
  `user_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`client_id`),
  KEY `fk_user_id_idx` (`user_id`),
  KEY `fk_client_id_idx` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.user_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_clients` ENABLE KEYS */;


-- Dumping structure for table ams.user_company
DROP TABLE IF EXISTS `user_company`;
CREATE TABLE IF NOT EXISTS `user_company` (
  `user_id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`company_id`),
  KEY `fk_user_id_idx` (`user_id`),
  KEY `fk_company_id_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.user_company: ~7 rows (approximately)
/*!40000 ALTER TABLE `user_company` DISABLE KEYS */;
INSERT INTO `user_company` (`user_id`, `company_id`) VALUES
	(8, 12),
	(9, 12),
	(10, 13),
	(12, 14),
	(13, 14),
	(18, 14),
	(23, 1);
/*!40000 ALTER TABLE `user_company` ENABLE KEYS */;


-- Dumping structure for table ams.user_grid_columns
DROP TABLE IF EXISTS `user_grid_columns`;
CREATE TABLE IF NOT EXISTS `user_grid_columns` (
  `user_id` int(11) unsigned NOT NULL,
  `grid_column_id` smallint(5) unsigned NOT NULL,
  `grid_column_type_id` tinyint(3) unsigned NOT NULL,
  `visible` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`grid_column_id`,`grid_column_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ams.user_grid_columns: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_grid_columns` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_grid_columns` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
