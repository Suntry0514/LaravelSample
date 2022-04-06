create database laravelapp;

create table laravelapp.people(
    id int auto_increment not null primary key,
    name TEXT not null,
    mail TEXT,
    age int
);

INSERT INTO `people` VALUES (1,'taro','taro@yamada.jp',35);
INSERT INTO `people` VALUES (2,'hanako','hanako@flower.com',24);
INSERT INTO `people` VALUES (3,'sachiko','sachi@happy.org',47);
