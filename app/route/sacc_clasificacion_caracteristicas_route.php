<?php
use App\Model\SaccClasificacionCaracteristicasModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/saccclasificacioncaracteristicas/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('get', function ($req, $res, $args) {
        $um = new SaccClasificacionCaracteristicasModel();
        $this->logger->info("Consulta Especificacion de Características por Clasificación: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAll()
            )
        );
    });
    
    $this->get('get/{id}', function ($req, $res, $args) {
        $um = new SaccClasificacionCaracteristicasModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Get($args['id'])
            )
        );
    });

    $this->get('clasificacion/{id}', function ($req, $res, $args) {
        $um = new SaccClasificacionCaracteristicasModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetClasificacionByNamePT($args['id'])
            )
        );
    });

     $this->post('save', function ($req, $res) {
        $um = new SaccClasificacionCaracteristicasModel();
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Insert(
                    $req->getParsedBody()
                )
            )
        );
    });

    $this->put('edit', function ($req, $res) {
        $um = new SaccClasificacionCaracteristicasModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->update(
                    $req->getParsedBody()
                )
           )
        );
    });
/*
    $this->delete('delete/{id}', function ($req, $res, $args) {
        $um = new PublicacionModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Delete($args['id'])
            )
        );
    });*/
});