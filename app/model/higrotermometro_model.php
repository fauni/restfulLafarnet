<?php
namespace App\Model;
use App\Lib\Database;
use App\Http\Response;

class HigrotermometroModel
{
    private $db;
    private $table = 'higrotermometro';
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

            $stm = $this->db->prepare("SELECT * from higrotermometro");
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
			$stm = $this->db->prepare("SELECT * from higrotermometro where id_seccion=?");
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