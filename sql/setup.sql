drop database if exists library;

create database library;

use library;

create table books (id int auto_increment primary key, name varchar(255), author varchar(255));

insert into books (name, author) values ("Alicia en el pais de las maravillas", "Yo");
