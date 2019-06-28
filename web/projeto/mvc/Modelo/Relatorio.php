<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;


class Relatorio extends Modelo
{


    const  BUSCAR_MAIS_ACERTO = 'SELECT * FROM (select * from quest where dificuldade = ?  order by quantidadesDeAcertos desc )DATAIN LIMIT 1; ';
    const  BUSCAR_MAIS_ERRO = 'SELECT * FROM (select * from quest where dificuldade = ?  order by quantidadeDeErros desc )DATAIN LIMIT 1;';


    public static function filtroCategoria($categoria = [])
    {

        if (!(isset($categoria['select']))) {
            $categoria = ['select' => 'facil'];
        }

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_MAIS_ACERTO);
        $comando->bindValue(1, $categoria['select'], PDO::PARAM_STR);
        $comando->execute();

        $registro = $comando->fetch();


        $acertos = new Quest(

            $registro['id_usuario'],
            $registro['id_usuario'],
            $registro['titulo'],
            $registro['descricao'],
            $registro['dificuldade'],
            $registro['alternativaCorreta'],
            null,
            null,
            $registro['id_quest']
        );


        $comando = DW3BancoDeDados::prepare(self::BUSCAR_MAIS_ERRO);
        $comando->bindValue(1, $categoria['select'], PDO::PARAM_STR);
        $comando->execute();
        $registro = $comando->fetch();

        $erros = new Quest(

            $registro['id_usuario'],
            $registro['id_usuario'],
            $registro['titulo'],
            $registro['descricao'],
            $registro['dificuldade'],
            $registro['alternativaCorreta'],
            null,
            null,
            $registro['id_quest']
        );


        $objetos = [
            'acertos' => $erros,
            'erros' => $acertos
        ];

        return $objetos;
    }


}
