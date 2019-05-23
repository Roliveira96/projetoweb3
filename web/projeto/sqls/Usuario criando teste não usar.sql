create database projeto collate 'utf8_unicode_ci' ;



drop database projeto;
drop table usuario;


use projeto;


create table if not exists usuario(
id_usuario int auto_increment,
nome varchar(50) not null,
sobrenome varchar(150) not null,
email varchar(200) not null,
senha varchar(20) not null,
primary key (id_usuario)
);

insert into usuario(nome,sobrenome,email,senha)
values
('Ricardo','Martins de Oliveira','ricardo.de.oliveira96@gmail.com','12345');


select * from usuario;mo