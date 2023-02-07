----------------------------------------------------------------------
CREATE TABLE `product`(
	`prod_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `prod_name` VARCHAR(255) NOT NULL,
    `prod_cost` FLOAT(10, 2) NOT NULL,
    `prod_price` FLOAT(10, 2) NOT NULL,
    `prod_group` INT(11) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `product_groups`(
	`gr_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `gr_name` VARCHAR(255) NOT NULL,
    `gr_temp` FLOAT(3, 1) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE `order`(
	`ord_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `ord_datetime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ord_prod` INT(11) NOT NULL
)ENGINE=INNODB DEFAULT CHARSET=utf8;

----------------------------------------------------------------------

INSERT INTO `product_groups` (`gr_name`, `gr_temp`) 
VALUES ('vegetables', 12.3),
('fruits', 9.1);

INSERT INTO `product` (`prod_name`, `prod_cost`, `prod_price`, `prod_group`) 
VALUES ('pepper', 70.32, 89.99, 1), 
('carrot', 4.89, 9.99, 1),
('tomato', 7.32, 12.49, 1),
('corn', 29.44, 38.90, 1),
('onion', 2.12, 5.22, 1),
('green onion', 66.73, 80.99, 1),
('mushroom', 46.40, 55.19, 1),
('potato', 20.43, 25.65, 1)

INSERT INTO `product` (`prod_name`, `prod_cost`, `prod_price`, `prod_group`) 
VALUES ('banana', 20.32, 25.59, 2), 
('aple', 18.89, 23.10, 2),
('pienaple', 7.32, 12.49, 2),
('orange', 19.44, 28.90, 2),
('mango', 60.12, 75.22, 2),
('kivi', 66.73, 80.99, 2),
('lime', 46.40, 55.19, 2),
('coconut', 20.43, 25.65, 2)

------------------------------------------------------------------

