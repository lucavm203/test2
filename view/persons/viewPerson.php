<?php
    // require_once('secure/settings.php');
    // require_once('secure/config.php');
    // require_once('view/functions.php');
    // echo $baseDir;
    // showHeader($baseDir);
    require_once(__DIR__ . '/../page/header.php');
    echo "<p>Person view</p>";
    echo "<p>Person with id $id</p>";
    echo "<div>$person</div>";
    require_once(__DIR__ . '/../page/error.php');
    require_once(__DIR__ . '/../page/menu.php');
    require_once(__DIR__ . '/../page/footer.php');