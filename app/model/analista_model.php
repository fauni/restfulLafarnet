<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class AnalistaModel
{
    private $db;
    private $table = 'sacc_analistas';
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
            $stm = $this->db->prepare("SELECT a.codigo, a.username, a.grado, concat(u.first_name,' ',u.last_name) as nombre_completo, a.especialidad, a.id_firma from sacc_analistas a inner join users u on u.username = a.username;");
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
    
    /*public function Get($id)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT * FROM $this->table WHERE id = ?");
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
    } */  

    public function Insert($data){
        try
        {   
        	$stm = $this->db->prepare("INSERT INTO sacc_analistas (codigo, username, grado, especialidad, id_firma, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?,?,?,?);");
            $stm->execute(array(
                $data['codigo'], 
                $data['username'], 
                $data['grado'], 
                $data['especialidad'],
                $data['id_firma'],
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