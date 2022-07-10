<?php

class DBControl
{

    private $settings;

    static private $dbh;
    static private $error;

    private $stmt;

    private function __construct()
    {

        $dsn = "mysql:host=mysql;dbname=sampleDb;charset=utf8";

        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );

        try {

            self::$dbh = new PDO($dsn, 'userdb', 'secret', $options);
        } catch (PDOException $e) {
            self::$error = $e->getMessage();
            echo $e->getMessage();
            die('<h1>Sorry. The Database connection is temporarily unavailable.</h1>');
        }
    }


    static public function getConnection()
    {

        if (!self::$dbh) { // No PDO exists yet, so make one and send it back.
            new DBControl();
        }

        return self::$dbh;
    } // end function getConnection
}
