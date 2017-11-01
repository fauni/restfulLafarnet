<?php
    namespace App\Model;

    use App\Entitie\Usuario;
    use App\Lib\Database;
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
    }
?>