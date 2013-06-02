<?php
/**
 * Main script
 * @todo replace mysql_* by an abstraction object based on PDO
 */
define('PHURL', true);
$prefix[0] = '';
?>
<?php

require_once 'config.php';
require_once 'functions.php';

db_connect();

// If a URL has been submitted
if (isset($_GET['url'])) {
    $url = mysql_real_escape_string(trim($_GET['url']));

    // Does the url contains an allowed protocol?
    if (!preg_match('/^(' . URL_PROTOCOLS . ')\:/i', $url)) {
        $prefix = explode(':', $url);
        $url = 'http://' . $url;
    }

    // Is the URL valid?
    if (strlen($url) == 0) {
        $_ERROR[] = 'Please enter a URL to shorten.';
    } else if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $_ERROR[] = 'Please enter a valid URL to shorten.';
    } else {
        // Does the visitor try to make an infinite redirection loop?
        $hostname = get_hostname();

        if (preg_match('/('. $hostname.')/i', $url)) {
            $_ERROR[] = 'The URL you have entered is not allowed.';
        }
    }
 
    if (count($_ERROR) == 0) {
        $create = true;

        // If the URL exists, I will not make annother one.
        $url_data = url_exists($url);
        if ($url_data) {
            $create = false;
            $id = $url_data[0];
            $code = $url_data[1];
        }

        // If I have to make one
        if ($create) {
            // Let's create the short code
            do {
                $code = generate_code(get_last_number());

                // If the database reached its maximum code length
                if (!increase_last_number()) {
                    die('System error!');
                }
            } while (code_exists($code));

            $id = insert_url($url, $code);
        }

        // Site URL + '/' + short code = short url
        $short_url = SITE_URL . '/' . $code;

        $_GET['url'] = '';

        require 'html/header.php';
        require 'html/index_done.php';
        require 'html/footer.php';
        exit();
    }
}

require "html/header.php";
require "html/index_form.php";
require "html/footer.php";