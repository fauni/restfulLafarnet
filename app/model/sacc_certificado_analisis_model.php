<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class SaccCertificadoAnalisisModel
{
    private $db;
    private $table = 'sacc_certificado_analisis';
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

            $stm = $this->db->prepare("SELECT * FROM $this->table order by fecha_analisis desc");
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

            $stm = $this->db->prepare("SELECT * FROM $this->table WHERE tipo_certificado= 'PT' order by fecha_analisis desc");
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
    
    public function GetAllMP()
    {
		try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT * FROM $this->table WHERE tipo_certificado= 'MP' order by fecha_analisis desc");
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

			$stm = $this->db->prepare("SELECT * FROM sacc_certificado_analisis WHERE codigo_certificado = ?;");
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

    public function Insert($data){
        try
        {   
            $stm = $this->db->prepare("INSERT INTO sacc_certificado_analisis (codigo_certificado, codigo_analista, 
            protocolo, fecha_analisis, lote, fecha_fabricacion, fecha_vencimiento, cantidad_fabricada, 
            cantidad_liberada, tipo_certificado, tipo_clasificacion_producto, codigo_producto, dictamen, observaciones, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
            $stm->execute(array(
                $data['codigo_certificado'],
                $data['codigo_analista'],
                $data['protocolo'],
                $data['fecha_analisis'],
                $data['lote'],
                $data['fecha_fabricacion'],
                $data['fecha_vencimiento'],
                $data['cantidad_fabricada'],
                $data['cantidad_liberada'],
                $data['tipo_certificado'],
                $data['tipo_clasificacion_producto'],
                $data['codigo_producto'],
                $data['dictamen'],
                $data['observaciones'],
                $data['usuario_modificacion'],
                date('Y-m-d H:i:s'),
                $data['usuario_creacion'],
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