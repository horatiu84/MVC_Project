<?php

/**
 * Class that will do the connection with the database
 */
class Product
{
    /**
     * Method that will get the data from the database
     * @return array associative  that will contain data about products
     */
    public function getData():array
    {

        $db_host='localhost';
        $db_name='product_db';
        $user ='root';
        $password = '';

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
        $pdo = new PDO($dsn,$user,$password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $stmt = $pdo->query("SELECT * FROM product");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}