SET GLOBAL validate_password_policy=LOW;


create user 'ricardo'@'localhost' identified by 'ricardo123';
create user 'phpmyadmin'@'localhost' identified by 'roliveira';
create database teste ;


GRANT ALL PRIVILEGES ON * . * TO 'ricardo'@'localhost' ;
GRANT ALL PRIVILEGES ON * . * TO 'root'@'localhost' ;
GRANT ALL PRIVILEGES ON * . * TO 'phpmyadmin'@'localhost';

show databases;

SELECT User, Host FROM mysql.user;
SELECT User FROM mysql.user;

use phpmyadmin;

update user set password=PASSWORD('roliveira') where User='phpmyadmin';

UPDATE user SET password=PASSWORD('roliveira96') WHERE User='root'; 
FLUSH PRIVILEGES;

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'roliveira';
ALTER USER 'root'@'localhost' IDENTIFIED BY 'roliveira';

ALTER USER 'phpmyadmin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'roliveira';
ALTER USER 'phpmyadmin'@'localhost' IDENTIFIED BY 'roliveira';



SELECT MAX(version) FROM `phpmyadmin`.`pma__tracking` WHERE `db_name` = 'phpmyadmin'  AND `table_name` = ''  AND FIND_IN_SET('CREATE DATABASE',tracking) > 0



show global variables like 'validate_password%';



use mysql; 
select * from user;

