CREATE DATABASE projeto COLLATE 'utf8_unicode_ci';

create table if not exists usuarios
(
    id_usuario int auto_increment,
    nome       varchar(50)  not null,
    sobrenome  varchar(150) not null,
    email      varchar(200) not null,
    senha      varchar(65)  not null,
    primary key (id_usuario)
) ENGINE = InnoDB;


CREATE table if not exists quest
(
    id_quest             int auto_increment,
    id_usuario           int           not null,
    titulo               varchar(255)  NOT NULL,
    descricao            varchar(1000) not null,
    dificuldade          varchar(25)   not null,
    alternativaCorreta   varchar(255)  not null,
    dataCriacao          TIMESTAMP     not null,
    quantidadesDeAcertos int           not null,
    quantidadeDeErros    int           not null,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    PRIMARY KEY (id_quest)
) ENGINE = InnoDB;


CREATE TABLE if not exists alternativas
(
    id_alternativa int auto_increment,
    id_quest       int          not null,
    alternativa    varchar(255) NOT NULL,
    FOREIGN KEY (id_quest) REFERENCES quest (id_quest),
    PRIMARY KEY (id_alternativa)
) ENGINE = InnoDB;



CREATE TABLE if not exists respostas
(
    id_respostas int auto_increment,
    id_usuario   int          not null,
    id_quest     int          not null,
    dataResposta TIMESTAMP    not null,
    acertou      boolean      not null,
    alternativa  varchar(255) not null,
    FOREIGN KEY (id_quest) REFERENCES quest (id_quest),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    PRIMARY KEY (id_respostas)
) ENGINE = InnoDB;
