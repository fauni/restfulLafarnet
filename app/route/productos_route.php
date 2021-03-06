<?php
use App\Model\ProductosModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/productos/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('get', function ($req, $res, $args) {
        $um = new ProductosModel();
        $this->logger->info("Consulta Productos: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAll()
            )
        );
    });

    $this->get('clasificacionPT', function ($req, $res, $args) {
        $um = new ProductosModel();
        $this->logger->info("Consulta Clasificacion PT: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetClasificacionPT()
            )
        );
    });

    $this->get('clasificacionMP', function ($req, $res, $args) {
        $um = new ProductosModel();
        $this->logger->info("Consulta Clasificacion MP: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetClasificacionMP()
            )
        );
    });
});