<?php
    define('DB_HOST','localhost');
    define('DB_USER','root');
    define('DB_PASS','root');
    define('DB_BASE','IHRM_Database');

    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE) or die("Cannot connect Server");
?>