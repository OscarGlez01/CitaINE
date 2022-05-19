<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/ciudadanos', function(Request $request, Response $response){
    try{
        $sql = "SELECT * FROM ciudadano";
        try {
            $db = new db();
            $db = $db->connect();
            $stmt = $db->query($sql);
            $ciudadanos = $stmt->fetchAll(PDO::FETCH_OBJ);
            $db = null;
            return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($ciudadanos, JSON_UNESCAPED_UNICODE));
        } catch(PDOException $ex){
            echo '{"error": {"text": '.$ex->getMessage().'}';
        }
    }catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});