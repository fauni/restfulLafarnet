<?php

namespace App\Entitie;

class Apps {
    
    private $id;
    private $code;
    private $url;
    private $appname;
    private $appdescription;
    private $appicon;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_modificacion;
    private $fecha_modificacion;
    
    
    public function __construct() {
        //parent::__construct();
    }

    public function getid(){ return $this->id; }
    public function getcode(){ return $this->code; }
    public function geturl(){ return $this->url; }
    public function getappname(){ return $this->appname; }
    public function getappdescription(){ return $this->appdescription; }
    public function getappicon(){ return $this->appicon; }
    public function getusuario_creacion(){ return $this->usuario_creacion; }
    public function getfecha_creacion(){ return $this->fecha_creacion; }
    public function getusuario_modificacion(){ return $this->usuario_modificacion; }
    public function getfecha_modificacion(){ return $this->fecha_modificacion; }

    public function setId($id){ 
        $this->id=$id; 
    }

    public function setCode($code){ 
        $this->code=$code; 
    }

    public function setUrl($url){ 
        $this->url=$url; 
    }

    public function setAppname($appname){ 
        $this->appname=$appname; 
    }

    public function setAppdescription($appdescription){ 
        $this->appdescription=$appdescription; 
    }

    public function setAppicon($appicon){ 
        $this->appicon=$appicon; 
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