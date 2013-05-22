<?php
if( !defined('PHURL' ) ) {
    header('HTTP/1.0 404 Not Found');
    exit();
}
?>
<a href="<?php echo SITE_URL ?>" ><h1><?php echo SITE_TITLE ?></h1></a>
<?php print_errors(); ?>
<form method="get" action="index.php">
    <label for="url">
        URL to reduce:
    </label>
    <input id="url" type="url" name="url" value="http://" required />
    <input type="submit" value="OK" />
</form>