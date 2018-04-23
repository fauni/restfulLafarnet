<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class SaccProductosEspecificacionModel
{
    private $db;
    private $table = 'sacc_productos_especificacion';
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

            $stm = $this->db->prepare("SELECT * FROM $this->table order by codigo_producto desc");
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

			$stm = $this->db->prepare("SELECT pe.codigo_producto as 'codigo', pe.id_caracteristica, cf.descripcion, pe.especificacion, pe.tipo_caracteristica, cf.estado from sacc_productos_especificacion pe
            inner join sacc_productos_caracteristicas_fisicas cf on pe.id_caracteristica= cf.id_caracteristicas_fisicas
            where pe.codigo_producto = ? and pe.tipo_caracteristica='CF'
            union
            select pe.codigo_producto as 'codigo', pe.id_caracteristica, cf.descripcion, pe.especificacion, pe.tipo_caracteristica, cf.estado from sacc_productos_especificacion pe
            inner join sacc_productos_analisis_quimico cf on pe.id_caracteristica= cf.id_analisis_quimico
            where pe.codigo_producto = ? and pe.tipo_caracteristica='AQ'
            union
            select pe.codigo_producto as 'codigo', pe.id_caracteristica, cf.descripcion, pe.especificacion, pe.tipo_caracteristica, cf.estado from sacc_productos_especificacion pe
            inner join sacc_productos_analisis_microbiologico cf on pe.id_caracteristica= cf.id_analisis_microbiologico
            where pe.codigo_producto = ? and pe.tipo_caracteristica='CM';");
			$stm->execute(array($id, $id, $id));
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
        	$stm = $this->db->prepare("INSERT INTO sacc_productos_especificacion (codigo_producto, id_caracteristica, especificacion, estado, tipo_caracteristica, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion)
                VALUES (?,?,?,?,?,?,?,?,?);");
            $stm->execute(array(
                $data['codigo_producto'], 
                $data['id_caracteristica'], 
                $data['especificacion'], 
                $data['estado'],
                $data['tipo_caracteristica'],
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