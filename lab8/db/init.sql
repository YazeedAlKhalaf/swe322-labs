CREATE DATABASE IF NOT EXISTS lab8;
USE lab8;

CREATE TABLE customer (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) NOT NULL,
  address varchar(100) NOT NULL,
  salary decimal(10,0) NOT NUll,
  PRIMARY KEY (id)
);