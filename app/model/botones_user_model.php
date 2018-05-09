<?php
namespace App\Model;

use App\Lib\Database;
use App\Lib\Hash;
use App\Http\Response;

class BotonesUserModel
{
    private $db;
    private $table = 'buttons_item_apps';
    private $response;
    
    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
    }
    
   public function GetByUsBtn($user)
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT biau.*,bia.butonName
							from buttons_item_apps bia inner join item_apps ia on bia.itemid = ia.id
						   inner join apps a on a.id = ia.app_id
                           inner join buttons_item_app_users biau on bia.id = biau.buttonid
                           inner join users us on biau.userid = us.userid
					where us.username = ?");
			$stm->execute(array($user));

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

