<?php
/**
 * Redirect page
 * @todo replace mysql_* by an abstraction object based on PDO
 */
require_once "config.php";
require_once "functions.php";

db_connect();

$alias = strtolower(trim(mysql_real_escape_string($_GET['alias'])));

// Unvalid code
if (!preg_match("/^[a-zA-Z0-9_-]+$/", $alias)) {
    header("Location: " . SITE_URL, true, 301);
    exit();
}

// Knowed code?
if (($url = get_url($alias))) {
    header("Location: $url", true, 301);
    exit();
}

// If something go wrong, the visitor is send to the main page
header("Location: " . SITE_URL, true, 301);
