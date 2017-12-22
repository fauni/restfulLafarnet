<?php
use App\Model\UsuarioModel;

$app->group('/usuario/', function () {
    
    $this->get('get', function ($req, $res, $args) {
        $um = new UsuarioModel();
        $this->logger->info("Consulta Usuario: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->withHeader('Access-Control-Allow-Origin', '*')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAll()
            )
        );
    });

    $this->post('save', function ($req, $res) {
        $um = new SeccionModel();
        
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

    $this->post('login', function ($req, $res) {
        $um = new UsuarioModel();
        //print_r ($req->getParsedBody());
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Login(
                    $req->getParsedBody()
                )
            )
        );
    });

    $this->post('apps', function ($req, $res) {
        $um = new UsuarioModel();
        $this->logger->info("Consulta AppsForUsuario: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->withHeader('Access-Control-Allow-Origin', '*')
           ->getBody()
           ->write(
            json_encode(
              $um->GetApps(
                $req->getParsedBody()
              )
            )
        );
    });
});




?>