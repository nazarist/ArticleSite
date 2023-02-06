<?php

namespace MyProject\Models;

use MyProject\Exceptions\NotRegisterException;
use MyProject\Services\Db;
use ReflectionObject;

abstract class ActiverecordEntity // активний запис сутності
{
    protected $id;


    public function getId()
    {
        return $this->id;
    }


    private function underscoreToCamelCase($word): string
    {
        return lcfirst(str_replace( '_', '', ucwords($word, '_')));
    }


    private function camelCaseToUnderscore($word): string
    {
        return strtolower(preg_replace('~(?<!^)[A-Z]~', '_$0', $word));//(?<!^) = не має бути перший символ
    }


    private function mappedPropertiesToDbFormat(): array
    {
        $reflection = new ReflectionObject($this);
        $properties = $reflection->getProperties();

        $mappedProperties = [];
        foreach($properties as $property)
        {
            $propertyName = $property->getName();
            $dbFormatName = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$dbFormatName] = $this->$propertyName;
        }
        return $mappedProperties;
    }

    private function insert($mappedProperties)
    {
        $mappedProperties = array_filter($mappedProperties);
        $columns = [];
        $arrayValueIndex = [];
        $paramToValues = [];
        $index = 1;
        foreach($mappedProperties as $dbName => $value){
            $columns[] = $dbName;
            $valueIndex = ':values' . $index;
            $arrayValueIndex[] = $valueIndex; 
            $paramToValues[$valueIndex] = $value;
            $index++;
        }
        var_dump($columns);
        var_dump($mappedProperties);
        var_dump($paramToValues);
        $sql = 'INSERT INTO `' . static::getTableName() . '` (' . implode(', ', $columns) . ') VALUE (' . implode(', ', $arrayValueIndex) . ');';

        $db = Db::getInstans();
        $db->query($sql, $paramToValues, static::class);
    }


    public function save()
    {
        if($this->id === null){
            $this->insert($this->mappedPropertiesToDbFormat());
        }
    }
    
    
    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }


    public static function getById($id): ?static
    {
        $db = Db::getInstans();

        $result = $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id',
            ['id' => $id],
            static::class
        );

        return $result ? $result[0] : null;
    }

    public static function findAll()
    {
        $db = Db::getInstans();

        $result = $db->query(
            'SELECT * FROM ' . static::getTableName() . ';',
            [],
            static::class
        );

        return $result;
    }
    

    public static function findByOneColumn($column, $value){
        $result = Db::getInstans()->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE ' . $column . ' = :value;',
            ['value' => $value],
            static::class
        );
        
        return $result ? $result[0] :null;
    }


    public static function checkLenght(string $value, $min, $max): bool{
        if(mb_strlen($value) < $min || mb_strlen($value) > $max){
            return false;
        }
        return true;
    }


    public static function cleaningString(string $value): string{
        $value = trim($value);// delete spases at the begining and at the end
        $value = stripslashes($value);// delete shielded(екрановані) sumbols
        $value = strip_tags($value);//funcsion for delete HTML and PHP tags for security
        $value = htmlspecialchars($value);//transform HTML tags to special-entity('&' transform to '& amp;')
        return $value;
    }


    public static function checkCookie(){
        if(!empty($_COOKIE['authToken'])){
            $user = static::findByOneColumn('auth_token', $_COOKIE['authToken']);
            if($user === null){
                throw new NotRegisterException('you are not register');
                return;
            }elseif($user){
                return $user;
            }
        }
        throw new NotRegisterException('you are not register');
    }


    public static function resetCookie(){
        foreach($_COOKIE as $cooki => $value){
            setcookie($cooki, '');
        }
    }

    
    abstract protected static function getTableName();
}