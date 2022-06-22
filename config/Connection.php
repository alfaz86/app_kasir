<?php

class Connection
{
    public $connection;

    public function __construct()
    {
       $this->connection = mysqli_connect($_ENV["DB_HOST"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"], $_ENV["DB_DATABASE"]);
       if (mysqli_connect_errno()) mysqli_connect_errno();
    }
}