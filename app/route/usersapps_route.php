<?php
use App\Model\UsersAppsModel;

$app->group('/usersapps/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
  
    $this->get('getbyuserid/{id}', function ($req, $res, $args) {
        $um = new UsersAppsModel();
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetByUserId($args['id'])
            )
        );
    });
     $this->post('save', function ($req, $res) {
        $um = new UsersAppsModel();
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
    $this->post('delete', function ($req, $res) {
      $um = new UsersAppsModel();  
      return $res
         ->withHeader('Content-type', 'application/json')
         ->getBody()
         ->write(
          json_encode(
              $um->Delete(
                  $req->getParsedBody()
              )
          )
      );      
    });
});