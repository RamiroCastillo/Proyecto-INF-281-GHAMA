<?php

/**
 * Class Database
 */
class Database
{
    /**
     * Credentials to access the MySQL database
     * @var
     */
    private $_connection;
    private $_host = '127.0.0.1';
    private $_username = 'root';
    private $_password = '';
    private $_database = 'bdghama';

    /*private $_connection;
    private $_host = 'sql9.freemysqlhosting.net';
    private $_username = 'sql9232347';
    private $_password = 'cX8fQNhgqw';
    private $_database = 'sql9232347'; //el name es el nombre de la base de datos*/
    /**
     * Variable to be used for MySQL connections
     * @var
     */
    private static $_instance;

    /**
     * Get an instance of the Database
     * @return Database
     */
    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Database constructor.
     */
    private function __construct()
    {
        $this->_connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

        if (mysqli_connect_error()) {
            trigger_error("Failed to conenc to to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }

    /**
     * Get mysqli connection
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->_connection;
    }
}
