<?php 
    //Start Session
    session_start();

    //Tekrar Etmeyen Değerleri Depolama için Constant oluşturma
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //veritabanı bağlantısı
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting veritabanı

?>