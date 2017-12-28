<?php


namespace App\Entitie;

class Publicacion {
    
    private $id;
    private $titulo;
    private $nombreAdjunto;
    private $usuarioPublicacion;
    private $idTipo;
    private $fechaPublicacion;
    private $fechaCaduca;
    private $estado;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_modificacion;
    private $fecha_modificacion;
    
    public function __construct() {
        //parent::__construct();
    }


    public function getId(){ return $this->id; }
    public function getTitulo(){ return $this->titulo; }
    public function getNombreAdjunto(){ return $this->nombreAdjunto; }
    public function getUsuarioPublicacion(){ return $this->usuarioPublicacion; }
    public function getIdTipo(){ return $this->idTipo; }
    public function getFechaPublicacion(){ return $this->fechaPublicacion; }
    public function getFechaCaduca(){ return $this->fechaCaduca; }
    public function getEstado(){ return $this->estado; }
    public function getUsuario_creacion(){ return $this->usuario_creacion; }
    public function getFecha_creacion(){ return $this->fecha_creacion; }
    public function getUsuario_modificacion(){ return $this->usuario_modificacion; }
    public function getFecha_modificacion(){ return $this->fecha_modificacion; }

    
    public function setId($id){
        $this->id=$id; 
    }

    public function setTitulo($titulo){
        $this->titulo=$titulo; 
    }

    public function setNombreAdjunto($nombreAdjunto){
        $this->nombreAdjunto=$nombreAdjunto; 
    }

    public function setUsuarioPublicacion($usuarioPublicacion){
        $this->usuarioPublicacion=$usuarioPublicacion; 
    }

    public function setIdTipo($idTipo){
        $this->idTipo=$idTipo; 
    }

    public function setFechaPublicacion($fechaPublicacion){
        $this->fechaPublicacion=$fechaPublicacion; 
    }

    public function setFechaCaduca($fechaCaduca){
        $this->fechaCaduca=$fechaCaduca; 
    }

    public function setEstado($estado){
        $this->estado=$estado; 
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