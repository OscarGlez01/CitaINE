<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';

$app = new \Slim\App;

require '../src/routes/usuarios.php';
require '../src/routes/citas.php';
require '../src/routes/ciudadanos.php';
require '../src/routes/ciudades.php';
require '../src/routes/comprobantes.php';
require '../src/routes/documentos.php';
require '../src/routes/estados.php';
require '../src/routes/modulos.php';
require '../src/routes/tramites.php';

$app->run();
?>