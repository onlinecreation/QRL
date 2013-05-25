<?php
/**
 * Config script
 */

/*
 * Database
 */
// Hostname
define('DB_HOSTNAME', '');
// Username
define('DB_USERNAME', '');
// Password
define('DB_PASSWORD', '');
// DB Name
define('DB_NAME', '');
// MySQL Version
define('DB_VERSION', '4');
// Tables prefix
define('DB_PREFIX', 'qrl_');

/*
 * Website settings
 */
// Main url of the website
define('SITE_URL', 'http://bin.wf');
// <title>
define('SITE_TITLE', 'QRL');
// meta name="description"
define('SITE_DESCRIPTION', 'Express URL shortener and 2D QR code generator');
// Title of the website used by the social networks (AddThis)
define('SITE_SOCIAL_NETWORKS_TITLE', '1-click QR code generator and url shortener');
// Description of the website used by the social networks (AddThis)
define('SITE_SOCIAL_NETWORKS_DESCRIPTION', 'In just one click, get a short url and a QRcode of any URL. Transfert any address to your phone, to your friends, on a forum, as quickly as a click !');

/*
 * Administration (/admin)
 */
// Admin's username
define('ADMIN_USERNAME', '');
// Admin's password
define('ADMIN_PASSWORD', '');

/*
 * URL Shortener settings
 */
// Allowed protocols, separed by |
define('URL_PROTOCOLS', 'http|https|ftp|ftps|news|mms|rtmp|rtmpt|sftp|ssh');
// Allowed char code into the generated URL
define('ALLOWED_CHAR_CODE', 'abcdefghjkmnpqrstuvwxyz23456789');
