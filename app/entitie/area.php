<?php

namespace App\Entitie;

class Area {
    
    private $id;
	private $nombre;
	private $id_super_area;
	private $estado;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_modificacion;
    private $fecha_modificacion;
    
    public function __construct() {
        //parent::__construct();
    }

	public function getId(){ return $this->id;}
	public function getNombre(){ return $this->nombre;}
	public function getId_super_area(){ return $this->id_super_area;}
	public function getEstado(){ return $this->estado;}
    public function getUsuario_creacion(){ return $this->usuario_creacion;}
    public function getFecha_creacion(){ return $this->fecha_creacion;}
    public function getUsuario_modificacion(){ return $this->usuario_modificacion;}
    public function getFecha_modificacion(){ return $this->fecha_modificacion;}


    public function setId($id){
    	$this->id = $id;
    }
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setId_super_area($id_super_area){
		$this->id_super_area = $id_super_area;
	}
	public function setEstado($estado){
		$this->estado = $estado;
	}

    public function setUsuario_creacion($usuario_creacion){ 
        $this->usuario_creacion = $usuario_creacion;
    }
    public function setFecha_creacion($fecha_creacion){ 
        $this->fecha_creacion = $fecha_creacion;
    }
    public function setUsuario_modificacion($usuario_modificacion){ 
        $this->usuario_modificacion = $usuario_modificacion;
    }
    public function setFecha_modificacion($fecha_modificacion){ 
        $this->fecha_modificacion = $fecha_modificacion;
    }
}


?>