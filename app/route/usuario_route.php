<?php
use App\Model\UsuarioModel;

$app->group('/usuario/', function () {
    
    $this->get('get', function ($req, $res, $args) {
        $um = new UsuarioModel();
        $this->logger->info("Consulta Usuario: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAll()
            )
        );
    });
    
});

?>