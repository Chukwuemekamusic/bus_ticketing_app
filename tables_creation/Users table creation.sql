CREATE DATABASE BusApp;

USE BusApp;

CREATE TABLE users (
uid int(11) AUTO_INCREMENT PRIMARY KEY,
first_name varchar(20) NOT NULL,
last_name varchar(20) NOT NULL,
phone_number varchar(30) NOT NULL,
email varchar(30) NOT NULL,
username varchar(15) NOT NULL,
auth varchar(30) NOT NULL
);