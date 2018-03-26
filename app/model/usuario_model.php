<?php

namespace App\Model;

use App\Entitie\Usuario;
use App\Lib\Database;
use App\Lib\Hash;
use App\Lib\Comunes;
use App\Http\Response;

class UsuarioModel{
    private $db;
    private $table = 'users';
    private $response;
    private $usuario;
    private $comunes;
    
    public function __CONSTRUCT()
    {
        $this->db = Database::StartUp();
        $this->response = new Response();
        $this->usuario = new Usuario();
        $this->comunes = new Comunes();
    }

    public function GetAll()
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT u.first_name, u.last_name, u.email_address, u.username, u.password, u.id_cargo, c.nombre_cargo as cargo, 
u.id_regional, r.nombre as regional, u.id_grupo, u.id_area, a.nombre as area, u.foto, u.estado, e.nombre_estado
from users u inner join cargos c on u.id_cargo= c.id inner join regional r on u.id_regional=r.id inner join areas a 
on u.id_area=a.id inner join estados e on u.estado = e.id");
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

    public function Get($username)
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT u.first_name, u.last_name, u.email_address, u.username, u.password, u.id_cargo, c.nombre_cargo as cargo, 
u.id_regional, r.nombre as regional, u.id_grupo, u.id_area, a.nombre as area, u.foto, u.estado, e.nombre_estado
from users u inner join cargos c on u.id_cargo= c.id inner join regional r on u.id_regional=r.id inner join areas a 
on u.id_area=a.id inner join estados e on u.estado = e.id where u.username=?");
            $stm->execute(array($username));

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

    public function GetForEmail($email)
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT * from users where email_address=? and estado=1;");
            $stm->execute(array($email));

            $count = $stm->rowCount();

            if ($count>0) {
                $this->response->setStatus(200);
                $this->response->setBody($stm->fetchAll());
                $this->response->message=$this->response->getMessageForCode(200);
            } else {
                $this->response->setStatus(404);
                $this->response->setBody($stm->fetchAll());
                $this->response->message=$this->response->getMessageForCode(404);
            }
            
            
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
            $tempPath = $_FILES['fileImagen']['tmp_name'];
            $actualName = $_FILES['fileImagen']['name'];
            $extension = $_FILES['fileImagen']['type'];
            //$nuevo_nombre = $actualName;

            $fileName = utf8_decode($_FILES['fileImagen']['name']);
            $fileName = explode(".", $fileName);

            $soloNombre = $fileName[0];
            $ext = $fileName[1];

            //$actualPath = dirname(__FILE__)."\\temp\\".$actualName;
            $actualPath = "C:\\xampp\htdocs\\newApiLafarnet\\assets\\imagenes_users\\".$data['foto'];
            
            if (move_uploaded_file($tempPath, $actualPath)) {

                $stm = $this->db->prepare("INSERT INTO users (first_name, last_name, email_address, username, password, id_cargo, id_regional, id_grupo, id_superior, id_area, id_seccion, foto, estado, usuario_creacion, fecha_creacion, usuario_modificacion, fecha_modificacion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
                $stm->execute(
                    array(
                        $data['first_name'], 
                        $data['last_name'], 
                        $data['email_address'], 
                        $data['username'], 
                        Hash::create('sha256', $data['password'], 'n4d43sm4s1mp0rt4nt4qu3sus4lud'),
                        $data['id_cargo'], 
                        $data['id_regional'], 
                        $data['id_grupo'], 
                        $data['id_superior'], 
                        $data['id_area'], 
                        $data['id_seccion'], 
                        $data['foto'], 
                        $data['estado'],
                        $data['usuario_modificacion'],
                        date('Y-m-d H:i:s'),
                        $data['usuario_creacion'],
                        date('Y-m-d H:i:s')
                    )
                );
                $this->response->setBody($data);
                $this->response->setStatus(201);
                $this->response->message=$this->response->getMessageForCode(201);

            } else{
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

    public function updateImage($data){
        try
        {   
            $tempPath = $_FILES['fileImagen']['tmp_name'];
            $actualName = $_FILES['fileImagen']['name'];
            $extension = $_FILES['fileImagen']['type'];
            //$nuevo_nombre = $actualName;

            $fileName = utf8_decode($_FILES['fileImagen']['name']);
            $fileName = explode(".", $fileName);

            $soloNombre = $fileName[0];
            $ext = $fileName[1];

            //$actualPath = dirname(__FILE__)."\\temp\\".$actualName;
            $actualPath = "C:\\xampp\htdocs\\newApiLafarnet\\assets\\imagenes_users\\".$data['username'].'.'.$ext; // Ruta Xampp
            //$actualPath = "/var/www/html/newApiLafarnet/assets/imagenes_users/".$data['foto']; // Ruta Server Centos
            
            if (move_uploaded_file($tempPath, $actualPath)) {
                $stm = $this->db->prepare("UPDATE users set foto = ? where username= ?;");
                $stm->execute(
                    array(
                        $data['username'].'.'.$ext, 
                        $data['username'], 
                    )
                );
                $this->response->setBody($data);
                $this->response->setStatus(201);
                $this->response->message=$this->response->getMessageForCode(201);

            } else{
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

    public function updateInformationGeneral($data){
        //print_r ($data);
        try
        {   
            $stm = $this->db->prepare("UPDATE users SET first_name=?, last_name=?, email_address=?, usuario_modificacion=?, fecha_modificacion=? WHERE username=?");
            $stm->execute(
                array(
                    $data['first_name'],
                    $data['last_name'],
                    $data['email_address'],
                    $data['usuario_modificacion'],
                    date('Y-m-d H:i:s'),
                    $data['username']
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

    public function DeleteUser($data){
        print_r ($data);
        /*try
        {   
            $stm = $this->db->prepare("UPDATE users SET estado= 3, usuario_modificacion=?, fecha_modificacion=? WHERE username=?");
            $stm->execute(
                array(
                    $data['usuario_modificacion'],
                    date('Y-m-d H:i:s'),
                    $data['username']
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
        }*/
    }

    public function updateInformationLaboral($data){
        //print_r ($data);
        try
        {
            $stm = $this->db->prepare("UPDATE users SET id_cargo=?, id_regional=?, id_area= ?, usuario_modificacion=?, fecha_modificacion=? WHERE username=?");
            $stm->execute(
                array(
                    $data['id_cargo'],
                    $data['id_regional'],
                    $data['id_area'],
                    $data['usuario_modificacion'],
                    date('Y-m-d H:i:s'),
                    $data['username']
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

    public function changePassword($data){
        try
        {   
            $stm = $this->db->prepare("UPDATE users SET password=?, estado=?, usuario_modificacion=?, fecha_modificacion=? WHERE username = ?");
            $stm->execute(
                array(
                    Hash::create('sha256', $data['password'], 'n4d43sm4s1mp0rt4nt4qu3sus4lud'),
                    1,
                    $data['usernameUpdate'],
                    date('Y-m-d H:i:s'),
                    $data['username']
                )
            );

            $this->response->setStatus(200);
            $this->response->message=$this->response->getMessageForCode(200);
            return $this->response;

        } catch(Exception $e){
            $this->response->setStatus($e->getCode());
            $this->response->message=$e->getMessage();
            return $this->response;
        }
    }

    public function changePasswordForUser($data){
        try
        {   
            $stm = $this->db->prepare("UPDATE users SET password=?, estado=?, usuario_modificacion=?, fecha_modificacion=? WHERE username = ?");
            $stm->execute(
                array(
                    Hash::create('sha256', $data['password'], 'n4d43sm4s1mp0rt4nt4qu3sus4lud'),
                    1,
                    $data['username'],
                    date('Y-m-d H:i:s'),
                    $data['username']
                )
            );

            $this->response->setStatus(200);
            $this->response->message=$this->response->getMessageForCode(200);
            return $this->response;

        } catch(Exception $e){
            $this->response->setStatus($e->getCode());
            $this->response->message=$e->getMessage();
            return $this->response;
        }
    }

    public function RecoveryByEmail($data){
        try{
            if ($this->comunes->sendMail($data)==1) {
                $this->response->setStatus(202);
                $this->response->message=$this->response->getMessageForCode(202);   
            }
            else{
                $this->response->setStatus(203);
                $this->response->message=$this->response->getMessageForCode(203);   
            }
        } catch(Exception $e){
            $this->response->setResponse(false, $e->getMenssage());
        }
        return $this->response;
    }

    public function Login($data){
        try{


            $stm= $this->db->prepare("SELECT u.first_name, u.last_name, u.email_address, u.username, u.password, u.id_cargo, c.nombre_cargo as cargo, 
u.id_regional, r.nombre as regional, u.id_grupo, u.id_area, a.nombre as area, u.foto, u.estado, e.nombre_estado
from users u inner join cargos c on u.id_cargo= c.id inner join regional r on u.id_regional=r.id inner join areas a 
on u.id_area=a.id inner join estados e on u.estado = e.id where u.username=? and u.password=?");

            //$stm = $this->db->prepare("SELECT * FROM users as u inner join super_area sa on u.id_area = sa.id_super_area where u.username = ? AND u.password= ?");
            $stm->execute(
                array(
                    $data['userid'],
                    Hash::create('sha256', $data['password'], 'n4d43sm4s1mp0rt4nt4qu3sus4lud')
                )
            );
            $dataUser = $stm->fetchAll();
            $count = $stm->rowCount();

//Logica de AUtentificación y Autorización
            if ($count == 1) {
                $this->response->setStatus(202);
                $this->response->setBody($dataUser);
                $this->response->message=$this->response->getMessageForCode(202);
                $this->response->length($count);
            } else {
                $this->response->setStatus(404);
                $this->response->setBody($dataUser);
                $this->response->message=$this->response->getMessageForCode(404);
                $this->response->length($count);
            }

        //End Logica de Autorización y Autentificación
            return $this->response;

        } catch(Exception $e){
            $this->response->setResponse(false, $e->getMenssage());
            return $this->response;
        }
    }

    public function GetApps($data)
    {
        try
        {
            $result = array();

            $stm = $this->db->prepare("SELECT a.appname, a.code,  a.url, a.appdescription, appicon from usersapps ua 
                            inner join users u on u.userid=ua.userid inner join apps a on ua.appid= a.id where u.username = ?");

            $stm->execute(
                array(
                    $data['username']
                )
            );
            
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
}
?>