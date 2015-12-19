<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Custom Constant
|--------------------------------------------------------------------------
|
|
*/

define('DATE_STRING','%d/%m/%Y %H:%i');

define('DEFAULT_IMAGE','no-profile.jpg');

define('SUCCESS_MESSAGE','success');
define('ERROR_MESSAGE','error');
define('INFO_MESSAGE','info');

define('DOCUMENT_FOLDER','documents/');

define('STATUS_ACCEPTED', 1);
define('STATUS_REJECTED', 2);

define('GROUP_ADMIN', 1);
define('GROUP_MANAGEMENT_COMPANY', 2);
define('GROUP_USER_COMPANY', 3);
define('GROUP_CLIENT_USER', 4);
define('GROUP_STAFF', 8);
define('GROUP_ENGINEER', 9);

define('ARGS_TYPE_STRING', 1);
define('ARGS_TYPE_INT', 2);
define('ARGS_TYPE_ARRAY', 3);
define('ARGS_TYPE_DECIMAL', 4);
define('ARGS_TYPE_TINY_INT', 5);
define('ARGS_TYPE_TRUE_FALSE', 6);
define('ARGS_TYPE_DATE', 7);
define('ARGS_TYPE_DATETIME', 8);

define('FORM_ACTION_ADD', 'ADD');
define('FORM_ACTION_EDIT', 'EDIT');
define('FORM_ACTION_SHOW', 'SHOW');

define('NOTE_TYPE_COMPANY', 1);
define('NOTE_TYPE_SITE', 2);
define('NOTE_TYPE_CLIENT', 3);

define('CONTACT_TYPE_COMPANY', 1);
define('CONTACT_TYPE_SITE', 2);
define('CONTACT_TYPE_CLIENT', 3);

define('DOCUMENT_TYPE_COMPANY', 1);
define('DOCUMENT_TYPE_SITE', 2);

define('SYS_COMPANY_ID', 'comid');
define('SYS_SITE_ID', 'sid');
define('SYS_USER_ID', 'uid');
define('SYS_CONTACT_ID', 'ctid');
define('SYS_NOTE_TYPE_ID', 'ntpid');
define('SYS_NOTE_ID', 'ntid');
define('SYS_CONTACT_TYPE_ID', 'ctpid');
define('SYS_REF_ID', 'refid');
define('SYS_FORM_TYPE_ID', 'ftid');
define('GRID_CTYPE', "grst");
define('SYS_SITE_FORM_ID', 'sfid');
define('SYS_QUESTION_ID', "gid");


/*
 * Button Types
*/
define('BUTTON_TYPE_DEFAULT', 0);
define('BUTTON_TYPE_ANCHOR', 1);

define('ONE_DAY', 60*60*24);
define('MINUTE_IN_SECONDS', 60 );
define('HOUR_IN_SECONDS',   60 * MINUTE_IN_SECONDS );
define('DAY_IN_SECONDS',    24 * HOUR_IN_SECONDS   );
define('WEEK_IN_SECONDS',    7 * DAY_IN_SECONDS    );
define('YEAR_IN_SECONDS',  365 * DAY_IN_SECONDS    );

define('POPOVER_PLACEMENT_LEFT', 'left');
define('POPOVER_PLACEMENT_TOP', 'top');
define('POPOVER_PLACEMENT_BOTTOM', 'bottom');
define('POPOVER_PLACEMENT_RIGHT', 'right');

/*
 * CACHE KEY NAMES
*/
define('CACHE_DRIVER_DEFAULT', 0);
define('CACHE_DRIVER_APC', 1);
define('CACHE_DRIVER_FILE', 2);
define('CACHE_DRIVER_MEMCACHED', 3);
define('CACHE_DRIVER_REDIS', 4);
define('CACHE_DRIVER_WINCACHE', 5);

define('CACHE_KEY_SYS_SETTINGS', '_sys_cfg_');

define('CACHE_KEY_USER_PROFILE', '_sys_up_');

define('CACHE_KEY_COMPANY_DDL_LIST', '_com_ddl_list_');
define('CACHE_KEY_COMPANY_USERS_LIST', '_com_users_list_');
define('CACHE_KEY_COMPANY_INFO', '_com_info_');
define('CACHE_KEY_COMPANY_SETTINGS', '_cfg_');
define('CACHE_KEY_CUSTOM_FIELDS', '_cstfld_');


