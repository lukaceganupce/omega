<?php


namespace App;


class Db
{
    protected $conn;

    public function __construct($host, $username, $password, $db_name, $charset)
    {
        $conn = new \mysqli ($host, $username, $password, $db_name);

        if($conn->connect_error) {
            die ("Connection faild: ". $conn->connect_error);
        }

        $conn->set_charset($charset);

        $this->conn = $conn;
    }

    /**
     * @return \mysqli
     */
    public function getConn()
    {
        return $this->conn;
    }



}