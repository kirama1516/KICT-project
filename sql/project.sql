-- create table sign_database
-- ( Id int unsigned not null auto_increment primary key,
-- Email varchar(50) null,
-- Username varchar(50) null,
-- Password varchar(100),
-- Image varchar(100)
-- );



-- create table customers
-- ( customerid int unsigned not null auto_increment primary key,
-- name char(50) not null,
-- address char(100) not null,
-- city char(30) not null
-- );

-- create table orders
-- ( orderid int unsigned not null auto_increment primary key,
-- customerid int unsigned not null,
-- amount float(6,2),
-- date date not null
-- );

create table product
( modelNum varchar(25) not null primary key,
title varchar(100) null,
item varchar(25) null,  
cpu varchar(25) null, 
gen varchar(25) null,
ram varchar(25) null, 
ssd varchar(25) null, 
touch varchar(25) null, 
graphics varchar(25) null, 
image varchar(100) null,
price float(4,2)
);

-- create table order_items
-- ( orderid int unsigned not null,
-- isbn char(13) not null,
-- quantity tinyint unsigned,
-- primary key (orderid, isbn)
-- );

-- create table product_review
-- (isbn char(13) not null primary key,
-- review text
-- );
