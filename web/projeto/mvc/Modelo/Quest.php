<?php

namespace Modelo;

use Framework\DW3ImagemUpload;
use \PDO;
use \Framework\DW3BancoDeDados;

class Quest extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM usuarios ';
    const INSERIR = 'INSERT INTO quest(titulo, descricao, dificuldade) VALUES (?, ? , ? )';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';

    private $id;
    private $titulo;
    private $descricao;
    private $dificuldade;
    private $usuario;
    private $alternativas;
    private $alternativaCorreta;
    private $img;


    public function __construct(
        $usuario,
        $titulo,
        $descricao,
        $dificuldade,
        $alternativaCorreta,
        $alternativas,
        $id = null
    )
    {
        $this->usuario = $usuario;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->dificuldade = $dificuldade;
        $this->alternativaCorreta = $alternativaCorreta;
        $this->alternativas = $alternativas;
        $this->id = $id;

    }


    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->titulo, PDO::PARAM_STR);
        $comando->bindValue(2, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(3, $this->dificuldade, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }


    public static function buscarPorId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $id, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Quest(
                $registro['titulo'],
                $registro['descricao'],
                $registro['dificuldade'],
                null
            );
            $objeto->id = $registro['id'];
        }


        return $objeto;
    }


    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Quest(
                $registro['titulo'],
                $registro['descricao'],
                $registro['dificuldade'],
                null
            );
        }

        //  var_dump($objetos);
        return $objetos;
    }


    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }


    public function getImagem()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }


    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    protected function verificarErros()
    {


        if (!$this->vereficaTamanhoString($this->titulo, 5)) {
            $this->insereError('titulo');
        }


        if (!$this->vereficaTamanhoString($this->descricao, 5)) {
            $this->insereError('descricao');
        }

        if (!($this->dificuldade === "facil" || $this->dificuldade === "media" || $this->dificuldade === "dificil")) {
            $this->insereError('select');
        }


        $alternativaCorretaQueVaiParaObanco = "";
       // echo "<br><br><b>Bem vindo ao teste de verefica erros debug mode by Ricardo rsrs</b><br>";

        $arrayQueVaiParaBanco = [];
        $contador = 0;
        foreach ($this->alternativas as $letra => $alternativa) {
            if ($this->vereficaTamanhoString($alternativa, 1)) {
                $contador++;

               // echo "<br><b>Possitivo: " . $alternativa . " key -->  " . $letra . " </b>";
                $arrayQueVaiParaBanco[] = $alternativa;
                if ($letra === $this->alternativaCorreta) {
                   // echo "<br><b>A alternativa correta é " . $alternativa . " key -->  " . $letra . " Esta é a altenativa correta " . $this->alternativaCorreta . " </b>";

                    $alternativaCorretaQueVaiParaObanco = $contador;
                    //echo "Alternativa que vai para o banco: " . $alternativaCorretaQueVaiParaObanco;
                }
            } else {
                //echo "<br><b>Negativo: " . $alternativa . "</b>";

            }
        }


        foreach ($arrayQueVaiParaBanco as $letra => $alternativa) {
            echo "<br><b>Teste: " . $alternativa . "</b>";
        }


        if ($contador >= 2) {
            if ($alternativaCorretaQueVaiParaObanco) {
                echo "<h1> Deu boa</h1>";
            } else {
                //echo "<h1> Deu ruim è preciso selecionar a uma das questões preenchida</h1>";
                $this->insereError('alternativasNaoSelecionada');

            }
            echo "<br><br><b>$contador</b><br>";
            echo "<br><br><b>Fim de teste</b><br>";


        }else{
            //echo "<h1> Deu ruim precida de 2 ou mais alternativas</h1>";
            $this->insereError('alternativasMenor2');

        }

    }


    private function vereficaTamanhoString($palavra, $tamanho)
    {
        return strlen($palavra) >= $tamanho;

    }


    public function vereficaValorVetorTeste()
    {

    }

    private function insereError($campo)
    {
        switch ($campo) {
            case "titulo" :
                $this->setErroMensagem('titulo', 'O Titulo deve ter mais que  5 caracteres');
                break;
            case  "sobrenome":
                $this->setErroMensagem('descricao', 'A descrição deve ter mais que  5 caracteres');
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
            case  "senhaDif":
                $this->setErroMensagem('conf', 'As senhas estão diferente!');
                break;
            case  "emailexistente":
                $this->setErroMensagem('email', 'Ops, acho que você já é cadastrado em nosso sistema!');
                break;
        }


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
