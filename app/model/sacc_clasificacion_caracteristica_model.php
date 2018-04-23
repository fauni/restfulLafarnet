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
     public function GetAlljoinCFAQCM() //obtiene todos los registros de clasificacion_caracteristica conbinado con las tablas Control Fisico, Analisis Quimico y Control Microbiologico
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("select ifnull(pe.id_clasificacion_caracteristica,0) as id_clasificacion_caracteristica,ifnull(pe.id_tipo_clasificacion,'Z') as id_tipo_clasificacion,ifnull(pe.tipo_caracteristica,'CF') as tipo_caracteristica, ifnull(pe.estado,-1) as estado_clasif_carac,cf.id_caracteristicas_fisicas,cf.descripcion,cf.tipo, cf.estado as estado_caracteristica, pe.usuario_creacion, pe.fecha_creacion, pe.usuario_modificacion, pe.fecha_modificacion
from (select * from sacc_clasificacion_caracteristicas where tipo_caracteristica = 'CF') pe right outer join sacc_productos_caracteristicas_fisicas cf on pe.id_caracteristica = cf.id_caracteristicas_fisicas
where cf.estado = 1
union
select ifnull(pe2.id_clasificacion_caracteristica,0) as id_clasificacion_caracteristica,ifnull(pe2.id_tipo_clasificacion,'Z') as id_tipo_clasificacion,ifnull(pe2.tipo_caracteristica,'AQ') as tipo_caracteristica, ifnull(pe2.estado,-1) as estado_clasif_carac,aq.id_analisis_quimico ,aq.descripcion,aq.tipo, aq.estado as estado_caracteristica,pe2.usuario_creacion, pe2.fecha_creacion, pe2.usuario_modificacion, pe2.fecha_modificacion
from (select * from sacc_clasificacion_caracteristicas where tipo_caracteristica = 'AQ') pe2 right join sacc_productos_analisis_quimico aq on pe2.id_caracteristica = aq.id_analisis_quimico
where aq.estado = 1
union
select ifnull(pe3.id_clasificacion_caracteristica,0) as id_clasificacion_caracteristica,ifnull(pe3.id_tipo_clasificacion,'Z') as id_tipo_clasificacion,ifnull(pe3.tipo_caracteristica,'CM') as tipo_caracteristica, ifnull(pe3.estado,-1) as estado_clasif_carac,cm.id_analisis_microbiologico ,cm.descripcion,cm.tipo, cm.estado as estado_caracteristica, pe3.usuario_creacion, pe3.fecha_creacion, pe3.usuario_modificacion, pe3.fecha_modificacion
from (select * from sacc_clasificacion_caracteristicas where tipo_caracteristica = 'CM') pe3 right outer join sacc_productos_analisis_microbiologico cm on pe3.id_caracteristica = cm.id_analisis_microbiologico
where cm.estado = 1;
");
            $stm->execute(array());
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