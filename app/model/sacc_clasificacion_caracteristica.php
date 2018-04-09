<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class ClasificacionCaracteristicaModel
{
    private $db;
    private $table = 'sacc_clasificacion_caracteristicas';
    private $response;
    
    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
    }
    
    public function GetByTipoClasificacion($id) //obtiene por el tipo de clasificacion A, B, C.... 
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT * FROM sacc_clasificacion_caracteristicas
                                        WHERE id_tipo_clasificacion = ? ;");
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