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

    $this->get('countbyusername/{username}', function ($req, $res, $args) {
        $um = new UsuarioModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->CountByUsername($args['username'])
            )
        );
    });

    $this->get('getc', function ($req, $res, $args) {
        $um = new UsuarioModel();
        $this->logger->info("Consulta Usuario: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->withHeader('Access-Control-Allow-Origin', '*')
           ->getBody()
           ->write(
            json_encode(
                $um->GetCompleter()
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

    $this->get('getforemail/{email}', function ($req, $res, $args) {
        $um = new UsuarioModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetForEmail($args['email'])
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

    $this->post('updateImage', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->updateImage(
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

    $this->post('recovery', function ($req, $res) {
        $um = new UsuarioModel();
        //print_r ($req->getParsedBody());
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->RecoveryByEmail(
                    $req->getParsedBody()
                )
            )
        );
    });

    
    $this->put('updateSuperAreaForUser', function ($req, $res) {
        $um = new UsuarioModel();  
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->updateSuperAreaForUser(
                    $req->getParsedBody()
                )
            )
        );      
    });

    $this->put('updateSuperiorForUser', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->updateSuperiorForUser(
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


    $this->put('changePasswordForUser', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->changePasswordForUser(
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

    // resetear el password de usuario

    $this->put('resetPassword', function ($req, $res) {
      $um = new UsuarioModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->resetPassword(
                  $req->getParsedBody()
              )
          )
      );      
    });
});




?>