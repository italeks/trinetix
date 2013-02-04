<?php 

/**
 * sublime-text2: set identation by spaces and tabwidth =4
 * 
 * PHP version 5
 * 
 * @category   PHP
 * @package    Trinetix_Test
 * @subpackage Core
 * @author     Oleksii Dmytrenko <xdm@ukr.net>
 * @license    GNU General Public License version 2 or later; see LICENSE
 * @link       google.com
 */



/**
 * Database connector class.
 *
 */
abstract class DbConnector
{
    public $connection;
    protected $dbHost;
    protected $dbPort;
    protected $dbName;
    protected $dbUser;
    protected $dbPass;


    public function __construct()
    {
        $this->dbHost = DB_HOST ?: 'localhost' ;
        $this->dbPort = DB_PORT ?: '3306' ;
        $this->dbName = DB_NAME;
        $this->dbUser = DB_USER;
        $this->dbPass = DB_PASS;
    }

    abstract public function connect() ;

    public function getConnection()
    {
        return $this->connection ;
    }

}

/**
 * Mysql Database connector class.
 */
class MysqlConnector extends DbConnector
{

    public function connect()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . $this->dbHost . '; port=' . $this->dbPort . ' dbname=' . $this->dbName,
                $this->dbUser, $this->dbPass
            );

            $this->connection->exec("SET CHARACTER SET " . DB_CHARSET);
            $this->connection->exec("USE " . $this->dbName);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die() ;
        }
        return true;
    }
}


/**
 * Database class.
 */
 
class DataProvider
{
    static $cursor;

    private function __construct(){}

    public static function getCursor(DbConnector $connector)
    {
        if ( ! self::$cursor) {
            $connector->connect();
            self::$cursor = $connector->connection;
        }

        return self::$cursor;
    }
}
