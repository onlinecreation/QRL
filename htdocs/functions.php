<?php
/**
 * Useful functions
 * @todo replace mysql_* by an abstraction object based on PDO
 */

$_ERROR = array();

/**
 * On DB error, end script execution and show an error message
 * @param string $filename
 * @param int $line
 * @param string $message
 */
function db_die($filename, $line, $message) {
    die("File: $filename<br />Line: $line<br />Message: $message");
}

/**
 * Database connection
 */
function db_connect() {
    mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or db_die(__FILE__, __LINE__, mysql_error());
    mysql_select_db(DB_NAME) or db_die(__FILE__, __LINE__, mysql_error());

    if (DB_VERSION > 4) {
        mysql_query("SET NAMES 'utf8'") or db_die(__FILE__, __LINE__, mysql_error());
    }
}

/**
 * Get the last generated code
 * @return int
 */
function get_last_number() {
    $db_result = mysql_query("SELECT last_number FROM " . DB_PREFIX . "settings") or db_die(__FILE__, __LINE__, mysql_error());
    $db_row = mysql_fetch_row($db_result);

    return $db_row[0];
}

/**
 * Increase the last number by 1
 * @return boolean (false in case of an error)
 */
function increase_last_number() {
    mysql_query("UPDATE " . DB_PREFIX . "settings SET last_number = (last_number + 1)") or db_die(__FILE__, __LINE__, mysql_error());

    return (mysql_affected_rows() > 0) ? true : false;
}

/**
 * Does the code exist?
 * @param string $code
 * @return boolean
 */
function code_exists($code) {
    $db_result = mysql_query("SELECT COUNT(id) FROM " . DB_PREFIX . "urls WHERE BINARY code = '$code'") or db_die(__FILE__, __LINE__, mysql_error());
    $db_row = mysql_fetch_row($db_result);

    return ($db_row[0] > 0) ? true : false;
}

/**
 * Does the URL exist?
 * @param string $url
 * @return boolean
 */
function url_exists($url) {
    $db_result = mysql_query("SELECT id, code FROM " . DB_PREFIX . "urls WHERE url LIKE '$url'") or db_die(__FILE__, __LINE__, mysql_error());

    if (mysql_num_rows($db_result) > 0) {
        return mysql_fetch_row($db_result);
    }

    return false;
}

/**
 * Generate the $number-th possible code
 * @param int $number
 * @return string
 */
function generate_code($number) {
    $out = '';
    $codes = ALLOWED_CHAR_CODE;

    while ($number > strlen($codes) - 1) {
        $key = $number % strlen($codes);
        $number = floor($number / strlen($codes)) - 1;
        $out = $codes{$key} . $out;
    }

    return $codes{$number} . $out;
}

/**
 * Save an URL into the database
 * @param string $url the long URL
 * @param string $code the short code
 * @return int Row ID of the insertion
 */
function insert_url($url, $code) {
    mysql_query("INSERT INTO " . DB_PREFIX . "urls (url, code, date_added) VALUES ('$url', '$code', NOW())") or db_die(__FILE__, __LINE__, mysql_error());

    return mysql_insert_id();
}

/**
 * Which long URL corresponds to this code
 * @param string $code
 * @return boolean
 */
function get_url($code) {
    $db_result = mysql_query("SELECT url FROM " . DB_PREFIX . "urls WHERE BINARY code = '$code'") or db_die(__FILE__, __LINE__, mysql_error());

    if (mysql_num_rows($db_result) > 0) {
        $db_row = mysql_fetch_row($db_result);

        return $db_row[0];
    }

    return false;
}

/**
 * What is the hostname of the site?
 * @return string
 */
function get_hostname() {
    $data = parse_url(SITE_URL);

    return $data['host'];
}

/**
 * Write and format shown errors
 * @global array $_ERROR
 */
function print_errors() {
    global $_ERROR;

    if (count($_ERROR) > 0) {
        echo '<ul id="error">';

        foreach ($_ERROR as $value) {
            echo '<li>'. $value .'</li>';
        }

        echo '</ul>';
    }
}

/**
 * Is an admin is logged in?
 * @return boolean
 */
function is_admin_login() {
    if (@$_SESSION['admin'] == 1) {
        return true;
    }

    return false;
}