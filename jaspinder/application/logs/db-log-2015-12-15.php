SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'admin@admin.com' 
 Execution Time:0.051048040390015
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'admin@admin.com'
AND `remember_code` = '5v3rhuJE5TisySYYIibece'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.0011630058288574
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
 Execution Time:0.1032121181488
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.041194915771484
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.052990913391113
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00081706047058105
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00054502487182617
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00071811676025391
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.12956404685974
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00038480758666992
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0013048648834229
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0012319087982178
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 25
GROUP BY `u`.`id` 
 Execution Time:0.0027248859405518
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 25 
 Execution Time:0.0019700527191162
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00070095062255859
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` = 15
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0010690689086914
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00072288513183594
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0016288757324219
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00024795532226562
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0011529922485352
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00086688995361328
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 25
GROUP BY `u`.`id` 
 Execution Time:0.0018560886383057
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 25 
 Execution Time:0.0012040138244629
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.060756921768188
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010521411895752
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0015320777893066
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.006882905960083
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
 Execution Time:0.0019748210906982
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0010440349578857
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010638236999512
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010640621185303
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00084114074707031
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0011889934539795
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0013680458068848
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0017831325531006
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
 Execution Time:0.0024340152740479
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0010480880737305
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010449886322021
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0013191699981689
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0019431114196777
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0017299652099609
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00088000297546387
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00083303451538086
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.0010759830474854
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00086498260498047
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010998249053955
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0012788772583008
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00083804130554199
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0020411014556885
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
 Execution Time:0.0021770000457764
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00079202651977539
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010521411895752
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0012528896331787
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00074195861816406
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00068092346191406
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00060391426086426
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00078582763671875
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00094509124755859
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0013070106506348
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0019500255584717
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00083684921264648
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.0020511150360107
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00044703483581543
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00180983543396
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010480880737305
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0013689994812012
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0016429424285889
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00090694427490234
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.0023860931396484
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00089192390441895
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00084781646728516
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
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
 Execution Time:0.0020010471343994
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.002000093460083
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 24
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.005000114440918
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010008811950684
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.003000020980835
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0090010166168213
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 24
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010008811950684
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 24
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 24
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 24 
 Execution Time:0
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.0010001659393311
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
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '24' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 24
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 24 
 Execution Time:0
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.0010011196136475
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '24' 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 24
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 24 
 Execution Time:0
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '24' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 24
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 24 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '24' 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010001659393311
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
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
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
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010011196136475
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010008811950684
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
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.027002096176147
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
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
 Execution Time:0.040002822875977
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.002000093460083
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010008811950684
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010008811950684
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.002000093460083
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.045002937316895
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.0010008811950684
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.013000965118408
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0099999904632568
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0049998760223389
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010008811950684
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.002000093460083
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.0010008811950684
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 1
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0039999485015869
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010011196136475
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 3
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.003000020980835
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`
FROM `questions` `q`
WHERE `id` = 30
AND `form_type_id` = 3 
 Execution Time:0
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.00099992752075195
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 3
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.003000020980835
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0010001659393311
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'admin@admin.com' 
 Execution Time:0.0255889892578
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'admin@admin.com'
AND `remember_code` = 'mSAXmB6t.lPac79.t3u9EO'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.00042986869812
===============================================================================================================

UPDATE `users` SET `last_login` = 1450187547
WHERE `id` = '1' 
 Execution Time:0.0183007717133
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.01393699646
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0356040000916
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.023913860321
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00296783447266
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000498056411743
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.0151569843292
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000515222549438
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0060179233551
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000701189041138
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000340938568115
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000366926193237
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000186920166016
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000413179397583
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000799179077148
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000655889511108
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000259160995483
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
 Execution Time:0.0012149810791
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.89301300049E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0131139755249
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000643014907837
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000587940216064
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000643968582153
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000709772109985
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
 Execution Time:0.0981230735779
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00752806663513
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000568866729736
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000479936599731
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000998020172119
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000598192214966
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000421047210693
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000617027282715
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00323414802551
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000771999359131
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000331878662109
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0337669849396
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000156879425049
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000248908996582
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000454902648926
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000751972198486
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000691890716553
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000530004501343
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000455141067505
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00611805915833
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00475907325745
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00888800621033
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000558137893677
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
ORDER BY `s`.`created_on` ASC
 LIMIT 10 
 Execution Time:0.0337262153625
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0146291255951
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00306606292725
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00985288619995
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000679969787598
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0124371051788
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000787973403931
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
 Execution Time:0.000885009765625
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000350952148438
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000615119934082
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000370025634766
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000910043716431
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000683069229126
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000414848327637
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.0255830287933
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
 Execution Time:0.000926971435547
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
 Execution Time:0.0107560157776
===============================================================================================================

SELECT `srv`.*, IFNULL(sff.answer, '') AS answer, IFNULL(sff.notes, '') AS notes
FROM `site_forms`
INNER JOIN (SELECT
	`sf`.`id` AS `site_form_id`,`sf`.`site_id`, `q`.`id` AS `question_id`, `q`.`description` AS `question_desc`, `q`.`help_text`,`q`.`type` AS `question_type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`options`
	, `q`.`table` AS `question_table`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`sort_order`	
FROM site_forms sf
	INNER JOIN questions q ON sf.form_type_id =q.form_type_id
WHERE 
	sf.site_id=12
	AND sf.form_type_id=3) AS srv ON `site_forms`.`id`=`srv`.`site_form_id` AND `site_forms`.`site_id`=`srv`.`site_id` AND `site_forms`.`form_type_id`=`srv`.`form_type_id`
LEFT JOIN `site_form_feedback` `sff` ON `srv`.`site_form_id`=`sff`.`site_form_id` AND `srv`.`site_id`=`sff`.`site_id` AND `srv`.`form_type_id`=`sff`.`form_type_id` AND `srv`.`question_id`=`sff`.`question_id`
WHERE `site_forms`.`site_id` = 12
AND `site_forms`.`form_type_id` = 3
AND `site_forms`.`id` = 8
ORDER BY `srv`.`form_type_id` ASC, `srv`.`form_section_id` ASC, `srv`.`sort_order` ASC 
 Execution Time:0.101034879684
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00049614906311
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000957012176514
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00441193580627
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000580072402954
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00350999832153
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00062894821167
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000787019729614
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00541400909424
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0107841491699
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
ORDER BY `s`.`created_on` ASC
 LIMIT 10 
 Execution Time:0.00320196151733
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000103950500488
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000421047210693
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000591993331909
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00100779533386
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000771045684814
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000505924224854
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000540018081665
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00506210327148
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000785112380981
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000773906707764
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000408887863159
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 1 
 Execution Time:0.00483703613281
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000366926193237
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000704050064087
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000759124755859
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000495910644531
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000442981719971
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00150585174561
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000900983810425
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000761985778809
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00520706176758
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.00200200080872
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 3
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0323219299316
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00670909881592
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00993299484253
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000608921051025
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000281810760498
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000253200531006
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`
FROM `questions` `q`
WHERE `id` = 30
AND `form_type_id` = 3 
 Execution Time:0.000287055969238
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.000431060791016
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000488042831421
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000591993331909
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000587940216064
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000275135040283
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000370979309082
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`
FROM `questions` `q`
WHERE `id` = 36
AND `form_type_id` = 3 
 Execution Time:0.000211954116821
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.000258207321167
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000995874404907
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000730037689209
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00805401802063
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000519037246704
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000417947769165
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 3
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.000672101974487
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000550031661987
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000473976135254
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 29
GROUP BY `u`.`id` 
 Execution Time:0.000722885131836
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 29 
 Execution Time:0.000509977340698
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.0411250591278
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000247955322266
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
 Execution Time:0.000988960266113
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000412940979004
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '29' 
 Execution Time:0.000720977783203
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00483179092407
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 29
GROUP BY `u`.`id` 
 Execution Time:0.0024139881134
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 29 
 Execution Time:0.000741958618164
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000281095504761
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000174999237061
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '29' 
 Execution Time:0.000441074371338
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00515985488892
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000314950942993
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 29
GROUP BY `u`.`id` 
 Execution Time:0.000485897064209
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 29 
 Execution Time:0.000525951385498
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00034499168396
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000139951705933
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '29' 
 Execution Time:0.000279903411865
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
ORDER BY `s`.`created_on` ASC
 LIMIT 10 
 Execution Time:0.000822067260742
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.89301300049E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000268936157227
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000595092773438
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 29
GROUP BY `u`.`id` 
 Execution Time:0.000601768493652
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 29 
 Execution Time:0.000707149505615
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000334978103638
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000190019607544
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '29' 
 Execution Time:0.000603914260864
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00124597549438
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
 Execution Time:0.00102400779724
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000422954559326
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 29
GROUP BY `u`.`id` 
 Execution Time:0.000670194625854
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 29 
 Execution Time:0.000661134719849
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00033712387085
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000180959701538
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '29' 
 Execution Time:0.000648021697998
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000907897949219
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000511884689331
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000427961349487
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 28
GROUP BY `u`.`id` 
 Execution Time:0.00059986114502
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 28 
 Execution Time:0.000581979751587
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000241994857788
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000149011611938
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
 Execution Time:0.00105309486389
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000303983688354
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '28' 
 Execution Time:0.00455808639526
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00068211555481
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 28
GROUP BY `u`.`id` 
 Execution Time:0.000901937484741
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 28 
 Execution Time:0.000627994537354
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000275135040283
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.0001380443573
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '28' 
 Execution Time:0.00053596496582
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000492811203003
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 28
GROUP BY `u`.`id` 
 Execution Time:0.00106000900269
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 28 
 Execution Time:0.000795125961304
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000411033630371
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000195980072021
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
 Execution Time:0.00101089477539
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000414133071899
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '28' 
 Execution Time:0.000671148300171
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000539064407349
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 28
GROUP BY `u`.`id` 
 Execution Time:0.000777006149292
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 28 
 Execution Time:0.0058867931366
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000495195388794
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000191926956177
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '28' 
 Execution Time:0.00851106643677
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00527596473694
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000461101531982
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000828981399536
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000675916671753
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
 Execution Time:0.000997066497803
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000365018844604
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000503063201904
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000485897064209
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000909090042114
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000583171844482
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000279188156128
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00349593162537
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.0013427734375
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00481390953064
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000553846359253
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000744819641113
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000420093536377
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
 Execution Time:0.00128388404846
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000124931335449
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.023068189621
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000525951385498
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000668048858643
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000573873519897
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000324010848999
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 28
GROUP BY `u`.`id` 
 Execution Time:0.0020010471344
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0307021141052
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000510931015015
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000753879547119
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000880002975464
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000327110290527
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 28
GROUP BY `u`.`id` 
 Execution Time:0.0011670589447
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000257968902588
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000154972076416
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000293016433716
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000202894210815
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000303983688354
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000524044036865
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000710964202881
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000602006912231
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000241994857788
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00054407119751
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000319957733154
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000606060028076
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00159215927124
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000642061233521
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000262975692749
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
 Execution Time:0.00123715400696
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.60691070557E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00617790222168
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000527143478394
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000975131988525
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00066614151001
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000261068344116
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000164031982422
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000832080841064
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000741958618164
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000703096389771
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000244140625
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000703096389771
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00378513336182
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000822067260742
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000322103500366
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0155639648438
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000141143798828
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000237941741943
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000566005706787
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00590109825134
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000911951065063
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000429153442383
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=14) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 14 
 Execution Time:0.0318660736084
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00395488739014
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000514984130859
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000550985336304
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000710010528564
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000704050064087
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
 Execution Time:0.000895977020264
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000348091125488
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000709056854248
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000466108322144
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000876903533936
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000736951828003
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000346899032593
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00536203384399
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000233888626099
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0027871131897
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000757932662964
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0112888813019
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000540971755981
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00137805938721
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0001380443573
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000943183898926
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000478982925415
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000705003738403
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00059986114502
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000310897827148
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000592947006226
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.0002760887146
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000399827957153
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00714111328125
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000832080841064
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000649929046631
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000641822814941
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00114583969116
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00010085105896
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00103402137756
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000380992889404
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000575065612793
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000588893890381
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000296115875244
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000405073165894
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000327825546265
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000381946563721
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00542593002319
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000610113143921
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000738859176636
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00058388710022
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000463008880615
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000447988510132
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000953912734985
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000777959823608
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000708103179932
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000563144683838
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000612020492554
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00621700286865
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000565052032471
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000339984893799
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00307416915894
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000496864318848
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000620126724243
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00056791305542
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000483989715576
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
ORDER BY `s`.`created_on` ASC
 LIMIT 10 
 Execution Time:0.0298359394073
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000150203704834
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000540971755981
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000515222549438
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000894069671631
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000638008117676
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000525951385498
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00139999389648
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000527143478394
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000733137130737
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000576019287109
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00557398796082
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
ORDER BY `s`.`created_on` ASC
 LIMIT 10 
 Execution Time:0.00125193595886
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000125885009766
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00034499168396
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000477075576782
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000693082809448
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000611066818237
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000358104705811
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000428915023804
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00044584274292
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000892162322998
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000716924667358
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000375032424927
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00124502182007
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000113010406494
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000815868377686
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000401020050049
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00049901008606
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0010941028595
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000350952148438
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000426054000854
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000252962112427
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000359058380127
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000455856323242
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000591039657593
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000579833984375
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000256776809692
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000367164611816
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000194072723389
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000282049179077
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000537872314453
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000838041305542
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000852108001709
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00042200088501
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.150266885757
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000926971435547
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000786066055298
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000380992889404
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.00116491317749
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000661849975586
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000569820404053
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000690937042236
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000391006469727
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000427007675171
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 3
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.036731004715
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000587940216064
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000732183456421
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000630140304565
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000300168991089
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000473022460938
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`
FROM `questions` `q`
WHERE `id` = 30
AND `form_type_id` = 3 
 Execution Time:0.000278949737549
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.000310897827148
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000789880752563
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000860929489136
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000630855560303
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000239133834839
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00346899032593
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.89437103271E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000716924667358
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00126600265503
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000733852386475
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000923156738281
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000332117080688
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000498056411743
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000704050064087
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000717878341675
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000322103500366
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0178220272064
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000111818313599
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000178098678589
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000484943389893
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000778198242188
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000823974609375
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000557899475098
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000534057617188
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 3
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.000688076019287
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000696897506714
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000679969787598
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000591039657593
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000385999679565
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000324964523315
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000680923461914
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000750064849854
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000594139099121
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00754189491272
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000414133071899
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'admin@admin.com' 
 Execution Time:0.0054669380188
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'admin@admin.com'
AND `remember_code` = 'Gq9Nobo.QZaH7z1JI7zpc.'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.000657081604004
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000463008880615
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000607967376709
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00050687789917
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00111293792725
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000262975692749
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000560998916626
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000748872756958
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000623941421509
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000271081924438
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00105500221252
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.9168548584E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000169038772583
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'admin@admin.com' 
 Execution Time:0.00056791305542
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'admin@admin.com'
AND `remember_code` = 'Gq9Nobo.QZaH7z1JI7zpc.'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.000335931777954
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000373840332031
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000479936599731
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000773906707764
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00602412223816
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000460863113403
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000212907791138
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00173592567444
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000560998916626
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00540685653687
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000707864761353
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.00115919113159
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.00158190727234
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00100207328796
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00032114982605
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
 Execution Time:0.0538630485535
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000890970230103
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.000965118408203
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00292897224426
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.00159597396851
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.000750064849854
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000354051589966
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000216960906982
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.000511884689331
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.0160269737244
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
 Execution Time:0.000930070877075
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
 Execution Time:0.00471496582031
===============================================================================================================

SELECT `srv`.*, IFNULL(sff.answer, '') AS answer, IFNULL(sff.notes, '') AS notes
FROM `site_forms`
INNER JOIN (SELECT
	`sf`.`id` AS `site_form_id`,`sf`.`site_id`, `q`.`id` AS `question_id`, `q`.`description` AS `question_desc`, `q`.`help_text`,`q`.`type` AS `question_type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`options`
	, `q`.`table` AS `question_table`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`sort_order`	
FROM site_forms sf
	INNER JOIN questions q ON sf.form_type_id =q.form_type_id
WHERE 
	sf.site_id=12
	AND sf.form_type_id=3) AS srv ON `site_forms`.`id`=`srv`.`site_form_id` AND `site_forms`.`site_id`=`srv`.`site_id` AND `site_forms`.`form_type_id`=`srv`.`form_type_id`
LEFT JOIN `site_form_feedback` `sff` ON `srv`.`site_form_id`=`sff`.`site_form_id` AND `srv`.`site_id`=`sff`.`site_id` AND `srv`.`form_type_id`=`sff`.`form_type_id` AND `srv`.`question_id`=`sff`.`question_id`
WHERE `site_forms`.`site_id` = 12
AND `site_forms`.`form_type_id` = 3
AND `site_forms`.`id` = 8
ORDER BY `srv`.`form_type_id` ASC, `srv`.`form_section_id` ASC, `srv`.`sort_order` ASC 
 Execution Time:0.0334389209747
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000433921813965
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.000734090805054
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.000746965408325
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000365018844604
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000186204910278
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.000553131103516
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000602960586548
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000502824783325
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.000832796096802
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.000880002975464
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000303983688354
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000171899795532
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.000452041625977
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
ORDER BY `s`.`created_on` ASC
 LIMIT 10 
 Execution Time:0.001620054245
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000133037567139
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000424861907959
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000441074371338
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000550985336304
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000634908676147
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000257015228271
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000929832458496
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000284194946289
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000473022460938
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00068187713623
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000554084777832
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000236988067627
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00106000900269
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.08374786377E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000963926315308
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000516176223755
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000719785690308
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000697135925293
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000375032424927
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000365972518921
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000245094299316
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0246670246124
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'admin@admin.com' 
 Execution Time:0.000736951828003
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'admin@admin.com'
AND `remember_code` = 'Gq9Nobo.QZaH7z1JI7zpc.'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.000561952590942
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00220203399658
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000546932220459
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.000862121582031
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.000600099563599
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000231027603149
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000158071517944
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.000348091125488
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000565052032471
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00046181678772
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.000603914260864
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.000619888305664
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000247001647949
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000133037567139
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.00031590461731
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS s.id as site_id, `com`.`name` as `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, `s`.`address`, `s`.`street`, `s`.`town`, `s`.`postcode`, `s`.`upload_date`, `s`.`code` AS `site_code`, `s`.`created_on`, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND ct.is_deleted=0) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0
GROUP BY `s`.`id`
ORDER BY `s`.`created_on` ASC
 LIMIT 10 
 Execution Time:0.00104022026062
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.20295715332E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000278949737549
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.140162944794
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.000731945037842
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.000703096389771
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000387907028198
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000182867050171
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.000416994094849
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00108218193054
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
 Execution Time:0.00900888442993
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000500917434692
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.00115919113159
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.00119996070862
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000356197357178
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000252962112427
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.000520944595337
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00477910041809
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
 Execution Time:0.00674486160278
===============================================================================================================

SELECT `ft`.`id` as `form_type_id`, `ft`.`name` AS `form_type_name`
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0 
 Execution Time:0.00403881072998
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00332593917847
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.000996112823486
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 26 
 Execution Time:0.000800848007202
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.00579309463501
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000303983688354
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '26' 
 Execution Time:0.00289988517761
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00104284286499
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
 Execution Time:0.00107789039612
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
 Execution Time:0.000423908233643
===============================================================================================================

SELECT `srv`.*, IFNULL(sff.answer, '') AS answer, IFNULL(sff.notes, '') AS notes
FROM `site_forms`
INNER JOIN (SELECT
	`sf`.`id` AS `site_form_id`,`sf`.`site_id`, `q`.`id` AS `question_id`, `q`.`description` AS `question_desc`, `q`.`help_text`,`q`.`type` AS `question_type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`options`
	, `q`.`table` AS `question_table`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`sort_order`	
FROM site_forms sf
	INNER JOIN questions q ON sf.form_type_id =q.form_type_id
WHERE 
	sf.site_id=12
	AND sf.form_type_id=3) AS srv ON `site_forms`.`id`=`srv`.`site_form_id` AND `site_forms`.`site_id`=`srv`.`site_id` AND `site_forms`.`form_type_id`=`srv`.`form_type_id`
LEFT JOIN `site_form_feedback` `sff` ON `srv`.`site_form_id`=`sff`.`site_form_id` AND `srv`.`site_id`=`sff`.`site_id` AND `srv`.`form_type_id`=`sff`.`form_type_id` AND `srv`.`question_id`=`sff`.`question_id`
WHERE `site_forms`.`site_id` = 12
AND `site_forms`.`form_type_id` = 3
AND `site_forms`.`id` = 8
ORDER BY `srv`.`form_type_id` ASC, `srv`.`form_section_id` ASC, `srv`.`sort_order` ASC 
 Execution Time:0.00131916999817
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000599145889282
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00107598304749
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000761032104492
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00032114982605
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00129985809326
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000128984451294
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00098991394043
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000401020050049
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00054407119751
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000598907470703
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
 Execution Time:0.000790119171143
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000277996063232
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000570058822632
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000958919525146
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000703096389771
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000705003738403
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000357151031494
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.00123596191406
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000416994094849
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'admin@admin.com' 
 Execution Time:0.000385999679565
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'admin@admin.com'
AND `remember_code` = 'Gq9Nobo.QZaH7z1JI7zpc.'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.000340223312378
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000421047210693
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00150299072266
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000607013702393
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00563788414001
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000818967819214
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000712871551514
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000256776809692
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000352144241333
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000245094299316
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0012629032135
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000933170318604
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000756025314331
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000336885452271
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00116300582886
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.98973846436E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000740051269531
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000491142272949
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00106906890869
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00151300430298
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.00481700897217
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.00126791000366
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.0209929943085
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000253200531006
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
 Execution Time:0.0211350917816
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000533103942871
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000757217407227
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'admin@admin.com' 
 Execution Time:0.00161004066467
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'admin@admin.com'
AND `remember_code` = 'Gq9Nobo.QZaH7z1JI7zpc.'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.000292062759399
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000370025634766
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000504970550537
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.00089693069458
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000617027282715
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000293016433716
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000140905380249
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
 Execution Time:0.00109601020813
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000373125076294
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000695943832397
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000659942626953
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000885963439941
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000633001327515
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
 Execution Time:0.000671863555908
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00025200843811
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00422191619873
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00835013389587
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00689291954041
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000751972198486
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000654935836792
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000247001647949
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000147104263306
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
 Execution Time:0.00110793113708
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000307083129883
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000643014907837
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00531792640686
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00058388710022
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00071120262146
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000608921051025
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
 Execution Time:0.000815153121948
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000521898269653
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000581979751587
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000558137893677
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000953912734985
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000687122344971
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000366926193237
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000465869903564
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00025200843811
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000487089157104
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000698804855347
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000679969787598
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000233888626099
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000133991241455
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
 Execution Time:0.000657081604004
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000292778015137
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000893831253052
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00047492980957
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000817060470581
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000816106796265
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00037407875061
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00899219512939
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000119924545288
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000777006149292
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000493049621582
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000853061676025
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000816106796265
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000249862670898
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000143051147461
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00258612632751
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00045108795166
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000702142715454
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000829935073853
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000300168991089
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15
 LIMIT 10 
 Execution Time:0.000972032546997
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.41753387451E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15 
 Execution Time:0.00135493278503
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000527858734131
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00091814994812
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000756978988647
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00138306617737
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15
AND `g`.`id` = 2
 LIMIT 10 
 Execution Time:0.00222492218018
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000125169754028
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15
AND `g`.`id` = 2 
 Execution Time:0.000960111618042
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000654935836792
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000750064849854
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00076699256897
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000786066055298
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15
AND `g`.`id` = 2
AND (com.name LIKE '%1%'  OR CONCAT(u.first_name,' ',u.last_name) LIKE '%1%'  OR u.email LIKE '%1%'  OR u.phone LIKE '%1%' )
 LIMIT 10 
 Execution Time:0.00171709060669
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.0001380443573
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15
AND `g`.`id` = 2 
 Execution Time:0.0135688781738
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000540971755981
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000757932662964
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000680923461914
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000326156616211
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000185012817383
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000653028488159
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000671148300171
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.00421404838562
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000847101211548
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000369071960449
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000236034393311
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00623488426208
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0014750957489
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00444006919861
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000832080841064
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00076699256897
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000586032867432
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000391006469727
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0046501159668
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00157618522644
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000724077224731
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00049877166748
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
 Execution Time:0.0415740013123
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00140881538391
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000489950180054
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000447034835815
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000625848770142
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000560998916626
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000247001647949
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000428915023804
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000540018081665
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000802993774414
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.00068187713623
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000334024429321
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000188827514648
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
 Execution Time:0.00135612487793
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000462055206299
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000710010528564
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000565052032471
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000563859939575
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00065803527832
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000257968902588
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000444889068604
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00068187713623
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000564813613892
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00031304359436
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000526905059814
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000483989715576
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000761985778809
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00786399841309
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000510215759277
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 4 
 Execution Time:0.00477004051208
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000486135482788
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000643014907837
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000850200653076
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000520944595337
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 4 
 Execution Time:0.0150549411774
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000507831573486
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00673198699951
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00219202041626
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.00088095664978
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000715970993042
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000314950942993
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000174045562744
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
 Execution Time:0.00158190727234
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00631284713745
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00154995918274
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000419139862061
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000525951385498
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000576019287109
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000231027603149
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000134944915771
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00055718421936
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00046706199646
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000730991363525
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000715970993042
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000324010848999
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000195980072021
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000482082366943
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000401973724365
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000554084777832
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000602960586548
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000224113464355
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00013279914856
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000504016876221
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000494003295898
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000757932662964
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000632047653198
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.0002601146698
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000136137008667
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00116896629333
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000352144241333
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0567321777344
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000417947769165
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0569789409637
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0445261001587
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
 Execution Time:0.0379030704498
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0280380249023
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000600099563599
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000432014465332
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00244402885437
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00542712211609
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
 Execution Time:0.00145697593689
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000385999679565
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000632047653198
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000578165054321
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000726938247681
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00078010559082
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000620126724243
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000753879547119
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000644207000732
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000696897506714
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000638008117676
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000539064407349
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000704050064087
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000872850418091
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000388860702515
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00357389450073
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.0135419368744
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000476837158203
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00442290306091
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00593304634094
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00037407875061
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00882291793823
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000124931335449
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0446989536285
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00404787063599
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00596404075623
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00366902351379
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00046706199646
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000391006469727
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000685214996338
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000545978546143
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000708103179932
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000707149505615
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0334451198578
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0139520168304
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
 Execution Time:0.0857238769531
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0198609828949
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00339603424072
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000681161880493
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000688076019287
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00072193145752
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000332832336426
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000410079956055
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000260829925537
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00111603736877
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000717878341675
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000766038894653
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000477075576782
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.000936985015869
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.89301300049E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0120060443878
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000496864318848
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00125193595886
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000633955001831
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000306844711304
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.00115704536438
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0326788425446
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000442981719971
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000550031661987
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000670909881592
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000257015228271
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 33
GROUP BY `u`.`id` 
 Execution Time:0.0014181137085
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.0202980041504
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000277042388916
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000386953353882
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000185012817383
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000317811965942
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000482082366943
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000670909881592
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000730037689209
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000737905502319
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000463962554932
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000589847564697
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00555992126465
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0041389465332
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000532865524292
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00084400177002
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000763177871704
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000667810440063
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000691175460815
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00522804260254
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000706911087036
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000670909881592
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000648021697998
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000838041305542
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0117011070251
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000756025314331
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000808954238892
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000668048858643
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000504016876221
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000670909881592
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000777006149292
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.0366959571838
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000293970108032
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
 Execution Time:0.0323970317841
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000481128692627
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000531911849976
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000504970550537
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.0173890590668
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.00550889968872
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000445127487183
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000165939331055
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.0154659748077
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00144696235657
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000730991363525
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000607013702393
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000249147415161
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000149965286255
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000510931015015
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000391960144043
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000753164291382
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000721216201782
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000402927398682
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00023889541626
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00437998771667
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000548124313354
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.00210499763489
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000749826431274
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000282049179077
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00016713142395
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
 Execution Time:0.0106501579285
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000472068786621
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00205707550049
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000536918640137
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000754833221436
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000733137130737
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000452995300293
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000221014022827
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.000449895858765
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.0359580516815
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
 Execution Time:0.000923871994019
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
 Execution Time:0.000560998916626
===============================================================================================================

SELECT `srv`.*, IFNULL(sff.answer, '') AS answer, IFNULL(sff.notes, '') AS notes
FROM `site_forms`
INNER JOIN (SELECT
	`sf`.`id` AS `site_form_id`,`sf`.`site_id`, `q`.`id` AS `question_id`, `q`.`description` AS `question_desc`, `q`.`help_text`,`q`.`type` AS `question_type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`options`
	, `q`.`table` AS `question_table`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`sort_order`	
FROM site_forms sf
	INNER JOIN questions q ON sf.form_type_id =q.form_type_id
WHERE 
	sf.site_id=12
	AND sf.form_type_id=3) AS srv ON `site_forms`.`id`=`srv`.`site_form_id` AND `site_forms`.`site_id`=`srv`.`site_id` AND `site_forms`.`form_type_id`=`srv`.`form_type_id`
LEFT JOIN `site_form_feedback` `sff` ON `srv`.`site_form_id`=`sff`.`site_form_id` AND `srv`.`site_id`=`sff`.`site_id` AND `srv`.`form_type_id`=`sff`.`form_type_id` AND `srv`.`question_id`=`sff`.`question_id`
WHERE `site_forms`.`site_id` = 12
AND `site_forms`.`form_type_id` = 3
AND `site_forms`.`id` = 8
ORDER BY `srv`.`form_type_id` ASC, `srv`.`form_section_id` ASC, `srv`.`sort_order` ASC 
 Execution Time:0.01895403862
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000502109527588
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000684976577759
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000576972961426
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000231027603149
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000135898590088
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
 Execution Time:0.000725030899048
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000255107879639
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00143194198608
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000509977340698
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000710964202881
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000727891921997
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000334024429321
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000236988067627
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.00355696678162
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=10) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 10 
 Execution Time:0.00180101394653
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
 Execution Time:0.00085186958313
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
 Execution Time:0.000556945800781
===============================================================================================================

SELECT `srv`.*, IFNULL(sff.answer, '') AS answer, IFNULL(sff.notes, '') AS notes
FROM `site_forms`
INNER JOIN (SELECT
	`sf`.`id` AS `site_form_id`,`sf`.`site_id`, `q`.`id` AS `question_id`, `q`.`description` AS `question_desc`, `q`.`help_text`,`q`.`type` AS `question_type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`options`
	, `q`.`table` AS `question_table`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`sort_order`	
FROM site_forms sf
	INNER JOIN questions q ON sf.form_type_id =q.form_type_id
WHERE 
	sf.site_id=10
	AND sf.form_type_id=3) AS srv ON `site_forms`.`id`=`srv`.`site_form_id` AND `site_forms`.`site_id`=`srv`.`site_id` AND `site_forms`.`form_type_id`=`srv`.`form_type_id`
LEFT JOIN `site_form_feedback` `sff` ON `srv`.`site_form_id`=`sff`.`site_form_id` AND `srv`.`site_id`=`sff`.`site_id` AND `srv`.`form_type_id`=`sff`.`form_type_id` AND `srv`.`question_id`=`sff`.`question_id`
WHERE `site_forms`.`site_id` = 10
AND `site_forms`.`form_type_id` = 3
AND `site_forms`.`id` = 6
ORDER BY `srv`.`form_type_id` ASC, `srv`.`form_section_id` ASC, `srv`.`sort_order` ASC 
 Execution Time:0.0018789768219
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000475883483887
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 31
GROUP BY `u`.`id` 
 Execution Time:0.000786066055298
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 31 
 Execution Time:0.000702857971191
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000282049179077
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000157117843628
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
 Execution Time:0.0010769367218
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000446081161499
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '31' 
 Execution Time:0.0013701915741
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000617980957031
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00110602378845
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00093412399292
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000668048858643
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
 Execution Time:0.0027711391449
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000399112701416
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000520944595337
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000488996505737
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00574803352356
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00089693069458
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000393152236938
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000479936599731
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000321865081787
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000576972961426
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0022668838501
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000861883163452
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000391960144043
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00136399269104
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000116109848022
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0142660140991
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000521898269653
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000702857971191
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000707864761353
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000381946563721
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000488042831421
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000785112380981
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000494003295898
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000250101089478
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0474171638489
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000138998031616
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000258922576904
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0159599781036
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0543160438538
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00952482223511
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00293803215027
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000494956970215
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000684976577759
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000643968582153
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000266790390015
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00107097625732
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.41753387451E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000170946121216
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00333118438721
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000797986984253
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000572919845581
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000506162643433
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000765800476074
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000683069229126
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000555992126465
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00983905792236
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000749111175537
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000576019287109
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000504970550537
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000424861907959
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000648021697998
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000674962997437
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000539064407349
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
 Execution Time:0.0830237865448
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000142812728882
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000720977783203
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000499963760376
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000640869140625
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000610113143921
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000401020050049
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.0158040523529
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000488042831421
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00163412094116
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000822067260742
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000323057174683
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000505924224854
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000725030899048
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000741958618164
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00555205345154
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00113987922668
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000110149383545
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.0002281665802
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000530004501343
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000692129135132
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000618934631348
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000293016433716
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00301313400269
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00600910186768
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000746011734009
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000372886657715
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00119280815125
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000103950500488
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000244140625
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00487804412842
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000638961791992
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000657081604004
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000416040420532
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000557899475098
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00106000900269
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000797033309937
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00043797492981
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000519990921021
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00103497505188
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00100111961365
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000392913818359
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000524044036865
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000773906707764
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00102496147156
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000348091125488
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00545406341553
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000118970870972
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000172138214111
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000716209411621
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000640153884888
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000622034072876
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00031590461731
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=16) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 16 
 Execution Time:0.0342769622803
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000633001327515
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00134801864624
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000866889953613
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000325918197632
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=16) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 16 
 Execution Time:0.00120782852173
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000659942626953
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000847816467285
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000725030899048
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000328063964844
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=14) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 14 
 Execution Time:0.00115585327148
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00323009490967
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000894069671631
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000691175460815
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000293970108032
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=14) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 14 
 Execution Time:0.0010290145874
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000684976577759
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0217940807343
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000860929489136
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000422954559326
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=16) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 16 
 Execution Time:0.000982046127319
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000514030456543
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000698089599609
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000647783279419
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000290870666504
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=16) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 16 
 Execution Time:0.000910043716431
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000504016876221
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000679016113281
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000757932662964
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000293016433716
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0014181137085
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000149011611938
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000266790390015
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000645160675049
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00186109542847
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000637054443359
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000381946563721
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=15) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 15 
 Execution Time:0.00109004974365
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000726938247681
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000741958618164
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000638961791992
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000314950942993
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0011579990387
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000118970870972
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000194072723389
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000591993331909
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000916957855225
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000849962234497
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000483989715576
===============================================================================================================

SELECT `com`.*, `st`.`gmt_offset`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 WHERE cc.company_id=15) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`id` = 15 
 Execution Time:0.00139880180359
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000588178634644
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000916004180908
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000759840011597
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000495910644531
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000477075576782
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000648975372314
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000603914260864
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000321865081787
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.000962018966675
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.79764556885E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000182151794434
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00051212310791
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0132741928101
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000753879547119
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000291109085083
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000571966171265
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000837087631226
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00059700012207
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000347137451172
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00124406814575
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000111818313599
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000295162200928
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000494956970215
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000994920730591
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000692129135132
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000504970550537
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000375986099243
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00071382522583
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000794887542725
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00074291229248
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000560998916626
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
 Execution Time:0.0441489219666
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000143051147461
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000434875488281
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000698089599609
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000878095626831
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000756978988647
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000412940979004
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000516176223755
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000633955001831
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00062894821167
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000468969345093
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.0273561477661
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000489950180054
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000847101211548
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000664949417114
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00053882598877
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.00111079216003
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.79764556885E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000175952911377
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000513076782227
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00103306770325
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000787019729614
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000501155853271
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.000458002090454
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 3
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.378669977188
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000514984130859
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010461807251
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00107312202454
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00056004524231
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 3 
 Execution Time:0.00050687789917
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.000509023666382
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.035609960556
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000486850738525
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0335350036621
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.028354883194
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
 Execution Time:0.0396139621735
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0182771682739
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000626087188721
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000458002090454
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000643014907837
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000616073608398
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000277996063232
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000526905059814
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000285148620605
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000513792037964
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000696182250977
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000602960586548
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000291109085083
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00116515159607
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.08374786377E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00597906112671
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000781059265137
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000906944274902
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000751972198486
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000473976135254
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000578165054321
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000731945037842
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000538110733032
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000566959381104
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000270843505859
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
 Execution Time:0.0523309707642
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000122785568237
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000336885452271
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000627994537354
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00066089630127
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000570058822632
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000586986541748
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000560998916626
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000555038452148
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000769853591919
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000687122344971
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000434875488281
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000459909439087
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000684022903442
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000817060470581
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000358819961548
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0451610088348
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000153064727783
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000264883041382
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000447034835815
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000767946243286
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000720024108887
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000249862670898
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000187158584595
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000672101974487
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00104808807373
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000746011734009
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00688290596008
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000550985336304
===============================================================================================================

