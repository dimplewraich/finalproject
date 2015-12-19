SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`submitted_by` >0
AND `sf`.`completed_by` =0
ORDER BY `sf`.`submitted_on` DESC 
 Execution Time:0.0044171810150146
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0018579959869385
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011701583862305
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`submitted_by` >0
AND `sf`.`completed_by` =0
ORDER BY `sf`.`submitted_on` DESC 
 Execution Time:0.0016841888427734
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0009160041809082
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00079703330993652
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0023038387298584
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00079703330993652
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00090312957763672
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0008080005645752
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0016689300537109
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00037288665771484
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0012850761413574
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011489391326904
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0028378963470459
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00053691864013672
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0021378993988037
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012969970703125
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` DESC
 LIMIT 10 
 Execution Time:0.0028128623962402
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00053811073303223
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0020990371704102
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011470317840576
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0028281211853027
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00054097175598145
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.002363920211792
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0014441013336182
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00081300735473633
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
 LIMIT 10 
 Execution Time:0.0022358894348145
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00037002563476562
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00064587593078613
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010130405426025
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00093507766723633
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0025780200958252
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044703483581543
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.00071310997009277
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00086784362792969
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0022211074829102
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011980533599854
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0025088787078857
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0003960132598877
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.00071191787719727
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011758804321289
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=16) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 16 
 Execution Time:0.0023400783538818
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011751651763916
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=16) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 16 
 Execution Time:0.0019450187683105
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0009009838104248
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0022869110107422
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00037097930908203
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.00049805641174316
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011999607086182
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=16) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 16 
 Execution Time:0.0019888877868652
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011730194091797
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0020298957824707
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.0028769969940186
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00097799301147461
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0030989646911621
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00045394897460938
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.001662015914917
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011680126190186
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` DESC
 LIMIT 10 
 Execution Time:0.0030560493469238
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00054407119750977
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0028958320617676
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00093507766723633
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.002377986907959
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00045108795166016
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0016350746154785
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011439323425293
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` DESC
 LIMIT 10 
 Execution Time:0.0037529468536377
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00091409683227539
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0021591186523438
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00095415115356445
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0022540092468262
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0004417896270752
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0017518997192383
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010550022125244
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY CONCAT(`u`.`first_name`,' ',`u`.`last_name`) ASC
 LIMIT 10 
 Execution Time:0.0026669502258301
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00033807754516602
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0016779899597168
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00091409683227539
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY CONCAT(`u`.`first_name`,' ',`u`.`last_name`) DESC
 LIMIT 10 
 Execution Time:0.0022871494293213
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044012069702148
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0019409656524658
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00093889236450195
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15
ORDER BY CONCAT(`u`.`first_name`,' ',`u`.`last_name`) DESC
 LIMIT 10 
 Execution Time:0.0023508071899414
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00075292587280273
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15 
 Execution Time:0.0017931461334229
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012772083282471
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 16
ORDER BY CONCAT(`u`.`first_name`,' ',`u`.`last_name`) DESC
 LIMIT 10 
 Execution Time:0.0031130313873291
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00052309036254883
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 16 
 Execution Time:0.0021860599517822
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.001154899597168
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 16
ORDER BY `created_on` ASC
 LIMIT 10 
 Execution Time:0.0025918483734131
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0005650520324707
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 16 
 Execution Time:0.0031559467315674
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011470317840576
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00083398818969727
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010569095611572
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `created_on` ASC
 LIMIT 10 
 Execution Time:0.0022790431976318
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0004420280456543
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0021860599517822
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00094795227050781
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.00075006484985352
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00096392631530762
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00080204010009766
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0024688243865967
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00094890594482422
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00072097778320312
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0025341510772705
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00094199180603027
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00069403648376465
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`
FROM `questions` `q`
WHERE `id` = 1
AND `form_type_id` = 1 
 Execution Time:0.00065112113952637
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.0010521411895752
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011060237884521
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00075793266296387
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0015089511871338
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0015289783477783
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00090789794921875
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0019571781158447
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011649131774902
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.0012879371643066
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010881423950195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00082492828369141
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
 LIMIT 10 
 Execution Time:0.0015838146209717
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00031900405883789
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00060296058654785
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011520385742188
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.002251148223877
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `s`.`id` = 12
ORDER BY `sf`.`id` ASC 
 Execution Time:0.0017781257629395
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.0016889572143555
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.0014069080352783
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.0014171600341797
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.0018830299377441
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.0014688968658447
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010650157928467
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
 LIMIT 10 
 Execution Time:0.0024449825286865
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00038003921508789
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00093984603881836
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0009920597076416
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.0009150505065918
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.00065398216247559
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.00063109397888184
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.00090599060058594
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.0006859302520752
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00095009803771973
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
 LIMIT 10 
 Execution Time:0.0021169185638428
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044798851013184
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00080609321594238
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011940002441406
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.0022380352020264
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `s`.`id` = 12
ORDER BY `sf`.`id` ASC 
 Execution Time:0.0018320083618164
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.0010411739349365
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.00077104568481445
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.00073695182800293
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.0011279582977295
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.00092697143554688
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012240409851074
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00095081329345703
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0009000301361084
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `created_on` ASC
 LIMIT 10 
 Execution Time:0.0020427703857422
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00038599967956543
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0014059543609619
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.001025915145874
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 23
GROUP BY `u`.`id` 
 Execution Time:0.0023319721221924
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 23 
 Execution Time:0.0012791156768799
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012309551239014
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `created_on` ASC
 LIMIT 10 
 Execution Time:0.003511905670166
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00050806999206543
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0022439956665039
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0017209053039551
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0010530948638916
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00084304809570312
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `created_on` ASC
 LIMIT 10 
 Execution Time:0.0019760131835938
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00038599967956543
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0013699531555176
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`submitted_by` >0
AND `sf`.`completed_by` =0
ORDER BY `sf`.`submitted_on` DESC 
 Execution Time:0.0028469562530518
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0011730194091797
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010719299316406
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0015871524810791
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00080585479736328
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00094199180603027
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0019819736480713
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00041007995605469
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.001680850982666
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0015840530395508
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0010998249053955
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00085878372192383
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0017490386962891
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00037002563476562
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0013318061828613
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00094890594482422
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00070381164550781
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.037470102310181
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011410713195801
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00086283683776855
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0010101795196533
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011918544769287
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 22
GROUP BY `u`.`id` 
 Execution Time:0.0023689270019531
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00095987319946289
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.001133918762207
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00088000297546387
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0020170211791992
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044107437133789
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0018069744110107
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012221336364746
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00083494186401367
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00094103813171387
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0020380020141602
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044107437133789
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0017249584197998
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0009918212890625
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 20
GROUP BY `u`.`id` 
 Execution Time:0.0020182132720947
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00062894821166992
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00069189071655273
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00093197822570801
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0020558834075928
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044417381286621
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0015900135040283
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.001399040222168
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0008399486541748
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00077390670776367
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.001762866973877
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00028800964355469
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0013480186462402
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011789798736572
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.00084400177001953
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010099411010742
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00097298622131348
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00211501121521
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00040483474731445
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.00059103965759277
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011880397796631
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0008399486541748
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012409687042236
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0023951530456543
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0005500316619873
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00223708152771
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011391639709473
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00085616111755371
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00096797943115234
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00092983245849609
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 20
GROUP BY `u`.`id` 
 Execution Time:0.0018770694732666
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011389255523682
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00087499618530273
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0010569095611572
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012280941009521
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00080585479736328
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0017080307006836
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00034284591674805
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.00049781799316406
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0009620189666748
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010130405426025
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00095891952514648
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
 LIMIT 10 
 Execution Time:0.0020709037780762
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044608116149902
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00076818466186523
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0015151500701904
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.00090408325195312
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012331008911133
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00079798698425293
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0014140605926514
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0024251937866211
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00055599212646484
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0031859874725342
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011591911315918
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0021178722381592
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00096797943115234
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0019469261169434
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044488906860352
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0016510486602783
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0011651515960693
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0008997917175293
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0010490417480469
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012509822845459
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0013208389282227
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00085997581481934
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00081396102905273
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0017051696777344
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00037598609924316
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0013489723205566
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`submitted_by` >0
AND `sf`.`completed_by` =0
ORDER BY `sf`.`submitted_on` DESC 
 Execution Time:0.0022671222686768
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0011098384857178
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0015559196472168
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00090599060058594
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.0021078586578369
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `s`.`id` = 12
ORDER BY `sf`.`id` ASC 
 Execution Time:0.0015649795532227
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`id` = 8
ORDER BY `sf`.`id` ASC 
 Execution Time:0.00094103813171387
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`submitted_by` >0
AND `sf`.`completed_by` =0
ORDER BY `sf`.`submitted_on` DESC 
 Execution Time:0.0022680759429932
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0012190341949463
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010547637939453
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.001115083694458
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=10) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 10 
 Execution Time:0.0020179748535156
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `s`.`id` = 10
ORDER BY `sf`.`id` ASC 
 Execution Time:0.001676082611084
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`id` = 6
ORDER BY `sf`.`id` ASC 
 Execution Time:0.00096702575683594
===============================================================================================================

SELECT `sf`.*, `ft`.`name` AS `form_name`, CONCAT(u.first_name, ' ', u.last_name) AS added_by_name, CONCAT(uu.first_name, ' ', uu.last_name) AS completed_by_name, CONCAT(usb.first_name, ' ', usb.last_name) AS submitted_by_name
FROM `sites` `s`
INNER JOIN `site_forms` `sf` ON `s`.`id` = `sf`.`site_id`
INNER JOIN `form_types` `ft` ON `sf`.`form_type_id` = `ft`.`id`
LEFT JOIN `users` `u` ON `sf`.`added_by` = `u`.`id`
LEFT JOIN `users` `uu` ON `sf`.`completed_by` = `uu`.`id`
LEFT JOIN `users` `usb` ON `sf`.`submitted_by` = `usb`.`id`
WHERE `sf`.`submitted_by` >0
AND `sf`.`completed_by` =0
ORDER BY `sf`.`submitted_on` DESC 
 Execution Time:0.0015420913696289
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00090289115905762
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00084686279296875
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012350082397461
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00080585479736328
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00095295906066895
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0020370483398438
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00038504600524902
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0020031929016113
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012080669403076
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 25
GROUP BY `u`.`id` 
 Execution Time:0.0024669170379639
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 25 
 Execution Time:0.0016021728515625
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00087094306945801
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` = 15
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0012571811676025
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.001105785369873
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00071096420288086
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00090503692626953
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
ORDER BY `created_on` ASC
 LIMIT 10 
 Execution Time:0.0020859241485596
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0003809928894043
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0015509128570557
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012979507446289
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 25
GROUP BY `u`.`id` 
 Execution Time:0.0025699138641357
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 25 
 Execution Time:0.0022280216217041
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00088787078857422
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` = 15
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0011100769042969
===============================================================================================================

