<?php
ini_set('display_errors', 0);
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Phurl Administration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/css/default.css" />
        <link rel="stylesheet" type="text/css" href="/css/admin.css" />
    </head>
    <body>
        <?php if (is_admin_login()): ?>
            <h1>QRL</h1>
            Administration
            <hr />
            <h2>Search</h2>
            <form method="get" action="index.php">
                <table id="admin_search">
                    <tr>
                        <td><strong>By code:</strong></td>
                        <td><input type="text" name="search_alias" size="30" value="<?php echo @htmlentities($_GET['search_alias']) ?>" /></td>
                    </tr>
                    <tr>
                        <td><strong>By part of URL string:</strong></td>
                        <td><input type="text" name="search_url" size="30" value="<?php echo @htmlentities($_GET['search_url']) ?>" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Search" /></td>
                    </tr>
                </table>
            </form>
            <hr />
        <?php endif; ?>