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
            $stm = $this->db->prepare("select  *, 'CF' as esp_car, false as checkeado from sacc_productos_caracteristicas_fisicas 
                                        where tipo = 1 and estado = 1 
                                        union
                                        select *, 'AQ' as esp_car, false as checkeado from sacc_productos_analisis_quimico
                                        where tipo = 1 and estado = 1
                                        union
                                        select *, 'CM' as esp_car, false as checkeado from sacc_productos_analisis_microbiologico 
                                        where tipo = 1 and estado = 1;");
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
            $stm = $this->db->prepare("select  *, 'CF' as esp_car, false as checkeado from sacc_productos_caracteristicas_fisicas 
                                        where tipo = 2 and estado = 1
                                        union
                                        select *, 'AQ' as esp_car, false as checkeado from sacc_productos_analisis_quimico
                                        where tipo = 2 and estado = 1
                                        union
                                        select *, 'CM' as esp_car, false as checkeado from sacc_productos_analisis_microbiologico 
                                        where tipo = 2 and estado = 1;");
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
     public function Insert($data){
        try
        {   if ($data['esp_car']=="CF") {
              $stm = $this->db->prepare("INSERT INTO sacc_productos_caracteristicas_fisicas (descripcion,tipo, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?,?);");
            }
            if ($data['esp_car']=="AQ") {
                $stm = $this->db->prepare("INSERT INTO sacc_productos_analisis_quimico (descripcion,tipo, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?,?);");
            }
            if ($data['esp_car']=="CM") {
                $stm = $this->db->prepare("INSERT INTO sacc_productos_analisis_microbiologico (descripcion,tipo, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?,?);");
            }
            
            $stm->execute(array(
                $data['descripcion'], 
                $data['tipo'], 
                $data['estado'], 
                $data['usuario_creacion'],
                date('Y-m-d H:i:s'),
                $data['usuario_modificacion'],
                date('Y-m-d H:i:s')
            ));
            $this->response->setBody($data);
            $this->response->setStatus(200);
            $this->response->message=$this->response->getMessageForCode(200);

            return $this->response;

        } catch(Exception $e){
            $this->response->setStatus($e->getCode());
            $this->response->message=$e->getMessage();
            return $this->response;
        }
    }   

}