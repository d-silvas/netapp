<?php
namespace NetApp\DB;

class Connection
{
    /**
     * PDO instance
     * @var type 
     */
    private $pdo;
 
    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
    public function connect() {
        if ($this->pdo == null) {
            try {
                $this->pdo = new \PDO("sqlite:" . \NetApp\DB\Config::PATH_TO_DB_FILE);
            } catch (\PDOException $e) {
                // echo $e->getMessage();
            }
        }
        return $this->pdo;
    }
}