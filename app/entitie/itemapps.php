<?php

namespace App\Entitie;

class ItemApps {
    
    private $id;
    private $url;
    private $icon;
    private $app_id;
    private $itemName;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_modificacion;
    private $fecha_modificacion;
    
    
    public function __construct() {
        //parent::__construct();
    }

	public function getId(){ return $this->id; }
	public function getUrl(){ return $this->url; }
	public function getIcon(){ return $this->icon; }
	public function getApp_id(){ return $this->app_id; }
	public function getItemName(){ return $this->itemName; }
	public function getUsuario_creacion(){ return $this->usuario_creacion; }
	public function getFecha_creacion(){ return $this->fecha_creacion; }
	public function getUsuario_modificacion(){ return $this->usuario_modificacion; }
	public function getFecha_modificacion(){ return $this->fecha_modificacion; }

	public function setId($id){ $this->id=$id; }
	public function setUrl($url){ $this->url=$url; }
	public function setIcon($icon){ $this->icon=$icon; }
	public function setApp_id($app_id){ $this->app_id=$app_id; }
	public function setItemName($itemName){ $this->itemName=$itemName; }
	public function setUsuario_creacion($usuario_creacion){ $this->usuario_creacion=$usuario_creacion; }
	public function setFecha_creacion($fecha_creacion){ $this->fecha_creacion=$fecha_creacion; }
	public function setUsuario_modificacion($usuario_modificacion){ $this->usuario_modificacion=$usuario_modificacion; }
	public function setFecha_modificacion($fecha_modificacion){ $this->fecha_modificacion=$fecha_modificacion; }

}


?>