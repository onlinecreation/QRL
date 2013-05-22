<?php
if( !defined('PHURL' ) ) {
    header('HTTP/1.0 404 Not Found');
    exit();
}
ini_set('display_errors', 0);
?>
<img src="qrcode.php?code=<?php echo htmlentities($short_url) ?>" alt="QRcode" id="qrcode"/>
<a href="<?php echo htmlentities($short_url) ?>" target="_blank">
    <h1><?php echo str_replace("http://","",htmlentities($short_url,ENT_QUOTES,"UTF-8")); ?></h1>
</a>
<?php echo strlen($short_url); ?> characters
<div style="clear:both;"></div>
<?php print_errors(); ?>
<form method="get" action="index.php">
    <label for="url">
        URL to reduce:
    </label>
    <input id="url" type="url" name="url" value="http://" required />
    <input type="submit" value="OK" />
</form>
