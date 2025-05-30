<?php

    define("HOST", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "trsdb");

    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);

    if(!$conn){
        include_once 'errors\error_500.php';
    }

?>