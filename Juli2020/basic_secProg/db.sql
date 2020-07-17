CREATE DATABASE web_db;
CREATE TABLE credentials(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    passwd varchar(255) NOT NULL
);
