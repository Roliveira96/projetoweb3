CREATE DATABASE ex2 COLLATE 'utf8_unicode_ci';

CREATE TABLE pedidos (
    id INT NOT NULL AUTO_INCREMENT ,
    mesa INT NOT NULL ,
    quantidade INT NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;
