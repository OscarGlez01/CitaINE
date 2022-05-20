<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


// Obtener un modulo
$app->get('/api/modulos/{id}', function(Request $request, Response $response){
    try {
        $id = $request->getAttribute('id');
        $sql = "SELECT * FROM modulo WHERE id = $id";
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $modulos = $stmt->fetch(PDO::FETCH_ASSOC);
        $data["modulo"]=[
            "id" => $modulos["id"],
            "nombre" => $modulos["nombre"],
            "ciudad" => $modulos["ciudad"]
        ];
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($modulos, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Obtener todas los modulos
$app->get('/api/modulos', function(Request $request, Response $response){
    $sql = "SELECT * FROM modulo";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $modulos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($modulos, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Guarda un modulo
$app->post('/api/modulos/guardar', function(Request $request, Response $response){
    
    try {
        $value = json_decode($request->getBody());
        $nombre = $value->nombre;
        $ciudad = $value->ciudad;

        $db = new db();
        $db = $db->connect();

        include("../src/entities/Respuesta.php");
        $object = new Respuesta();

        $sql = "INSERT INTO modulo (nombre, ciudad) VALUES (:nombre, :ciudad);";
        $statement = $db->prepare($sql);
        if($statement->execute([":nombre" => $nombre, ":ciudad" => $ciudad])){
          $object->resultado = true;
          $object->mensaje = "El modulo se guardo correctamente";

        } else {
            $object->resultado = false;
            $object->mensaje="Ocurrio un error al guardar el modulo";
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