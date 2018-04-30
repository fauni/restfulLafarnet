<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class SaccClasificacionCaracteristicasModel
{
    private $db;
    private $table = 'sacc_clasificacion_caracteristicas';
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

            $stm = $this->db->prepare("SELECT * FROM $this->table order by id_tipo_clasificacion fecha desc");
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
			$stm = $this->db->prepare("SELECT cc.id_tipo_clasificacion as 'codigo', cf.id_caracteristicas_fisicas as 'id_caracteristica', cf.descripcion,'' as 'especificacion', cc.tipo_caracteristica, cc.estado from sacc_clasificacion_caracteristicas cc 
            inner join sacc_productos_caracteristicas_fisicas cf on cc.id_caracteristica= cf.id_caracteristicas_fisicas
            where cc.id_tipo_clasificacion=? and cc.tipo_caracteristica='CF' and cc.estado = 1
            union
            select cc.id_tipo_clasificacion as 'codigo', cf.id_analisis_quimico as 'id_caracteristica', cf.descripcion,'' as 'especificacion', cc.tipo_caracteristica, cc.estado from sacc_clasificacion_caracteristicas cc 
            inner join sacc_productos_analisis_quimico cf on cc.id_caracteristica= cf.id_analisis_quimico
            where cc.id_tipo_clasificacion=? and cc.tipo_caracteristica='AQ' and cc.estado = 1
            union
            select cc.id_tipo_clasificacion as 'codigo', cf.id_analisis_microbiologico as 'id_caracteristica', cf.descripcion,'' as 'especificacion', cc.tipo_caracteristica, cc.estado from sacc_clasificacion_caracteristicas cc 
            inner join sacc_productos_analisis_microbiologico cf on cc.id_caracteristica= cf.id_analisis_microbiologico
            where cc.id_tipo_clasificacion=? and cc.tipo_caracteristica='CM' and cc.estado = 1
");
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

    public function GetClasificacionByNamePT($id)
    {
		try
		{
			$result = array();
			$stm = $this->db->prepare("SELECT * from sacc_productos_clasificacion where name = ? AND TIPO = 'PT';");
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
        	$stm = $this->db->prepare("INSERT INTO $this->table (id_tipo_clasificacion,  id_caracteristica , tipo_caracteristica, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?,?,?);");
            $stm->execute(array(
                $data['id_tipo_clasificacion'], 
                $data['id_caracteristica'], 
                $data['tipo_caracteristica'], 
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
     public function update($data){
        try
        {
            $stm = $this->db->prepare("UPDATE $this->table SET id_tipo_clasificacion=?, id_caracteristica=?, tipo_caracteristica = ?, estado=?,usuario_modificacion=?, fecha_modificacion=? WHERE id_clasificacion_caracteristica=?");
            $stm->execute(
                array(
                    $data['id_tipo_clasificacion'],
                    $data['id_caracteristica'],
                    $data['tipo_caracteristica'],
                    $data['estado'],
                    $data['usuario_modificacion'],
                    $data['fecha_modificacion'],
                    $data['id_clasificacion_caracteristica']
                )
            );
            //print_r($stm);
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