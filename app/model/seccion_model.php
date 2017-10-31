<?php
namespace App\Model;

use App\Lib\Database;
use App\Lib\Response;

class SeccionModel
{
    private $db;
    private $table = 'seccion';
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
            
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}
    }
    
    public function Get($id)    
    {
		try
		{
			$result = array();

			$stm = $this->db->prepare("SELECT * FROM $this->table WHERE id_seccion = ?");
			$stm->execute(array($id));

			$this->response->setResponse(true);
            $this->response->result = $stm->fetch();
            
            return $this->response;
		}
		catch(Exception $e)
		{
			$this->response->setResponse(false, $e->getMessage());
            return $this->response;
		}  
    }   
    
    public function Insert($data){
        try{
            $sql = "INSERT INTO $this->table
            (id_area, nombre_seccion, codigo_usado, thr, estado_seccion)
            VALUES (?,?,?,?,?)";

            $this->db->prepare($sql)->execute(
                array(
                    $data['id_area'],
                    $data['nombre_seccion'],
                    $data['codigo_usado'],
                    $data['thr'],
                    $data['estado_seccion']
                )
            ); 
            $this->response->setResponse(true, 'Se agrego la nueva Sección!');
            return $this->response;
        } catch(Exception $e){
            $this->response->setResponse(false, $e->getMenssage());
            return $this->response;
        }
    }

    public function Update($data){
        try 
		{
            $sql = "UPDATE $this->table SET 
                        id_area=?, 
                        nombre_seccion=?, 
                        codigo_usado=?, 
                        thr=?, 
                        estado_seccion=?
                    WHERE id_seccion = ?";

            $this->db->prepare($sql)
                ->execute(
                    array(
                        $data['id_area'], 
                        $data['nombre_seccion'],
                        $data['codigo_usado'],
                        $data['thr'],
                        $data['estado_seccion'],
                        $data['id_seccion']
                    )
                );
            $this->response->setResponse(true,"Se modifico correctamente la sección!");
            return $this->response;
		}catch (Exception $e) 
		{
            $this->response->setResponse(false, $e->getMessage());
		}
    }

    public function Delete($id)
    {
		try 
		{
			$stm = $this->db
			            ->prepare("DELETE FROM $this->table WHERE id_seccion = ?");			          

			$stm->execute(array($id));
            
			$this->response->setResponse(true);
            return $this->response;
		} catch (Exception $e) 
		{
			$this->response->setResponse(false, $e->getMessage());
		}
    }
}