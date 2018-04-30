<?php
use App\Model\SaccCertificadoAnalisisModel;
//use Slim\Http\UploadedFile;
//use Slim\Http\Request;
//use Slim\Http\Response;

$app->group('/sacccertificadoanalisis/', function () {
    
    $this->get('test', function ($req, $res, $args) {
        return $res->getBody()
                   ->write('Hola Users');
    });
    
    $this->get('get', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        $this->logger->info("Consulta Especificacion de Certificado de Analisis: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAll()
            )
        );
    });

    $this->get('pt', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        $this->logger->info("Consulta Especificacion de Certificado de Analisis PT: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAllPT()
            )
        );
    });

    $this->get('mp', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        $this->logger->info("Consulta Especificacion de Certificado de Analisis MP: ".$res); 
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAllMP()
            )
        );
    });
    
    $this->get('get/{id}', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->Get($args['id'])
            )
        );
    });

    $this->get('getl/{id}', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetPorLote($args['id'])
            )
        );
    });
    
    $this->get('getCF/{id}', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetCF($args['id'])
            )
        );
    });

    $this->get('getAQ/{id}', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetAQ($args['id'])
            )
        );
    });

    $this->get('getCM/{id}', function ($req, $res, $args) {
        $um = new SaccCertificadoAnalisisModel();
        
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->GetCM($args['id'])
            )
        );
    });
    
    $this->post('save', function ($req, $res) {
        $um = new SaccCertificadoAnalisisModel();
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
    
    $this->post('savec', function ($req, $res) {
        $um = new SaccCertificadoAnalisisModel();
        return $res
           ->withHeader('Content-type', 'application/json')
           ->getBody()
           ->write(
            json_encode(
                $um->InsertCaracteristica(
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