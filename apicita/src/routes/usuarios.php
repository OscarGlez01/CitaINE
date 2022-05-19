<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

//$app = new \Slim\App;

// Obtener todos los usuarios
$app->get('/api/usuarios', function(Request $request, Response $response){
    $sql = "SELECT * FROM usuario";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $usuarios = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($usuarios, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Guarda un usuario
$app->post('/api/usuarios/guardar', function(Request $request, Response $response){
    
    try {
        $value = json_decode($request->getBody());
        $nombre = $value->nombre;
        $cuenta = $value->cuenta;

        $db = new db();
        $db = $db->connect();

        include("../src/entities/Respuesta.php");
        $object = new Respuesta();

        $sql = "INSERT INTO usuario (nombre, cuenta) VALUES (:nombre, :cuenta);";
        $statement = $db->prepare($sql);
        if($statement->execute([":nombre" => $nombre, ":cuenta" => $cuenta])){
          $object->resultado = true;
          $object->mensaje = "El usuario se guardo correctamente";

        } else {
            $object->resultado = false;
            $object->mensaje="Ocurrio un error al guardar el usuario";
        }

        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($object, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});



?>