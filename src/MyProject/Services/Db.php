<?php
    namespace MyProject\Services;

    //use PDO;

    class Db{
        private $pdo;

        private static $instance;

        private function __construct(){
            $dbOptions = (require __DIR__."/../../settings.php")['db'];
            
            $this->pdo = new \PDO(
                'mysql:host=' .$dbOptions['host'] . ';dbname='.$dbOptions['dbname'], 
                $dbOptions['user'], $dbOptions['password']
            );
            $this->pdo->exec("SET NAMES UTF8");
        }

        public function query(string $sql, $params = [], $className = 'stdClass'): ?array {
            $sth = $this->pdo->prepare($sql);
            $result = $sth -> execute($params);
            if (false === $result){
                return Null;
            }
            
            return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
        }

        public static function getInstance():self{
            if (self::$instance === null){
                self::$instance = new self();
            }
            return self::$instance;
        }
    }

    
?>