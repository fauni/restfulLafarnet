<?php
use App\Model\BotonesUserModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/botones_user/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('get/{user}', function ($req, $res, $args) {
        $um = new BotonesUserModel();
        $this->logger->info("Consulta Nombre boton: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetByUsBtn($args['user'])
            )
        );
    });

});