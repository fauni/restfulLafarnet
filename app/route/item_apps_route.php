<?php

use App\Model\ItemAppsModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/itemapps/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('get', function ($req, $res, $args) {
        $um = new ItemAppsModel();
        $this->logger->info("Consulta ItemsApps: ".$res); 
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
        $um = new ItemAppsModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Get($args['id'])
            )
        );
    });

    $this->get('getforapps/{id}', function ($req, $res, $args) {
        $um = new ItemAppsModel();
        $this->logger->info("Consulta ItemsApps for Apps: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetForApp($args['id'])
            )
        );
    });

    $this->post('getitemforapps', function ($req, $res) {
        $um = new ItemAppsModel();
        $this->logger->info("Consulta ItemApps for Apps: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->withHeader('Access-Control-Allow-Origin', '*')
           ->getBody()
           ->write(
            json_encode(
              $um->GetItemForApps(
                $req->getParsedBody()
              )
            )
        );
    });


    $this->post('save', function ($req, $res) {
        $um = new ItemAppsModel();
        
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
        $um = new ItemAppsModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Update(
                    $req->getParsedBody()
                )
           )
        );
    });

    $this->delete('delete/{id}', function ($req, $res, $args) {
        $um = new ItemAppsModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Delete($args['id'])
            )
        );
    });

});