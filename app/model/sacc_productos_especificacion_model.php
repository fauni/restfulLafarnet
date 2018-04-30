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

			$stm = $this->db->prepare("SELECT pe.codigo_producto as 'codigo', pe.id_caracteristica, cf.descripcion, pe.especificacion, pe.tipo_caracteristica, pe.estado from sacc_productos_especificacion pe
            inner join sacc_productos_caracteristicas_fisicas cf on pe.id_caracteristica= cf.id_caracteristicas_fisicas
            where pe.codigo_producto = ? and pe.tipo_caracteristica='CF' and pe.estado=1
            union
            select pe.codigo_producto as 'codigo', pe.id_caracteristica, cf.descripcion, pe.especificacion, pe.tipo_caracteristica, pe.estado from sacc_productos_especificacion pe
            inner join sacc_productos_analisis_quimico cf on pe.id_caracteristica= cf.id_analisis_quimico
            where pe.codigo_producto = ? and pe.tipo_caracteristica='AQ' and pe.estado=1
            union
            select pe.codigo_producto as 'codigo', pe.id_caracteristica, cf.descripcion, pe.especificacion, pe.tipo_caracteristica, pe.estado from sacc_productos_especificacion pe
            inner join sacc_productos_analisis_microbiologico cf on pe.id_caracteristica= cf.id_analisis_microbiologico
            where pe.codigo_producto = ? and pe.tipo_caracteristica='CM' and pe.estado=1;");
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
    
    public function Existe($data){
        try
        {   
        	$stm = $this->db->prepare("SELECT * from sacc_productos_especificacion where codigo_producto=? 
            AND id_caracteristica=? AND tipo_caracteristica = ?;
            ");
            $stm->execute(array(
                $data['codigo_producto'], 
                $data['id_caracteristica'], 
                $data['tipo_caracteristica']
            ));

            $count = $stm->rowCount();

            if ($count>0) {
                $this->response->setStatus(200);
                $this->response->setBody("true");
                $this->response->message=$this->response->getMessageForCode(200);
            } else {
                $this->response->setStatus(404);
                $this->response->setBody("fasle");
                $this->response->message=$this->response->getMessageForCode(404);
            }

            return $this->response;

        } catch(Exception $e){
            $this->response->setStatus($e->getCode());
            $this->response->message=$e->getMessage();
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
    
    public function UpdateEspecificacion($data){
        try
        {   
        	$stm = $this->db->prepare("UPDATE sacc_productos_especificacion set especificacion=?, usuario_modificacion=?, fecha_modificacion=?
            where codigo_producto=? and id_caracteristica=? and tipo_caracteristica=?;");
            $stm->execute(array(
                $data['especificacion'],
                $data['usuario_modificacion'],
                date('Y-m-d H:i:s'),
                $data['codigo_producto'],
                $data['id_caracteristica'],
                $data['tipo_caracteristica']
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

    public function UpdateAllEstadosCaracteristicasProducto($data){
        try
        {   
        	$stm = $this->db->prepare("UPDATE sacc_productos_especificacion set estado=? where codigo_producto=?;");
            $stm->execute(array(
                $data['estado'],
                $data['codigo_producto']
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

    public function Update($data){
        try
        {   
        	$stm = $this->db->prepare("UPDATE sacc_productos_especificacion set estado=? , usuario_modificacion=?, fecha_modificacion=?
            where codigo_producto=? and id_caracteristica=? and tipo_caracteristica=?;");
            $stm->execute(array(
                $data['estado'],
                $data['usuario_modificacion'],
                date('Y-m-d H:i:s'),
                $data['codigo_producto'], 
                $data['id_caracteristica'],
                $data['tipo_caracteristica']
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