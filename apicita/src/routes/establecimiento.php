<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

//$app = new \Slim\App;

// Obtener todos los usuarios
$app->get('/api/establecimientos', function(Request $request, Response $response){
    $sql = "SELECT * FROM establecimiento";
    try {
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $establecimientos = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->write(json_encode($establecimientos, JSON_UNESCAPED_UNICODE));
    } catch(PDOException $ex){
        echo '{"error": {"text": '.$ex->getMessage().'}';
    }
});
?>