<? public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar($resposta['redirecionar'] === URL_RAIZ . 'contatos');
    }php public function tes public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar($resposta['redirecionar'] === URL_RAIZ . 'contatos');
    }teAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar($resposta['redirecionar'] === URL_RAIZ . 'contatos');
    }

require_once '../framework/DW3Carregador.php';

$testador = new \Framework\DW3Testador();
$testador->testarTudo();
