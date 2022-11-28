/*borra schema si existeix*/
DROP SCHEMA IF EXISTS elgestordelhort;

CREATE SCHEMA IF NOT EXISTS elgestordelhort DEFAULT CHARACTER SET utf8mb4 ;
USE elgestordelhort ;

/*user*/
DROP USER IF EXISTS 'elgestordelhort'@'%';
CREATE USER 'elgestordelhort'@'%' IDENTIFIED BY '1234';

/*GRANT type_of_permission ON database_name.table_name TO 'username'@'localhost';*/
GRANT ALL PRIVILEGES ON elgestordelhort.* TO 'elgestordelhort'@'%' with grant option;
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'elgestordelhort'@'%';

CREATE TABLE IF NOT EXISTS users(
id          int(255) auto_increment not null,
role        varchar(50),
name        varchar(100),
surname     varchar(200),
email       varchar(255),
password    varchar(255),
created_at  datetime,
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

/*users*/
insert into users values ( null, 'ROLE_USER','Pepeta','Riudecols Fontseca', 'pepeta@gmail.com', '$2y$13$jzNC3lKgoMRaXnvlXs4RZeRirfgG8wR.JzpLSTO13PRluuSxZ9RMi', now());
insert into users values ( null, 'ROLE_USER','Pepet','Botifler Caganous', 'pepet@gmail.com', '$2y$13$IFxQQ.liAbka1kdiMPiah.1gOOKL2YGwnptj6NodUPZoKHinqKOkK', now());

CREATE TABLE IF NOT EXISTS tasks(
id          int(255) auto_increment not null,
user_id     int(255) not null,
title       varchar(255),
content     text,
priority    varchar(20),
hours       int(100),
created_at  datetime,
CONSTRAINT pk_tasks PRIMARY KEY(id),
CONSTRAINT fk_task_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO tasks VALUES(NULL, 1, 'Tasca 1', 'Contingut de prova 1', 'high', 40, now());
INSERT INTO tasks VALUES(NULL, 2, 'Tasca 2', 'Contingut de prova 2', 'low', 20, now());
INSERT INTO tasks VALUES(NULL, 1, 'Tasca 3', 'Contingut de prova 3', 'medium', 10, now());
INSERT INTO tasks VALUES(NULL, 2, 'Tasca 4', 'Contingut de prova 4', 'high', 50, now());