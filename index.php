<?php
define('PHURL', true);
ini_set('display_errors', 0);
$prefix[0] = '';
?>
<?php
require_once("config.php");
require_once("functions.php");

db_connect();

if (count($_GET) > 0) {
    $url   = mysql_real_escape_string(trim($_GET['url']));

    if (!preg_match("/^(".URL_PROTOCOLS.")\:/i", $url)) {
        $prefix = explode(":", $url);
        $url = "http://".$url;
    }

    if (strlen($url) == 0) {
        $_ERROR[] = "Please enter a URL to shorten.";
    }else if (!filter_var($url,FILTER_VALIDATE_URL)) {
        $_ERROR[] = "Please enter a valid URL to shorten.";
    }else {
        $hostname = get_hostname();

        if (preg_match("/($hostname)/i", $url)) {
            $_ERROR[] = "The URL you have entered is not allowed.";
        }
    }

    if (count($_ERROR) == 0) {
        $create = true;

        if (($url_data = url_exists($url))) {
            $create    = false;
            $id        = $url_data[0];
            $code      = $url_data[1];
        }

        if ($create) {
            do {
                $code = generate_code(get_last_number());

                if (!increase_last_number()) {
                    die("System error!");
                }

                if (code_exists($code)) {
                    continue;
                }

                break;
            } while (1);

            $id = insert_url($url, $code);
        }

        $short_url = SITE_URL."/".$code;

        $_GET['url']   = "";

        require_once("html/header.php");
        require_once("html/index_done.php");
        require_once("html/footer.php");
        exit();
    }
}

require_once("html/header.php");
require_once("html/index_form.php");
require_once("html/footer.php");