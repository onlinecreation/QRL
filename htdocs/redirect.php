<?php
require_once("config.php");
require_once("functions.php");

db_connect();

$alias = strtolower(trim(mysql_real_escape_string($_GET['alias'])));

if (!preg_match("/^[a-zA-Z0-9_-]+$/", $alias)) {
  header("Location: ".SITE_URL, true, 301);
  exit();
}

if (($url = get_url($alias))) {
    header("Location: $url", true, 301);
    exit();
}

header("Location: ".SITE_URL, true, 301);
