<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class CaracteristicasModel
{
    private $db;
    private $table = 'sacc_clasificacion_caracteristicas';
    private $response;
    
    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
    }
    
   public function GetAllMP()
    {
        try
        {
            $result = array();
            $stm = $this->db->prepare("select  *, 'CF' as esp_car from sacc_productos_caracteristicas_fisicas 
                                        where tipo = 1
                                        union
                                        select *, 'AQ' as esp_car from sacc_productos_analisis_quimico
                                        where tipo = 1
                                        union
                                        select *, 'CM' as esp_car from sacc_productos_analisis_microbiologico 
                                        where tipo = 1 ;");
            $stm->execute();
            
            $this->response->setStatus(200);
            $this->response->setBody($stm->fetchAll());
            $this->response->message=$this->response->getMessageForCode(200);
            return $this->response;
        }
        catch(Exception $e)
        {
            $this->response->setStatus($e->getCode());
            return $this->response;
        }
    }
     public function GetAllPT()
    {
        try
        {
            $result = array();
            $stm = $this->db->prepare("select  *, 'CF' as esp_car from sacc_productos_caracteristicas_fisicas 
                                        where tipo = 2
                                        union
                                        select *, 'AQ' as esp_car from sacc_productos_analisis_quimico
                                        where tipo = 2
                                        union
                                        select *, 'CM' as esp_car from sacc_productos_analisis_microbiologico 
                                        where tipo = 2;");
            $stm->execute();
            
            $this->response->setStatus(200);
            $this->response->setBody($stm->fetchAll());
            $this->response->message=$this->response->getMessageForCode(200);
            return $this->response;
        }
        catch(Exception $e)
        {
            $this->response->setStatus($e->getCode());
            return $this->response;
        }
    }

}