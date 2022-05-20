<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


// Obtener una cita
$app->get('/api/citas/{id}', function(Request $request, Response $response){
    try {
        $id = $request->getAttribute('id');
        $sql = "SELECT * FROM cita WHERE id = $id";
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $citas = $stmt->fetch(PDO::FETCH_ASSOC);
        $data["cita"]=[
            "id" => $citas["id"],
            "folio" => $citas["folio"],
            "ciudadano" => $citas["ciudadano"],
            "fecha" => $citas["fecha"],
            "documento" => $citas["documento"],
            "comprobante" => $citas["comprobante"],
            "Modulo" => $db->query("SELECT * FROM modulo WHERE id =". $citas["idModulo"])->fetch(PDO::FETCH_ASSOC),
            "Tramite" => $db->query("SELECT * FROM tramite WHERE id =". $citas["idTramite"])->fetch(PDO::FETCH_ASSOC)
        ];
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($citas, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Obtener todas las citas
$app->get('/api/citas', function(Request $request, Response $response){
    $sql = "SELECT * FROM cita";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $citas = $stmt->fetchAll();
        $data = [];
        foreach($citas as $idCita => $cita){
            $data["citas"][] = [
                "id" => $cita["id"],
                "folio" => $cita["folio"],
                "fecha" => $cita["fecha"],
                "ciudadano" => $cita["ciudadano"],
                "documento" => $cita["documento"],
                "comprobante" => $cita["comprobante"],
                "Modulo" => $db->query("SELECT nombre FROM modulo WHERE id =". $cita["idModulo"])->fetch(PDO::FETCH_ASSOC),                
                "Tramite" => $db->query("SELECT nombre FROM tramite WHERE id =". $cita["idTramite"])->fetch(PDO::FETCH_ASSOC),
                "estado" => $cita["estado"],
            ];
        }
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($data, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});

// Guarda una cita
$app->post('/api/citas/guardar', function(Request $request, Response $response){
    
    try {
        $value = json_decode($request->getBody());
        $folio = $value->folio;
        $ciudadano = $value->ciudadano;
        $fecha = $value->fecha;
        $documento = $value->documento;
        $comprobante = $value->comprobante;
        $idModulo = $value->idModulo;
        $idTramite = $value->idTramite;
        $estado = $value->estado;

        $db = new db();
        $db = $db->connect();

        include("../src/entities/Respuesta.php");
        $object = new Respuesta();

        $sql = "INSERT INTO cita (folio, ciudadano, fecha, documento, comprobante, idModulo, idTramite, estado) VALUES (:folio, :ciudadano, :fecha, :documento, :comprobante, :idModulo, :idTramite, :estado);";
        $statement = $db->prepare($sql);
        if($statement->execute([":folio" => $folio,
        ":ciudadano" => $ciudadano, 
        ":fecha" => $fecha,
        ":documento" => $documento,  
        ":comprobante" => $comprobante, 
        ":idModulo" => $idModulo,
        ":idTramite" => $idTramite,
        ":estado" => $estado]))
        {
          $object->resultado = true;
          $object->mensaje = "La cita se guardo correctamente";

        } else {
            $object->resultado = false;
            $object->mensaje="Ocurrio un error al guardar la cita";
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