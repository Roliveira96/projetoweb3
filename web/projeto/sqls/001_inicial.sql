create database projeto collate 'utf8_unicode_ci' ;

create table if not exists usuario(
id_usuario int auto_increment,
nome varchar(50) not null,
sobrenome varchar(150) not null,
email varchar(200) not null,
senha varchar(20) not null,
primary key (id_usuario)
)
ENGINE = InnoDB;


