use projeto;

select * from quest;
 
 drop table quest;
  drop table alternativas;
  drop table respostas;
 
 CREATE TABLE quest (
    id_quest int auto_increment,
    id_usuario int not null,
    titulo varchar(255) NOT NULL,
    descricao varchar(500) not null,
    dificuldade varchar(25) not null,
    alternativaCorreta varchar(255) not null,
    dataCriacao TIMESTAMP not null,
    quantidadesDeAcertos int not null ,
    quantidadeDeErros int  not null ,
	FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    PRIMARY KEY (id_quest)
);



 
 CREATE TABLE alternativas (
    id_alternativa int auto_increment,
    id_quest int not null,
    alternativa varchar(255) NOT NULL,
	FOREIGN KEY (id_quest) REFERENCES quest(id_quest),
    PRIMARY KEY (id_alternativa)
);


CREATE TABLE respostas (
    id_respostas int auto_increment,
    id_usuario int not null,
    id_quest int not null,
    dataResposta TIMESTAMP not null,
    acertou boolean  not null,
    alternativa varchar(255) not null,
	FOREIGN KEY (id_quest) REFERENCES quest(id_quest),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    PRIMARY KEY (id_respostas)
);

INSERT INTO quest(id_usuario, titulo, descricao, dificuldade, alternativaCorreta, dataCriacao) VALUES (
					1,      'titulo','descricao	','dificuldade',      1,  '2019-06-23 08:34:40'  );
                    
   INSERT INTO respostas(id_usuario, id_quest, dataResposta, acertou, alternativa) VALUES (
					1,      1, '2019-06-23 08:34:40',true,  'alternativa coreetA'  );                 

INSERT INTO alternativas(id_quest, alternativa) VALUES (1,'alternativa aaaa');

                    
                    select * from respostas;
select * from alternativas where id_quest = 11 ;
commit;
select * from quest where ( id_quest != (
select a.id_quest from quest as a inner join respostas as b  on a.id_quest = b.id_quest and(b.id_usuario = 1)));

SELECT * FROM quest Where id_usuario not in (id_quest != (
select a.id_quest from quest as a inner join respostas as b  on a.id_quest = b.id_quest and (b.id_usuario = 1)))


SELECT	* FROM	quest WHERE	id_usuario not in (select a.id_quest from quest as a inner join respostas as b  on a.id_quest = b.id_quest and !(a.id_usuario = 1))


select * from respostas where id_usuario != 1;

select * from quest where id_usuario not in  ( select id_usuario from respostas where id_usuario != 1)
