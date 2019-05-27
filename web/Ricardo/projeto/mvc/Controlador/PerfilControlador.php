<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;

class PerfilControlador extends Controlador
{
    public function index()
    {

    $this->visao('perfil/index.php');

    }



}
