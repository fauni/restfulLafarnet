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

    $this->get('get/{username}', function ($req, $res, $args) {
        $um = new UsuarioModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Get($args['username'])
            )
        );
    });

    $this->post('save', function ($req, $res) {
      $um = new UsuarioModel();
        
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

    $this->put('changePassword', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->changePassword(
                  $req->getParsedBody()
              )
          )
      );      
    });

    $this->put('updateInformationGeneral', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->updateInformationGeneral(
                  $req->getParsedBody()
              )
          )
      );      
    });

    $this->put('updateInformationLaboral', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->updateInformationLaboral(
                  $req->getParsedBody()
              )
          )
      );      
    });

    $this->put('delete', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->DeleteUser(
                  $req->getParsedBody()
              )
          )
      );      
    });
});




?>