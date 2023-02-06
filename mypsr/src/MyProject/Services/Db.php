<?php


namespace MyProject\Services;

use MyProject\Exceptions\DbException;
use PDOException;
use PDO;

class Db
{
    private static $instans;

    private $pdo;


    public function __construct()
    {
        try{
            $dbObj = (require __DIR__ . '\..\settings.php')['db'];
            
            $this->pdo = new PDO(
                'mysql:host=' . $dbObj['host'] . ';dbname=' . $dbObj['dbname'],
                $dbObj['user'],
                $dbObj['password']
            );
        }catch(PDOException $e){
            throw new DbException('error conect to data Bade ' . $e->getMessage());
        }
    }


    public static function getInstans()
    {
        if(self::$instans === null){
            self::$instans = new self;
        }
        return self::$instans;
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass')
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if ($result === false){
            return null;
        }

        return $sth->fetchAll(PDO::FETCH_CLASS, $className);
    }
}