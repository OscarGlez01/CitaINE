<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/comprobantes', function(Request $request, Response $response){
    try {
        $sql = "SELECT * FROM comprobantedomicilio";
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $comprobantes = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($comprobantes, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});