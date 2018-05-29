<?php
namespace App\Model;
use App\Lib\Database;
use App\Http\Response;

class SuperareaModel
{
    private $db;
    private $table = 'super_area';
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

            $stm = $this->db->prepare("SELECT * from $this->table");
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
			$stm = $this->db->prepare("SELECT * from $this->table where id_super_area = ?");
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

}