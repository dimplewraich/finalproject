<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
| http://example.com/
|
| If this is not set then CodeIgniter will try guess the protocol, domain
| and path to your installation. However, you should always configure this
| explicitly and never rely on auto-guessing, especially in production
| environments.
|
*/
$config['base_url'] = 'http://'.$_SERVER["HTTP_HOST"].'/clients/jaspinder/';
$config['cdn_url']	= 'http://'.$_SERVER["HTTP_HOST"].'/clients/jaspinder/';
$config['s3_upload_allowed']	= FALSE;
$config['s3_bucket']	= '';

/* $config['base_url'] = 'http://'.$_SERVER["HTTP_HOST"].'/jaspinder/';
$config['cdn_url']	= 'http://'.$_SERVER["HTTP_HOST"].'/jaspinder/';
$config['s3_upload_allowed']	= FALSE;
$config['s3_bucket']	= ''; */