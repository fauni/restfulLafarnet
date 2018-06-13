<?php
use App\Model\AnalistaModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/analista/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('get', function ($req, $res, $args) {
        $um = new AnalistaModel();
        
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
        $um = new AnalistaModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Get($args['id'])
            )
        );
    });

    $this->get('getbyusrnm/{id}', function ($req, $res, $args) {
        $um = new AnalistaModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetByUsnm($args['id'])
            )
        );
    });

    $this->post('save', function ($req, $res) {
        $um = new AnalistaModel();
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
*/
    $this->delete('delete/{usr}', function ($req, $res, $args) {
        $um = new AnalistaModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Delete($args['usr'])
            )
        );
    });
});