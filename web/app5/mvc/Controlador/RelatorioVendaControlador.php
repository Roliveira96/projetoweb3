<?php $usuario = Usuario::buscarEmail($_POST['email']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar(URL_RAIZ . 'mensagens');
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php');
        }
namespace Controlador;

use






























































    \Modelo\Produto;
use \Modelo\RelatorioVenda;

class RelatorioVendaControlador extends Controlador
{
    public function index()
    {
        $this->visao('relatorios/venda.php', [
            'produtos' => Produto::buscarTodos(),
            'registros' => RelatorioVenda::buscarRegistros($_GET)
        ]);
    }
}
