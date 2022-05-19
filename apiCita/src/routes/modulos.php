<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/modulos/{id}', function(Request $request, Response $response){
    try {
        $id = $request->getAttribute('id');
        $sql = "SELECT * FROM modulo WHERE idCiudad = $id";
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