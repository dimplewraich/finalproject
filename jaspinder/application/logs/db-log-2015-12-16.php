SELECT COUNT(*) AS `numrows`
FROM `users`
WHERE `email` = 'dimple.wraich91@gmail.com' 
 Execution Time:0.0276730060577
===============================================================================================================

SELECT `email`, `id`, `username`, `email`, `last_login`
FROM `users`
WHERE `email` = 'dimple.wraich91@gmail.com'
AND `remember_code` = '0u3QtcEBiNA6PhTiz4fg6O'
ORDER BY `id` DESC
 LIMIT 1 
 Execution Time:0.000635862350464
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0197770595551
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00515007972717
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0483598709106
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.0328130722046
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
 Execution Time:0.0413219928741
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00938296318054
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000564098358154
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000484943389893
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000481128692627
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
 Execution Time:0.000586032867432
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000536918640137
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
 Execution Time:0.000763893127441
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000289916992188
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00432014465332
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00059986114502
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000805139541626
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000946044921875
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
 Execution Time:0.00118684768677
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000442981719971
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000633001327515
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000630140304565
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000696897506714
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000646829605103
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000381946563721
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00160884857178
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000236034393311
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
 Execution Time:0.000725984573364
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00437617301941
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000298976898193
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.0102109909058
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.0002601146698
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
 Execution Time:0.000699043273926
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00078296661377
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0016918182373
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00206112861633
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
 Execution Time:0.029993057251
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00555682182312
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000782012939453
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000792980194092
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000279188156128
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00159811973572
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000457048416138
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.00116205215454
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000617980957031
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0040180683136
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00092601776123
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000391960144043
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000401020050049
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000257015228271
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0162000656128
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000396013259888
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000645875930786
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
 Execution Time:0.000236988067627
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000254154205322
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000248193740845
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00031590461731
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00124096870422
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00231981277466
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000922918319702
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000391006469727
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000400066375732
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00022292137146
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000651121139526
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
 Execution Time:0.0105879306793
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000884056091309
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000391960144043
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.00103211402893
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000242948532104
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000537872314453
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
 Execution Time:0.000820875167847
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000980854034424
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00069785118103
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00139617919922
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00012993812561
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000910997390747
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000478029251099
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
 Execution Time:0.00392484664917
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000410079956055
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000408172607422
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000244855880737
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
 Execution Time:0.000655889511108
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000613927841187
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000668048858643
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00108599662781
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.70363616943E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000613927841187
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00061297416687
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00085711479187
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000769853591919
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00460982322693
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.00138401985168
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000560998916626
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000570058822632
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000556945800781
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000659942626953
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000335216522217
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
 Execution Time:0.0010929107666
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000111103057861
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
AND `uc`.`company_id` = 15 
 Execution Time:0.00067400932312
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000470161437988
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000396013259888
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000400066375732
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00263094902039
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0018458366394
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000790119171143
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
 Execution Time:0.141566991806
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000478029251099
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00166797637939
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000931024551392
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00501799583435
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000862836837769
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000921964645386
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00910091400146
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000418901443481
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000200986862183
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
 Execution Time:0.000811815261841
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000810146331787
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000344038009644
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.00131702423096
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.00012993812561
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.000807046890259
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000539064407349
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00119590759277
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.00124287605286
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.0149059295654
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.079968214035
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00865387916565
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
 Execution Time:0.00790882110596
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00806021690369
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00765109062195
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000590085983276
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000794172286987
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000787019729614
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
 Execution Time:0.00119590759277
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00042200088501
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000535011291504
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000649929046631
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000577926635742
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000713109970093
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000688791275024
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000293970108032
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000159025192261
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
 Execution Time:0.000961065292358
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000353097915649
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000633955001831
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000585079193115
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000746011734009
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.00082802772522
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000312089920044
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000193119049072
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00061297416687
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.271405220032
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
 Execution Time:0.000903129577637
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
 Execution Time:0.000838041305542
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
 Execution Time:0.0455539226532
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000409841537476
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000556945800781
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000596046447754
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000216007232666
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00013279914856
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000279903411865
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.000895977020264
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
 Execution Time:0.000698089599609
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
 Execution Time:0.005530834198
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
 Execution Time:0.00160694122314
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000526905059814
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000622987747192
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000767946243286
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000258207321167
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000509977340698
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.0011579990387
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000472068786621
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.00152802467346
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000720024108887
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000337839126587
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000201225280762
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000485897064209
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00103807449341
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
 Execution Time:0.00550508499146
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
 Execution Time:0.000486135482788
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
 Execution Time:0.00165009498596
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00101208686829
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000713109970093
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000848054885864
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000274896621704
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000137090682983
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
 Execution Time:0.000931024551392
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
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000510931015015
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000458955764771
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000797033309937
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000602960586548
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000375032424927
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000225067138672
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000535011291504
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00192618370056
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000824928283691
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000711917877197
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000357151031494
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.00018310546875
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.0043671131134
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000419139862061
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000587940216064
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000457048416138
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000232934951782
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000133037567139
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
 Execution Time:0.00136685371399
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000368118286133
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00173997879028
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000566005706787
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000703096389771
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000646114349365
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000251054763794
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000140905380249
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000808954238892
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00557208061218
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000895023345947
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.00079083442688
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000319957733154
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000191926956177
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
 Execution Time:0.000947952270508
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000356912612915
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00125885009766
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000571012496948
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000745058059692
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000629901885986
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000245809555054
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000153064727783
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000501871109009
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00061297416687
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.0252451896667
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.001060962677
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000357151031494
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000191926956177
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000426054000854
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=10) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 10 
 Execution Time:0.045156955719
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
 Execution Time:0.0351378917694
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
 Execution Time:0.000692129135132
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
 Execution Time:0.0235438346863
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000643014907837
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.00077486038208
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000885009765625
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000362873077393
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000200986862183
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
 Execution Time:0.000991106033325
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000519037246704
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00166392326355
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000519990921021
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.00078010559082
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000629901885986
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000295877456665
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000213861465454
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
 Execution Time:0.00123000144958
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000380992889404
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000660181045532
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000581979751587
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000789165496826
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000665903091431
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000279903411865
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000186204910278
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000373840332031
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00095009803772
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
 Execution Time:0.000730991363525
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
 Execution Time:0.000347137451172
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
 Execution Time:0.00128102302551
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000527143478394
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000668048858643
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000576019287109
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000245094299316
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000136137008667
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000385999679565
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00110006332397
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
 Execution Time:0.000710010528564
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
 Execution Time:0.000324964523315
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
 Execution Time:0.00158905982971
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000572919845581
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000643968582153
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000555038452148
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000231981277466
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
 Execution Time:0.000777006149292
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000286817550659
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00569605827332
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000493049621582
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000863075256348
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.00106501579285
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000358104705811
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000201940536499
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
 Execution Time:0.00861692428589
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000503063201904
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000494003295898
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000502824783325
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000834941864014
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.00073504447937
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000383853912354
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000205993652344
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00394916534424
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00117993354797
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
 Execution Time:0.00119495391846
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
 Execution Time:0.000554084777832
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
 Execution Time:0.00167298316956
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000580787658691
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.00553894042969
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000806093215942
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000298023223877
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000174999237061
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.000404834747314
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00112915039062
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
 Execution Time:0.000833034515381
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
 Execution Time:0.000484943389893
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
 Execution Time:0.0127408504486
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000510931015015
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000813007354736
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.0057361125946
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000289916992188
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000166893005371
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
 Execution Time:0.00610899925232
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00033712387085
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00249886512756
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000524044036865
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000473976135254
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.00130701065063
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000787019729614
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000283002853394
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000139951705933
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00033712387085
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=10) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 10 
 Execution Time:0.00127482414246
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
 Execution Time:0.00124096870422
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
 Execution Time:0.000509977340698
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
 Execution Time:0.00161099433899
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00430297851562
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000633001327515
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000563859939575
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
 Execution Time:0.000674962997437
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000253915786743
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000558137893677
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000627040863037
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 34
GROUP BY `u`.`id` 
 Execution Time:0.000656843185425
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 34 
 Execution Time:0.000702142715454
===============================================================================================================

SELECT `cs`.*, `com`.`name` AS `company_name`
FROM `company_settings` `cs`
JOIN `companies` `com` ON `cs`.`company_id`=`com`.`id`
WHERE `cs`.`company_id` =0 
 Execution Time:0.000241041183472
===============================================================================================================

SELECT *
FROM `companies`
WHERE `id` =0 
 Execution Time:0.000178098678589
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
 Execution Time:0.000818967819214
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000271081924438
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '34' 
 Execution Time:0.00115895271301
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00433707237244
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00095009803772
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
 Execution Time:0.000460863113403
===============================================================================================================

SELECT *
FROM `groups` 
 Execution Time:0.000594139099121
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000231027603149
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
 Execution Time:0.00306296348572
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000607967376709
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000247001647949
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS u.id AS user_id, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`active`, `u`.`created_on`, CONCAT(first_name, ' ', last_name) AS full_name, `g`.`description` AS `group_description`, `g`.`id` AS `group_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0
 LIMIT 10 
 Execution Time:0.000935077667236
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.98838043213E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id, company_id FROM user_company UNION SELECT clu.user_id, cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`is_deleted` =0 
 Execution Time:0.0299780368805
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000558853149414
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000439167022705
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00082802772522
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000665903091431
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000263929367065
===============================================================================================================

SELECT `u`.`id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `u`.`gmt_offset`, `u`.`active`, `u`.`avatar`, `u`.`workhours`, `u`.`gps_device_id`, `u`.`hourly_rate`, `u`.`latitude`, `u`.`longitude`, `u`.`is_deleted`, CONCAT(u.first_name, ' ', u.last_name) AS full_name, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `g`.`id` as `group_id`, `com`.`id` AS `company_id`, `com`.`name` AS `company_name`
FROM `users` `u`
LEFT JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
LEFT JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
LEFT JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
LEFT JOIN `companies` `com` ON `uc`.`company_id`=`com`.`id`
WHERE `u`.`id` = 26
GROUP BY `u`.`id` 
 Execution Time:0.0010461807251
===============================================================================================================

SELECT `cl`.`id` as `client_id`, CONCAT(`cl`.`first_name`, '', `cl`.`last_name`) as client_name
FROM `clients` `cl`
JOIN `companies` `com` ON `cl`.`company_id` = `com`.`id`
WHERE `cl`.`company_id` =0
AND `cl`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.0793330669403
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.0189158916473
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000786066055298
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000640153884888
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
 Execution Time:0.000811100006104
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
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000542163848877
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000504970550537
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000746011734009
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
 Execution Time:0.000317096710205
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000458955764771
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00129294395447
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00072193145752
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000524044036865
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000577926635742
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
 Execution Time:0.0298042297363
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000123023986816
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.00036096572876
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000501871109009
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
 Execution Time:0.000598907470703
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00034499168396
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000367164611816
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
 Execution Time:0.000677108764648
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000676870346069
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.0003821849823
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
 Execution Time:0.00106501579285
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.10623168945E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000327110290527
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000824928283691
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00080394744873
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000522136688232
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000567197799683
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.00040078163147
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000548839569092
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00353503227234
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000764131546021
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000355958938599
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000608921051025
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000869989395142
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00423884391785
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000519990921021
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00137281417847
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.0254368782043
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.0309889316559
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.0584089756012
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.0638420581818
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.0300450325012
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000434875488281
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
 Execution Time:0.00104212760925
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000316143035889
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000480890274048
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000661134719849
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000730991363525
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000607013702393
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000274896621704
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 5 
 Execution Time:0.000426054000854
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000622987747192
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
 Execution Time:0.00104689598083
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000616073608398
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 5 
 Execution Time:0.00071907043457
===============================================================================================================

SELECT `q`.`id` as `question_id`, `q`.`form_type_id`, `q`.`form_section_id`, `q`.`description`, `q`.`help_text`, `q`.`type`, `q`.`allowed_types`, `q`.`max_size`, `q`.`table`, `q`.`options`, `q`.`sort_order`, `ft`.`name` AS `form_name`, `fc`.`name` AS `section_name`
FROM `questions` `q`
LEFT JOIN `form_types` `ft` ON `q`.`form_type_id` = `ft`.`id`
LEFT JOIN `form_section` `fc` ON `q`.`form_section_id` = `fc`.`id`
WHERE `q`.`is_deleted` =0
AND `ft`.`is_deleted` =0
AND `q`.`form_type_id` = 5
ORDER BY `q`.`sort_order` ASC 
 Execution Time:0.0146260261536
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000649929046631
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0010130405426
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000607967376709
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000286102294922
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`id` = 5 
 Execution Time:0.000408887863159
===============================================================================================================

SELECT `id` AS `value`, `name` AS `text`
FROM `form_section`
WHERE `is_deleted` =0 
 Execution Time:0.0132968425751
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00315093994141
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00621485710144
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000665903091431
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000347137451172
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.0030460357666
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000492095947266
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00061821937561
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000468015670776
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000367879867554
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000533103942871
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000642061233521
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000736951828003
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
 Execution Time:0.000430822372437
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
 Execution Time:0.00127005577087
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000101089477539
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000366926193237
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00113010406494
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000809907913208
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000762939453125
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000788927078247
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.0011670589447
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
 Execution Time:0.00120997428894
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000334024429321
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000231027603149
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.000200986862183
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000195026397705
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.00032114982605
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.00603604316711
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000435829162598
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
 Execution Time:0.000574111938477
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000359773635864
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00110507011414
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
 Execution Time:0.000671148300171
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000233888626099
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000189065933228
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.00018310546875
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000160932540894
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.00025200843811
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.000175952911377
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000601053237915
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00132298469543
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000647068023682
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000327110290527
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
 Execution Time:0.00106382369995
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.01222229004E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000303030014038
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000501155853271
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00239086151123
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00863599777222
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.00718593597412
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00293493270874
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000671148300171
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00067400932312
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
 Execution Time:0.000366926193237
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
 Execution Time:0.000970840454102
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:9.10758972168E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000301122665405
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
 Execution Time:0.000541925430298
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000665187835693
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000274896621704
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00051212310791
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000195026397705
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.000162124633789
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000147819519043
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.000185012817383
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.000159025192261
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000810146331787
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000848770141602
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000607967376709
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000680923461914
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000402927398682
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000248908996582
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.000432014465332
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000231981277466
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.000265121459961
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.000198125839233
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000480890274048
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000677108764648
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
 Execution Time:0.000364065170288
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000412940979004
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000578880310059
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.000236034393311
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000183820724487
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.000262022018433
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.000296115875244
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000625848770142
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000871896743774
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00061297416687
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000652074813843
===============================================================================================================

SELECT `s`.*, `s`.`code` AS `site_code`, `com`.`name` AS `company_name`, CONCAT(u.first_name, ' ', u.last_name) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`contact_id`, `cc_ct`.`email` AS `contact_email`, `cc_ct`.`first_name` AS `contact_first_name`, `cc_ct`.`last_name` AS `contact_last_name`, `cc_ct`.`address` AS `contact_address`, `cc_ct`.`phone` AS `contact_phone`, `cc_ct`.`mobile` AS `contact_mobile`, `cc_ct`.`fax` AS `contact_fax`, `cc_ct`.`is_default`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM site_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1 AND cc.site_id=12) cc_ct ON `s`.`id` = `cc_ct`.`site_id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`id` = 12 
 Execution Time:0.00110101699829
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
 Execution Time:0.000638008117676
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000533103942871
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000300884246826
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.000157117843628
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000166893005371
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.000211000442505
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.000244140625
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00071907043457
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000776052474976
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000901222229004
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000464200973511
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000577926635742
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000577926635742
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0305080413818
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00103402137756
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000391006469727
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
 Execution Time:0.000958919525146
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:8.01086425781E-5
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `sites` `s`
INNER JOIN `companies` `com` ON `s`.`company_id` = `com`.`id`
LEFT JOIN `users` `u` ON `s`.`created_by` = `u`.`id`
WHERE `s`.`is_deleted` =0
AND `com`.`is_deleted` =0 
 Execution Time:0.000298976898193
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000427961349487
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000626802444458
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000592947006226
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000298976898193
===============================================================================================================

SELECT `ft`.*
FROM `form_types` `ft`
WHERE `ft`.`is_deleted` =0
ORDER BY `ft`.`id` ASC 
 Execution Time:0.000431060791016
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000701904296875
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.00149917602539
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000859022140503
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000432014465332
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000463962554932
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000647068023682
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0032320022583
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
 Execution Time:0.00055193901062
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.00542092323303
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000349998474121
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.000256061553955
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000246047973633
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.000316143035889
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.000294923782349
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.00245189666748
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
 Execution Time:0.000563859939575
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000553846359253
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000287055969238
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000720977783203
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.0059540271759
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.000805139541626
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000334978103638
===============================================================================================================

SELECT SQL_CALC_FOUND_ROWS com.id as company_id, `com`.`name` AS `company_name`, `com`.`address`, `st`.`gmt_offset`, `com`.`created_on`, `com`.`active`, CONCAT(`u`.`first_name`, ' ', `u`.`last_name`) AS created_by_name, CONCAT(`cc_ct`.`first_name`, ' ', `cc_ct`.`last_name`) AS contact_name, `cc_ct`.`email` AS `contact_email`
FROM `companies` `com`
LEFT JOIN `users` `u` ON `com`.`created_by` = `u`.`id`
LEFT JOIN (SELECT cc.*,ct.first_name,ct.last_name,ct.address,ct.email,ct.phone,ct.mobile,ct.fax,ct.created_by,ct.created_on FROM company_contacts AS cc INNER JOIN contacts AS ct ON cc.contact_id=ct.id AND cc.is_default=1) cc_ct ON `com`.`id` = `cc_ct`.`company_id`
LEFT JOIN `company_settings` `st` ON `com`.`id` = `st`.`company_id`
WHERE `com`.`is_deleted` =0
ORDER BY `com`.`name` ASC
 LIMIT 10 
 Execution Time:0.0856831073761
===============================================================================================================

SELECT FOUND_ROWS() AS found_rows 
 Execution Time:0.000162124633789
===============================================================================================================

SELECT COUNT(*) AS `numrows`
FROM `companies` `com`
WHERE `com`.`is_deleted` =0 
 Execution Time:0.000246047973633
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000552177429199
===============================================================================================================

SELECT `u`.`id` AS `user_id`, `u`.`username`, `u`.`email`, `u`.`first_name`, `u`.`last_name`, `u`.`avatar`, `u`.`phone`, `g`.`id` as `group_id`, `u`.`postcode`, `g`.`name` as `group_name`, `g`.`description` as `group_description`, `u`.`gmt_offset`, CONCAT(u.first_name, ' ', u.last_name) AS user_full_name
FROM `users` `u`
INNER JOIN `users_groups` `ug` ON `u`.`id` = `ug`.`user_id`
INNER JOIN `groups` `g` ON `ug`.`group_id` = `g`.`id`
WHERE `u`.`id` = 1
GROUP BY `u`.`id` 
 Execution Time:0.000937938690186
===============================================================================================================

SELECT `uc`.`company_id`
FROM `users` `u`
INNER JOIN (SELECT user_id,company_id FROM user_company UNION SELECT clu.user_id,cu.company_id FROM user_clients clu INNER JOIN clients cu ON clu.client_id = cu.id) uc ON `u`.`id`=`uc`.`user_id`
WHERE `u`.`id` = 1 
 Execution Time:0.00069785118103
===============================================================================================================

SELECT `users_groups`.`group_id` as `id`, `groups`.`name`, `groups`.`description`
FROM `users_groups`
JOIN `groups` ON `users_groups`.`group_id`=`groups`.`id`
WHERE `users_groups`.`user_id` = '1' 
 Execution Time:0.000598192214966
===============================================================================================================

SELECT `id`, `name`
FROM `companies`
WHERE `is_deleted` =0 
 Execution Time:0.000444889068604
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `shelter_types`
WHERE `is_deleted` =0 
 Execution Time:0.000257015228271
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `configurations`
WHERE `is_deleted` =0 
 Execution Time:0.0010290145874
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `panels`
WHERE `is_deleted` =0 
 Execution Time:0.000184059143066
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `ranking`
WHERE `is_deleted` =0 
 Execution Time:0.000260829925537
===============================================================================================================

SELECT `id`, `text`, `value`
FROM `statuses`
WHERE `is_deleted` =0 
 Execution Time:0.000179052352905
===============================================================================================================

SELECT *
FROM `settings` 
 Execution Time:0.000643968582153
===============================================================================================================

