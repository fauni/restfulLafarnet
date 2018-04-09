<?php
use App\Model\ClasificacionCaracteristicaModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/clasificacion_caracteristica/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('getbytipoclas/{id}', function ($req, $res, $args) {
        $um = new ClasificacionCaracteristicaModel();
        $this->logger->info("Consulta clasificacion de productos: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetByTipoClasificacion($args['id'])
            )
        );
    });
    
  
});