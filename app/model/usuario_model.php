<?php
    namespace App\Model;

    use App\Entitie\Usuario;
    use App\Lib\Database;
    use App\Lib\Hash;
    use App\Http\Response;

    class UsuarioModel{
        private $db;
        private $table = 'users';
        private $response;
        private $usuario;
        
        public function __CONSTRUCT()
        {
            $this->db = Database::StartUp();
            $this->response = new Response();
            $this->usuario = new Usuario();
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

                $stm = $this->db->prepare("SELECT * FROM $this->table WHERE username = ?");
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

                $this->response->setStatus(404);
                $this->response->setBody($dataUser);
                $this->response->message=$this->response->getMessageForCode(404);
                $this->response->length($count);
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