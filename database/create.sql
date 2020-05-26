create table Author(
AuthorID integer primary key auto_increment,
username varchar(32) unique,
password varchar(32)
);

create table Category(
CategoryID integer primary key auto_increment,
name varchar(16) unique
);

create table Article (
ArticleID integer primary key auto_increment,
date date,
title varchar(128),
text varchar(2048),
AuthorID integer references Author(AuthorID),
CategoryID integer references Category(CategoryID)
);
's ok'