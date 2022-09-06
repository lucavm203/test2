<?php
    // require_once('secure/settings.php');
    // require_once('secure/config.php');
    // require_once('view/functions.php');
    // echo $baseDir;
    // showHeader($baseDir);
    require_once(__DIR__ . '/../page/header.php');
    echo "<p>Categories view</p>";
    echo "<p>All categories:</p>";
    foreach($categories as $category)
    {
        echo "<div>$category</div>"; // __toString magic method
    }
    require_once(__DIR__ . '/../page/error.php');
    require_once(__DIR__ . '/../page/menu.php');
    require_once(__DIR__ . '/../page/footer.php');