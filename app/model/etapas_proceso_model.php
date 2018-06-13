<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class EtapasProcesoModel
{
    private $db;
    private $table = 'etapas_proceso';
    private $response;
    
    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
    }
    
    public function GetAll()
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT * from etapas_proceso");
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
    
    public function Get($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT * from etapas_proceso where id_etapa_proceso=?");
			$stm->execute(array($id));

			$this->response->setStatus(200);
			$this->response->setBody($stm->fetchAll());
            $this->response->message=$this->response->getMessageForCode(200);
            
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }

    public function getEtapaForProceso($data){
        try
        {   
            $result = array();

			$stm = $this->db->prepare("SELECT * from etapas_proceso where id_proceso=? and id_area = ?");
			$stm->execute(array(
                $data["id_proceso"],
                $data["id_area"]
            ));

            $this->response->setBody($stm->fetchAll());
            $this->response->setStatus(200);
            $this->response->message= $this->response->getMessageForCode(200);
            return $this->response;

        } catch(Exception $e){
            $this->response->setStatus($e->getCode());
            $this->response->message=$e->getMessage();
            return $this->response;
        }
    }

    public function saveTHRProceso($data){
        try
        {   
            $result = array();

			$stm = $this->db->prepare("INSERT INTO monitoreo_thr_proceso (id_seccion, id_etapa, lote, codigo_producto, 
            nombre_producto, hora, fecha, temperatura_original, humedad_relativa_original, temperatura_corregido, 
            humedad_relativa_corregido, higroscopico, username, estado, usuario_creacion, 
            fecha_creacion, usuario_modificacion, fecha_modificacion) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
			$stm->execute(array(
                $data['id_seccion'],
                $data['id_etapa'],
                $data['lote'],
                $data['codigo_producto'],
                $data['nombre_producto'],
                date('H:i:s'),
                date('Y-m-d'),
                $data['temperatura_original'],
                $data['humedad_relativa_original'],
                $data['temperatura_corregido'],
                $data['humedad_relativa_corregido'],
                $data['higroscopico'],
                $data['username'],
                1, // $data['estado'],
                $data['usuario_creacion'],
                date('Y-m-d H:i:s'),
                $data['usuario_modificacion'],
                date('Y-m-d H:i:s')
            ));

            $this->response->setBody($data);
            $this->response->setStatus(200);
            $this->response->message= $this->response->getMessageForCode(200);
            return $this->response;

        } catch(Exception $e){
            $this->response->setStatus($e->getCode());
            $this->response->message=$e->getMessage();
            return $this->response;
        }
    }
}