<?php

namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;


class TesteUsuario extends Teste
{

    public function testeInserir()
    {
        $usuario = new Usuario('Ricardo', 'Martins', 'ricardo@gamilc.com', '123456789', '123456789', null, null);
        $usuario->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios');
        $baseUsuario = $query->fetch();
        $this->verificar($baseUsuario['email'] === $usuario->getEmail());
        $this->verificar($query->rowCount() == 1);
    }


    public function testeEmail()
    {
        $usuario = new Usuario('Ricardo', 'Martins', 'ricardo@gmail.com', '123456789', '123456789', null, null);
        $usuario->salvar();

        $this->verificar('ricardo@gmail.com' === $usuario->getEmail());
    }

    public function testeBuscarTodos()
    {
        $ricardo = new Usuario('Ricardo', 'Martins', 'ricardo@gmail.com', '123456789', '123456789', null, null);
        $bruna = new Usuario('Bruna', 'Camomila', 'bruna@gmail.com', '123456789', '123456789', null, null);
        $ricardo->salvar();
        $bruna->salvar();

        $testes = Usuario::buscarTodos();
        foreach ($testes as $teste){

    }

    }


}
