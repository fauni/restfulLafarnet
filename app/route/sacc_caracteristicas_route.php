<?php
use App\Model\CaracteristicasModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/caracteristicas/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users como estas');
    });
    
    $this->get('getMP', function ($req, $res, $args) {
        $um = new CaracteristicasModel();
        $this->logger->info("Consulta Analistas: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAllMP()
            )
        );
    }); 

    $this->get('getPT', function ($req, $res, $args) {
        $um = new CaracteristicasModel();
        $this->logger->info("Consulta Analistas: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAllPT()
            )
        );
    });  
    $this->post('save', function ($req, $res) {
        $um = new CaracteristicasModel();
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
});