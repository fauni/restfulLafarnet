<?php
namespace App\Model;

//use App\Entitie\Area;
use App\Lib\Database;
//use App\Lib\Hash;
use App\Http\Response;

class GhHorasExtrasModel
{
    private $db;
    private $table = 'gh_horas_extras';
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

            $stm = $this->db->prepare("SELECT he.id, he.id_dependiente,CONCAT(u.first_name,' ',u.last_name) as nombre_usuario, 
                a.nombre as area, t.turno, he.refrigerio, he.pasajes, he.fecha_inicio, 
                he.hora_inicio, he.hora_fin  from gh_horas_extras he 
                inner join users u on u.username = he.id_dependiente
                inner join areas a on a.id = he.id_area
                inner join gh_turno t on t.id_turno = he.id_turno;");
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

			$stm = $this->db->prepare("SELECT  u.username as id_dependiente, CONCAT(u.first_name, ' ',  u.last_name) as nombre_dependiente, c.nombre_cargo from gh_dependiente_supervisor ds 
                        inner join users u on ds.id_dependiente = u.username
                        inner join cargos c on u.id_cargo = c.id
                        where ds.id_supervisor = 'faruni'; ");
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
            $refrigerio = "false";
            $pasajes = "false";

            if($data['refrigerio']){
                $refrigerio = "true";
            }
            if($data['pasajes']){
                $pasajes = "true";
            }

        	$stm = $this->db->prepare("INSERT INTO gh_horas_extras (id_dependiente, id_area, fecha_inicio, hora_inicio, fecha_fin, hora_fin,
            id_turno, refrigerio, pasajes, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
            $stm->execute(array(
                $data['id_dependiente'],
                $data['id_area'],
                $data['fecha_inicio'],
                $data['hora_inicio'],
                $data['fecha_fin'],
                $data['hora_fin'],
                $data['id_turno'],
                $refrigerio, // $data['refrigerio'],
                $pasajes, // $data['pasajes'],
                1, // $data['estado'],
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