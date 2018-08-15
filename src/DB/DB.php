<?php
namespace NetApp\DB;

class DB
{
    /**
     * PDO instance
     * @var type 
     */
    private $pdo;
 
    public function __construct() 
    {
        if ($this->pdo == null) {
            try {
                $this->pdo = new \PDO("sqlite:" . \NetApp\DB\Config::PATH_TO_DB_FILE);
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                // echo $e->getMessage();
            }
        }
    }

    public function rebuild () 
    {
        $this->destroyDB();
        $this->createDB();
    }

    private function destroyDB() 
    {
        foreach (array_reverse(\NetApp\DB\Config::DB_BLUEPRINT) as $tableName => $options) {
            $this->pdo->exec("DROP TABLE IF EXISTS " . $tableName);
        }
    }

    private function createDB() 
    {
        foreach (\NetApp\DB\Config::DB_BLUEPRINT as $tableName => $options) {
            $sql = "CREATE TABLE IF NOT EXISTS " . $tableName . " ( ";
            foreach ($options["columns"] as $colName => $colOptions) {
                $sql .= $colName . " " . $colOptions . ", ";
            }
            if ( ! empty($options["foreign_keys"])) {
                foreach ($options["foreign_keys"] as $colName => $foreignCol) {
                    $sql .= "FOREIGN KEY (" . $colName . ") REFERENCES " . $foreignCol;
                    $sql .= " ON UPDATE CASCADE ON DELETE CASCADE, ";
                }
            }
            $sql = rtrim($sql, ", ");
            $sql .= ")";
            $this->pdo->exec($sql);
        }
    }

    public function getTables() 
    {
        return $this->select("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
    }

    public function select($query) 
    {
        $stmt = $this->pdo->query($query);
        $response = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $response[] = $row;
        }
 
        return $response;
    }
}