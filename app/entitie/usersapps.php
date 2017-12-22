<?php

namespace App\Entitie;

class UsersApps {
    
    private $id;
    private $userid;
    private $appid;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_modificacion;
    private $fecha_modificacion;
    
    
    public function __construct() {
        //parent::__construct();
    }

    public function getid(){ return $this->id; }
    public function getuserid(){ return $this->userid; }
    public function getappid(){ return $this->appid; }
    public function getusuario_creacion(){ return $this->usuario_creacion; }
    public function getfecha_creacion(){ return $this->fecha_creacion; }
    public function getusuario_modificacion(){ return $this->usuario_modificacion; }
    public function getfecha_modificacion(){ return $this->fecha_modificacion; }

    public function setId($id){ 
        $this->id=$id; 
    }

    public function setUserId($userid){ 
        $this->userid=$userid; 
    }

    public function setAppId($appid){ 
        $this->appid=$appid; 
    }

    public function setUsuario_creacion($usuario_creacion){ 
        $this->usuario_creacion=$usuario_creacion; 
    }

    public function setFecha_creacion($fecha_creacion){ 
        $this->fecha_creacion=$fecha_creacion; 
    }

    public function setUsuario_modificacion($usuario_modificacion){ 
        $this->usuario_modificacion=$usuario_modificacion; 
    }

    public function setFecha_modificacion($fecha_modificacion){ 
        $this->fecha_modificacion=$fecha_modificacion; 
    }
}


?>