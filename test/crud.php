<?php


function query(string $sql, array $param = []){
    $host = 'localhost';
    $dbname = 'task';
    $user = 'root';
    $pass = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    $sth = $pdo->prepare($sql);
    $sth->execute($param);
    return $sth->fetchAll();
}


function selectProdAndPr_gr(array $param = [], string $filter = ''){
    $sql = "SELECT * FROM `product` AS `prod` INNER JOIN `product_groups` AS `pr_gr` ON prod.prod_group = pr_gr.gr_id $filter;" ;

    return query($sql, $param);
}


function selectOrderAndProd(array $param = [], string $filter = ''){
    $sql = "SELECT * from `order` AS `ord` INNER JOIN `product` ON ord.ord_prod = product.prod_id 
    INNER JOIN `product_groups` ON product.prod_group = product_groups.gr_id;
    ELECT * from `order` AS `ord` INNER JOIN `product` ON ord.ord_prod = product.prod_id $filter";

    return query($sql, $param);
}


function delete(array $param, string $tableName, string $filter){
    $sql = "DELETE FROM `$tableName` $filter";

    return query($sql, $param);
}


function update(array $param, array $data,){

    $index = 1;
    $columnsToParam = [];
    foreach ($data as $key => $value){
        $valueIndex = ':value' . $index;
        $columnsToParam[] = "$key = $valueIndex";
        $param[$valueIndex] = $value;
        $index++;
    }
    $sql = "UPDATE `product` SET ". implode(', ', $columnsToParam)  ." WHERE prod_id = :id";

    return query($sql, $param);
}



function create(string  $tableName, $data, $param = []){
    $index = 1;
    $columnsByParam = [];
    $columns = [];
    foreach ($data as $key => $value){
        $valueIndex = ':value' . $index;
        $columns[] = $key; 
        $columnsByParam[] = $valueIndex;
        $param[$valueIndex] = $value;
        $index++;
    }

    $sql = "INSERT INTO `$tableName` ( " . implode(', ', $columns) . ') VALUES (' . implode(', ', $columnsByParam) . ');';
    return query($sql, $param);
}