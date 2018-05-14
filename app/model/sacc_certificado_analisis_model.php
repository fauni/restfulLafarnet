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

    public function GetPorLote($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT * FROM sacc_certificado_analisis WHERE lote = ?;");
			$stm->execute(array(str_replace("[","/", $id)));
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

    public function GetCF($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT cc.id_certificado_caracteristica, cc.codigo_certificado, codigo_producto, cf.descripcion as 'id_caracteristica', cc.especificacion, cc.resultado, cc.estado, cc.tipo_caracteristica, cc.usuario_creacion, cc.fecha_creacion, cc.usuario_modificacion, cc.fecha_modificacion
            from sacc_certificado_caracteristica cc
            inner join sacc_productos_caracteristicas_fisicas cf on cc.id_caracteristica = cf.id_caracteristicas_fisicas
            where codigo_certificado=? and tipo_caracteristica='CF' ;
            ");
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

    public function GetAQ($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT cc.id_certificado_caracteristica, cc.codigo_certificado, codigo_producto, cf.descripcion as 'id_caracteristica', cc.especificacion, cc.resultado, cc.estado, cc.tipo_caracteristica, cc.usuario_creacion, cc.fecha_creacion, cc.usuario_modificacion, cc.fecha_modificacion
            from sacc_certificado_caracteristica cc
            inner join sacc_productos_caracteristicas_fisicas cf on cc.id_caracteristica = cf.id_caracteristicas_fisicas
            where codigo_certificado=? and tipo_caracteristica='AQ' ;
            ");
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

    public function GetCM($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT cc.id_certificado_caracteristica, cc.codigo_certificado, codigo_producto, cf.descripcion as 'id_caracteristica', cc.especificacion, cc.resultado, cc.estado, cc.tipo_caracteristica, cc.usuario_creacion, cc.fecha_creacion, cc.usuario_modificacion, cc.fecha_modificacion
            from sacc_certificado_caracteristica cc
            inner join sacc_productos_caracteristicas_fisicas cf on cc.id_caracteristica = cf.id_caracteristicas_fisicas
            where codigo_certificado=? and tipo_caracteristica='CM' ;
            ");
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
            protocolo, fecha_analisis, lote, fecha_fabricacion, fecha_vencimiento, cantidad_fabricada, cantidad_liberada, 
            tipo_certificado, tipo_clasificacion_producto, codigo_producto, dictamen, observaciones, tipo_impresion, 
            nombre_producto, concentracion, forma_farmaceutica, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);
");
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
                $data['tipo_impresion'],
                $data['nombre_producto'],
                $data['concentracion'],
                $data['forma_farmaceutica'],
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

    public function InsertCaracteristica($data){
        try
        {   
            $stm = $this->db->prepare("INSERT INTO sacc_certificado_caracteristica (codigo_certificado, codigo_producto, id_caracteristica, especificacion, resultado, estado, tipo_caracteristica, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion)
            VALUES(?,?,?,?,?,?,?,?,?,?,?);");
            $stm->execute(array(
                $data['codigo_certificado'],
                $data['codigo_producto'],
                $data['id_caracteristica'],
                $data['especificacion'],
                $data['resultado'],
                $data['estado'],
                $data['tipo_caracteristica'],
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