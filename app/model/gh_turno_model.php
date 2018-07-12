<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class GhTurnoModel
{
    private $db;
    private $table = 'gh_turno';
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

            $stm = $this->db->prepare("SELECT * FROM $this->table where estado_turno = 1");
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

			$stm = $this->db->prepare("SELECT  u.username as id_dependiente, CONCAT(u.first_name, ' ',  u.last_name) 
                        as nombre_dependiente, c.nombre_cargo from gh_dependiente_supervisor ds 
                        inner join users u on ds.id_dependiente = u.username
                        inner join cargos c on u.id_cargo = c.id
                        where ds.id_supervisor = ?; ");
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
        	$stm = $this->db->prepare("INSERT INTO sacc_ingresos (codigo, fecha, glosa, id_proveedor, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?,?,?);");
            $stm->execute(array(
                $data['codigo'], 
                $data['fecha'], 
                $data['glosa'], 
                $data['id_proveedor'],
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