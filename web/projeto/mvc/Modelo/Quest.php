<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;


class Quest extends Modelo
{
    const BUSCAR_TODOS =
        'SELECT q.id_quest, q.id_usuario, q.titulo ,q.descricao , q.dificuldade , q.alternativaCorreta, q.dataCriacao,
q.quantidadesDeAcertos, q.quantidadeDeErros, u.id_usuario, u.nome, u.sobrenome, u.email 

FROM quest q  JOIN usuarios u ON (q.id_usuario = u.id_usuario) ORDER BY q.id_quest desc LIMIT ? OFFSET ?
';

    const BUSCAR_TODOS_ID_PAGAINACAO =
        'SELECT q.id_quest, q.id_usuario, q.titulo ,q.descricao , q.dificuldade , q.alternativaCorreta, q.dataCriacao,
q.quantidadesDeAcertos, q.quantidadeDeErros, u.id_usuario, u.nome, u.sobrenome, u.email 

FROM quest q JOIN usuarios u ON (q.id_usuario = u.id_usuario) 

where q.id_usuario != ? ORDER BY q.id_quest desc LIMIT ? OFFSET ?;
';

    const BUSCAR_TODOS_MENOS_O_ID = 'select * from quest where id_usuario and id_usuario not in  ( select id_usuario from respostas where id_usuario = ?) ';
    const ACERTOS = 'select quantidadesDeAcertos from quest where id_quest = ?';
    const ERROS = 'select quantidadeDeErros from quest where id_quest = ?';
    const BUSCAR_TODAS_AS_ALTERNATIVAS_by_id = ' select alternativa from alternativas where id_quest = ?';
    const VERIFICACAO_ALTERNATIVA_QUEST = 'select * from quest where (id_quest = ? AND alternativaCorreta = ? )';

    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT ?';

    const INSERIR_ACERTOS = 'UPDATE quest SET quantidadesDeAcertos = ? WHERE id_quest = ?';
    const INSERIR_ERROS = 'UPDATE quest SET quantidadeDeErros = ? WHERE id_quest = ?';


    const INSERIR = 'INSERT INTO quest(id_usuario, titulo, descricao, dificuldade, alternativaCorreta, dataCriacao ,quantidadesDeAcertos , quantidadeDeErros) VALUES (?, ?, ?, ?, ?, ?, 0 ,0 )';
    const INSERIR_RESPOSTA_USER_BANCO = 'INSERT INTO respostas(id_usuario, id_quest, dataResposta, acertou, alternativa) VALUES (?,?,?,?,?  ) ';
    const INSERIR_ALTERNATIVAS = 'INSERT INTO alternativas(id_quest, alternativa) VALUES ( ?, ?);  ';
    const BUSCA_TODAS_AS_QUESTOES_RESPONDIDAS = 'select a.id_quest,  b.acertou, b.alternativa , b.id_respostas from quest as a inner join respostas as b  on a.id_quest = b.id_quest and(b.id_usuario = ?)';
    const CONTAR_TODOS = 'SELECT count(id_quest) FROM quest';

    const CONTAR_TODOS_BY_ID = 'SELECT count(id_quest) FROM quest where id_usuario != ?';



    private $id;
    private $titulo;
    private $descricao;
    private $dificuldade;
    private $usuario;
    private $usuarioId;
    private $alternativas;
    private $alternativaCorreta;
    private $img;
    private $acertos;
    private $erros;


    public function __construct(
        $usuario,
        $usuarioid,
        $titulo,
        $descricao,
        $dificuldade,
        $alternativaCorreta,
        $alternativas,
        $img,
        $id = null
    )
    {
        $this->usuario = $usuario;
        $this->usuarioId = $usuarioid;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->dificuldade = $dificuldade;
        $this->alternativaCorreta = $alternativaCorreta;
        $this->alternativas = $alternativas;
        $this->img = $img;
        $this->id = $id;

    }

//INSERT INTO quest(idUsuario, titulo, descricao, dificuldade, alternativaCorreta, dataCriacao) VALUES (


    public function inserir()
    {

        $data = date('Y-m-d h:i:s');


        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);


        $comando->bindValue(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->titulo, PDO::PARAM_STR);
        $comando->bindValue(3, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(4, $this->dificuldade, PDO::PARAM_STR);
        $comando->bindValue(5, $this->alternativaCorreta, PDO::PARAM_STR);
        $comando->bindValue(6, $data, PDO::PARAM_STR);

        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();

        foreach ($this->alternativas as $alternativa) {
            DW3BancoDeDados::getPdo()->beginTransaction();
            $comando = DW3BancoDeDados::prepare(self::INSERIR_ALTERNATIVAS);
            $comando->bindValue(1, $this->id, PDO::PARAM_INT);
            $comando->bindValue(2, $alternativa, PDO::PARAM_STR);

            $comando->execute();
            DW3BancoDeDados::getPdo()->commit();

        }

    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function contarTodosId($id)
    {

        $comando = DW3BancoDeDados::prepare(self::CONTAR_TODOS_BY_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $total = $comando->fetch();

        return intval($total[0]);

    }

    public function insereRespostaBanco($idUser, $idQuest, $alternativaUsuario, $acertou)
    {

        $data = date('Y-m-d h:i:s');

        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR_RESPOSTA_USER_BANCO);
        $comando->bindValue(1, $idUser, PDO::PARAM_INT);
        $comando->bindValue(2, $idQuest, PDO::PARAM_INT);
        $comando->bindValue(3, $data, PDO::PARAM_STR);
        $comando->bindValue(4, $acertou);
        $comando->bindValue(5, $alternativaUsuario, PDO::PARAM_STR);
        $comando->execute();
        DW3BancoDeDados::getPdo()->commit();


    }


    public static function validacaoQuest($idQuest, $alternativaUsuario, $idUser)
    {

        $comando = DW3BancoDeDados::prepare(self::VERIFICACAO_ALTERNATIVA_QUEST);
        $comando->bindValue(1, $idQuest, PDO::PARAM_INT);
        $comando->bindValue(2, $alternativaUsuario, PDO::PARAM_STR);
        $comando->execute();

        $data = date('Y-m-d h:i:s');

        $registros = $comando->fetch();

        if ($registros) {
            $quantidadeDeAcertos = ($registros['quantidadesDeAcertos']) + 1;


            DW3BancoDeDados::getPdo()->beginTransaction();
            $comando = DW3BancoDeDados::prepare(self::INSERIR_ACERTOS);
            $comando->bindValue(1, $quantidadeDeAcertos, PDO::PARAM_INT);
            $comando->bindValue(2, $idQuest, PDO::PARAM_INT);
            $comando->execute();
            DW3BancoDeDados::getPdo()->commit();


            DW3BancoDeDados::getPdo()->beginTransaction();
            $comando = DW3BancoDeDados::prepare(self::INSERIR_RESPOSTA_USER_BANCO);
            $comando->bindValue(1, $idUser, PDO::PARAM_INT);
            $comando->bindValue(2, $idQuest, PDO::PARAM_INT);
            $comando->bindValue(3, $data, PDO::PARAM_STR);
            $comando->bindValue(4, true);
            $comando->bindValue(5, $alternativaUsuario, PDO::PARAM_STR);
            $comando->execute();
            DW3BancoDeDados::getPdo()->commit();

            return true;
        } else {

            $quantidadeDeErros = Quest::getQuantidadeErros($idQuest) + 1;


            DW3BancoDeDados::getPdo()->beginTransaction();
            $comando = DW3BancoDeDados::prepare(self::INSERIR_ERROS);
            $comando->bindValue(1, $quantidadeDeErros, PDO::PARAM_INT);
            $comando->bindValue(2, $idQuest, PDO::PARAM_INT);
            $comando->execute();
            DW3BancoDeDados::getPdo()->commit();


            DW3BancoDeDados::getPdo()->beginTransaction();
            $comando = DW3BancoDeDados::prepare(self::INSERIR_RESPOSTA_USER_BANCO);
            $comando->bindValue(1, $idUser, PDO::PARAM_INT);
            $comando->bindValue(2, $idQuest, PDO::PARAM_INT);
            $comando->bindValue(3, $data, PDO::PARAM_STR);
            $comando->bindValue(4, 0);
            $comando->bindValue(5, $alternativaUsuario, PDO::PARAM_STR);
            $comando->execute();
            DW3BancoDeDados::getPdo()->commit();
            return false;
        }

    }


    public static function buscarPorId($limit = 4, $offset = 0, $id)
    {

        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_ID_PAGAINACAO);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->bindValue(2, $limit, PDO::PARAM_INT);
        $comando->bindValue(3, $offset, PDO::PARAM_INT);
        $comando->execute();
        $objetos = [];


        $registros = $comando->fetchAll();


        foreach ($registros as $registro) {
            $usuario = new Usuario(

                $registro['nome'],
                $registro['sobrenome'],
                $registro['email'],
                null,
                null,
                $registro['id_usuario'],
                null

            );

            $objeto = new Quest(
                $usuario,
                $registro['id_usuario'],
                $registro['titulo'],
                $registro['descricao'],
                $registro['dificuldade'],
                $registro['alternativaCorreta'],
                null,
                null,
                $registro['id_quest']

            );


            $objeto->setAcertos($registro['quantidadesDeAcertos']);
            $objeto->setErros($registro['quantidadeDeErros']);

            array_push($objetos, $objeto);
        }

        return $objetos;
    }

    public static function buscarPorIdAlternativas($id)
    {


        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODAS_AS_ALTERNATIVAS_by_id);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();

        $registros = $comando->fetchAll();
        $arrayReturn = [];
        foreach ($registros as $registro) {
            array_push($arrayReturn, $registro['alternativa']);
        }


        return $arrayReturn;
    }

    public static function buscaTodasAsQuestoesRespondidas($id_user)
    {


        $comando = DW3BancoDeDados::prepare(self::BUSCA_TODAS_AS_QUESTOES_RESPONDIDAS);
        $comando->bindValue(1, $id_user, PDO::PARAM_INT);
        $comando->bindValue(2, $id_user, PDO::PARAM_INT);
        $comando->execute();

        $registros = $comando->fetchAll();
        $arrayReturn = [];
        foreach ($registros as $registro) {
        }


    }

    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $objetos = [];


        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();


        foreach ($registros as $registro) {
            $usuario = new Usuario(

                $registro['nome'],
                $registro['sobrenome'],
                $registro['email'],
                null,
                null,
                $registro['id_usuario'],
                null

            );

            $objetos[] = new Quest(
                $usuario,
                $registro['id_usuario'],
                $registro['titulo'],
                $registro['descricao'],
                $registro['dificuldade'],
                $registro['alternativaCorreta'],
                null,
                null,
                $registro['id_quest']

            );
        }

        return $objetos;
    }


    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }


    public function getImagem()
    {
        $img = "$this->id quest.png";
        if (!DW3ImagemUpload::existe($img)) {
            $img = 'padrao.png';
        }


        return $img;
    }


    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->img)) {
            $nomeCompleto = PASTA_PUBLICO . "img/$this->id quest.png";

            DW3ImagemUpload::salvar($this->img, $nomeCompleto);
        }
    }

    protected function verificarErros()
    {

        if (!$this->vereficaTamanhoString($this->titulo, 10, 1000)) {
            $this->insereError('titulo');
        }


        if (!$this->vereficaTamanhoString($this->descricao, 10, 1000)) {
            $this->insereError('descricao');
        }

        if (!($this->dificuldade === "facil" || $this->dificuldade === "media" || $this->dificuldade === "dificil")) {
            $this->insereError('select');
        }


        if (DW3ImagemUpload::existeUpload($this->img)
            && !DW3ImagemUpload::isValida($this->img)) {
            $this->insereError('foto');
        }


        $alternativaCorretaQueVaiParaObanco = "";

        $arrayQueVaiParaBanco = [];
        $contador = 0;

        foreach ($this->alternativas as $letra => $alternativa) {


            if ($this->vereficaTamanhoString($alternativa, 1, 200)) {
                $contador++;


                $arrayQueVaiParaBanco[] = $alternativa;
                if ($letra === $this->alternativaCorreta) {

                    $alternativaCorretaQueVaiParaObanco = $alternativa;
                }
            } else {
                if (!$this->vereficaTamanhoString($alternativa, 0, 0)) {
                    $contador++;

                    $alternativaCorretaQueVaiParaObanco = $contador;
                    $this->insereError('alternativa');
                }
            }
        }

        if ($contador >= 2) {
            if ($alternativaCorretaQueVaiParaObanco) {


                $this->alternativaCorreta = $alternativaCorretaQueVaiParaObanco;
                $this->alternativas = $arrayQueVaiParaBanco;


            } else {
                $this->insereError('alternativasNaoSelecionada');

            }

        } else {
            $this->insereError('alternativasMenor2');

        }

    }


    private function vereficaTamanhoString($palavra, $tamanho, $maximo)
    {
        return strlen($palavra) >= $tamanho && strlen($palavra) <= $maximo;

    }


    public function vereficaValorVetorTeste()
    {

    }

    private function insereError($campo)
    {
        switch ($campo) {
            case "titulo" :
                $this->setErroMensagem('titulo', 'O Titulo deve ter entre 5 e 1000 caracteres');
                break;
            case  "descricao":
                $this->setErroMensagem('descricao', 'A descrição deve ter entre 5 e 1000 caracteres');
                break;
            case  "select":
                $this->setErroMensagem('select', 'Selecione pelo menos uma das opções! (Facil, Mediana, Difícil)');
                break;
            case  "alternativasMenor2":
                $this->setErroMensagem('alternativa', 'Deve se criar duas ou mais alternativas!');
                break;
            case  "alternativasNaoSelecionada":
                $this->setErroMensagem('alternativa', 'Ops, deve se selecionar a altenativa correta para continuar!');
                break;
            case  "alternativa":
                $this->setErroMensagem('alternativa', 'As alternativas devem ter entre 5 e 200 caracteres');
                break;
            case  "foto":
                $this->setErroMensagem('foto', 'Ops, a imagem deve ser de no máximo 500 KB.!');
                break;
        }


    }

    public function getQuantidadeAcertos($id)
    {
        $comando = DW3BancoDeDados::prepare(self::ACERTOS);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registros = $comando->fetch();

        return $registros[0];


    }

    public function getQuantidadeErros($id)
    {
        $comando = DW3BancoDeDados::prepare(self::ERROS);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registros = $comando->fetch();

        return $registros[0];


    }


    public function setAcertos($acertos)
    {
        $this->acertos = $acertos;
    }


    public function setErros($erros)
    {
        $this->erros = $erros;
    }

    public function getNomeUsuario()
    {
        return $this->usuario->getNome();

    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getDificuldade()
    {
        return $this->dificuldade;
    }

    public function getAlternativaCorreta()
    {
        return $this->alternativaCorreta;
    }

    public function getAlternativas()
    {
        return $this->alternativas;
    }

}
