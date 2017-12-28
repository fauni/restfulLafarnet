<?php
namespace App\Model;

use App\Entitie\Publicacion;
use App\Lib\Database;
use App\Lib\Hash;
use App\Http\Response;

class PublicacionModel
{
    private $db;
    private $table = 'publicacion';
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
    }   

	
	public function subir($data){
        try
        {	
        	$tempPath = $_FILES['file']['tmp_name'];
            $actualName = $_FILES['file']['name'];
            $extension = $_FILES['file']['type'];
            //$nuevo_nombre = $actualName;

            $fileName = utf8_decode($_FILES['file']['name']);
            $fileName = explode(".", $fileName);

            $soloNombre = $fileName[0];
            $ext = $fileName[1];

            $nombreModificado = $data["username"]."_".$data["id_area"]."_".date('mdY_His')."_".$soloNombre.".".$ext;
            //$actualPath = dirname(__FILE__)."\\temp\\".$actualName;
            $actualPath = "C:\\xampp\htdocs\\newApiLafarnet\\assets\\publicaciones_images\\".$nombreModificado;
            if (move_uploaded_file($tempPath, $actualPath)) {

                $stm = $this->db->prepare("INSERT INTO publicacion (titulo, nombreAdjunto, usuarioPublicacion, idTipo , fechaPublicacion, fechaCaduca, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion)
values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stm->execute(
                    array(
                        $data['titulo'],
                        $nombreModificado,
                        $data['username'],
                        $data['tipo_publicacion'],
                        date('Y-m-d H:i:s'),
                        $data['fechaCaduca'],
                        1,
                        'faruni',
                        date('Y-m-d H:i:s'),
                        'faruni',
                        date('Y-m-d H:i:s')
                    )
                );

                $this->response->setStatus(200);
                $this->response->message=$this->response->getMessageForCode(200);

            }else{
                $this->response->setStatus(304);
                $this->response->message=$this->response->getMessageForCode(304);
            }
            
            return $this->response;

        } catch(Exception $e){
            $this->response->setStatus($e->getCode());
            $this->response->message=$e->getMessage();
            return $this->response;
        }
    }


}