<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

//Obtener todos los codigo_postal
// $app->get('/api/v1', function(Request $request, Response $response){
//     $consulta = "SELECT * FROM postal_codes";
//     try{
//         // Instanciar la base de datos
//         $db = new db();

//         // Conexión
//         $db = $db->conectar();
//         $ejecutar = $db->query($consulta);
//         $codigo_postal = $ejecutar->fetchAll(PDO::FETCH_OBJ);
//         $db = null;

//         //Exportar y mostrar en formato JSON
//         echo json_encode($codigo_postal);

//     } catch(PDOException $e){
//         echo '{"error": {"text": '.$e->getMessage().'}';
//     }
// });

//Obtener un solo codigo_postal
$app->get('/api/v1/{id}', function(Request $request, Response $response){

    $id = $request->getAttribute('id');

    $consulta = "SELECT * FROM postal_codes WHERE cp='$id'";
    try{
        // Instanciar la base de datos
        $db = new db();

        // Conexión
        $db = $db->conectar();
        $ejecutar = $db->query($consulta);
        $codigo_postal = $ejecutar->fetchAll(PDO::FETCH_OBJ);
        $db = null;

        //Exportar y mostrar en formato JSON
        // echo json_encode($codigo_postal); 
        // echo json_encode(($codigo_postal));
        echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($codigo_postal, JSON_UNESCAPED_UNICODE), ENT_NOQUOTES));

        
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});
