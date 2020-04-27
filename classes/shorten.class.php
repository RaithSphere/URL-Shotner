<?php

namespace shortner;

/**
 * Class short
 * @package shortner
 */
class short
{
    public string $db_host;
    public string $username;
    public string $password;
    public string $database;
    public string $table;

    /**
     * @param $host
     * @param $username
     * @param $password
     * @param $database
     * @param $table
     */
    function InitDB($host, $username, $password, $database, $table)
    {
        $this->db_host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->table    = $table;
    }
}