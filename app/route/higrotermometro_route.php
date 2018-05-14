<?php
use App\Model\HigrotermometroModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/higrotermometro/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('get', function ($req, $res, $args) {
        $um = new HigrotermometroModel();
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
        $um = new HigrotermometroModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Get($args['id'])
            )
        );
    });

    
/*
    $this->put('edit', function ($req, $res) {
        $um = new PublicacionModel();
        
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