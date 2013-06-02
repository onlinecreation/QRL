<?php
/**
 * QR code generator limited to the URL of the website
 */

include './phpqrcode.php';
include 'config.php';

if (strpos($_GET['code'], SITE_URL) === 0 && strpos($_SERVER['HTTP_REFERER'], SITE_URL) === 0) {
    QRcode::png($_GET['code']);
} else {
    header('HTTP/1.0 404 Not Found');
    exit();
}
?>