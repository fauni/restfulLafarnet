<?php
namespace App\Model;

use App\Lib\Database;
//use App\Lib\Response;
use App\Http\Response;
class UsersAppsModel
{
    private $db;
    private $table = 'usersapps';
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

			$stm = $this->db->prepare("SELECT * FROM $this->table");
			$stm->execute();
            
			$this->response->setResponse(true);
            $this->response->result = $stm->fetchAll();
            $this->response->message = "Se obtuvieron ".$stm->rowCount()." registros";
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }
    public function GetByUserId($id)
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT * FROM $this->table WHERE userid = ?");
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
            $stm = $this->db->prepare("INSERT INTO usersapps (userid, appid, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?);");
            $stm->execute(array(
                $data['userid'], 
                $data['appid'], 
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
     public function Delete($data){
        try
        {   
            $stm = $this->db->prepare("delete from ".$this->table." WHERE userid = ? and appid = ?");
            $stm->execute(
                array(
                    $data['userid'],
                    $data['appid']
                )
            );
            //print_r($stm);

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