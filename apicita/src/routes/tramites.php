<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


// Obtener todos los tramites
$app->get('/api/tramites', function(Request $request, Response $response){
    $sql = "SELECT * FROM tramite";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $tramites = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($tramites, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Obtener un tramite
$app->get('/api/tramites/{id}', function(Request $request, Response $response){
    try {
        $id = $request->getAttribute('id');
        $sql = "SELECT * FROM tramite WHERE id = $id";
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $tramites = $stmt->fetch(PDO::FETCH_ASSOC);
        $data["tramite"]=[
            "id" => $tramites["id"],
            "nombre" => $tramites["nombre"]
        ];
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($tramites, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Guarda un tramite
$app->post('/api/tramites/guardar', function(Request $request, Response $response){
    
    try {
        $value = json_decode($request->getBody());
        $nombre = $value->nombre;
        $ciudad = $value->ciudad;

        $db = new db();
        $db = $db->connect();

        include("../src/entities/Respuesta.php");
        $object = new Respuesta();

        $sql = "INSERT INTO tramite (nombre) VALUES (:nombre, );";
        $statement = $db->prepare($sql);
        if($statement->execute([":nombre" => $nombre])){
          $object->resultado = true;
          $object->mensaje = "El tramite se guardo correctamente";

        } else {
            $object->resultado = false;
            $object->mensaje="Ocurrio un error al guardar el tramite";
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