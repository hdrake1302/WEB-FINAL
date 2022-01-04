<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'quanlytask');
define('URL', "http://localhost/WEB-FINAL/Source/mvc/");
define('SUPPORTED_EXTENSIONS', array(
    "jpg", "png", "docx", "pdf"
));

class DB
{
    private static $conn;
    public static function getConnection()
    {
        if (self::$conn == null) {
            self::$conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB, USER, PASS);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
}
