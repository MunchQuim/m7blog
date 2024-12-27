create database myBlog;
use myBlog;
drop table if exists `users`;
create table `users`(
id int NOT NULL auto_increment,
username varchar(45) NOT NULL,
password varchar (255) NOT NULL,
email varchar (45) NOT NULL unique,
role enum('admin','user') NOT NULL,
constraint Pk_user primary KEY (id)
);

drop table if exists `posts`;
create table `posts`(
id int not null auto_increment,
message varchar(
);