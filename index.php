<?php
// 1. Primeiro as configurações globais
require_once 'config.php';

// 2. Depois o autoloader das classes
require_once 'autoload.php';

use App\Model\Lista;

$listaModel = new Lista();

$ingredientes = $listaModel->listarIngredientes();

// Carrega a View
include 'view/index.php';