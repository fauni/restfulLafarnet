<?php
namespace App\Model;

use App\Lib\DatabaseMSS;
use App\Lib\Response;

class ProductosModel
{
    private $db;
    private $table = 'apps';
    private $response;
    
    public function __CONSTRUCT()
    {
        $this->db = DatabaseMSS::StartUp();
        $this->response = new Response();
    }
    
    public function GetAll()
    {
		try
		{
			$result = array();
			$sql= "SELECT T0.[ItemCode], T0.[ItemName], T0.[U_Presentacion], T1.Name as Forma_Farmaceutica FROM OITM T0 inner join [dbo].[@FORMA_FARMACEUTICA] T1 ON T0.U_FormaFarmaceutica=T1.Code WHERE T0.[ItemCode]='PT010005'";
			$stm = mssql_query($sql);

            
			$this->response->setResponse(true);
            $this->response->result = '';//$stm->fetchAll();
            $this->response->message = $stm;//"Se obtuvieron ".$stm->rowCount()." registros";
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }
}