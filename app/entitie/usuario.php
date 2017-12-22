<?php

namespace App\Entitie;

class Usuario {
    
    private $userid;
    private $first_name;
    private $last_name;
    private $email_address;
    private $position;
    private $department;
    private $username;
    private $password;
    private $last_loggedin;
    private $user_level;
    private $nivel;
    private $forgot;
    private $status;
    private $id_regional;
    private $nivel_permisos;
    private $id_superior;
    private $id_area;
    private $id_foto;
    private $estado_user;
    private $usuario_creacion;
    private $fecha_creacion;
    private $usuario_modificacion;
    private $fecha_modificacion;

    
    
    public function __construct() {
        //parent::__construct();
    }

    public function getUserid(){ return $this->userid; }
    public function getFirst_name(){ return $this->first_name; }
    public function getLast_name(){ return $this->last_name; }
    public function getEmail_address(){ return $this->email_address; }
    public function getPosition(){ return $this->position; }
    public function getDepartment(){ return $this->department; }
    public function getUsername(){ return $this->username; }
    public function getPassword(){ return $this->password; }
    public function getLast_loggedin(){ return $this->last_loggedin; }
    public function getUser_level(){ return $this->user_level; }
    public function getNivel(){ return $this->nivel; }
    public function getForgot(){ return $this->forgot; }
    public function getStatus(){ return $this->status; }
    public function getId_regional(){ return $this->id_regional; }
    public function getNivel_permisos(){ return $this->nivel_permisos; }
    public function getId_superior(){ return $this->id_superior; }
    public function getEstado_user(){ return $this->estado_user; }
    public function getusuario_creacion(){ return $this->usuario_creacion; }
    public function getfecha_creacion(){ return $this->fecha_creacion; }
    public function getusuario_modificacion(){ return $this->usuario_modificacion; }
    public function getfecha_modificacion(){ return $this->fecha_modificacion; }

    public function setUserid($userid){ 
        $this->userid=$userid; 
    }

    public function setFirst_name($first_name){ 
        $this->first_name=$first_name; 
    }

    public function setLast_name($last_name){ 
        $this->last_name=$last_name; 
    }

    public function setEmail_address($email_address){ 
        $this->email_address=$email_address; 
    }

    public function setPosition($position){ 
        $this->position=$position; 
    }

    public function setDepartment($department){ 
        $this->department=$department; 
    }

    public function setUsername($username){ 
        $this->username=$username; 
    }

    public function setPassword($password){ 
        $this->password=$password; 
    }

    public function setLast_loggedin($last_loggedin){ 
        $this->last_loggedin=$last_loggedin; 
    }

    public function setUser_level($user_level){ 
        $this->user_level=$user_level; 
    }

    public function setNivel($nivel){ 
        $this->nivel=$nivel; 
    }

    public function setForgot($forgot){ 
        $this->forgot=$forgot; 
    }

    public function setStatus($status){ 
        $this->status=$status; 
    }

    public function setId_regional($id_regional){ 
        $this->id_regional=$id_regional; 
    }

    public function setNivel_permisos($nivel_permisos){ 
        $this->nivel_permisos=$nivel_permisos; 
    }

    public function setId_superior($id_superior){ 
        $this->id_superior=$id_superior; 
    }

    public function setId_area($id_area){ 
        $this->id_area=$id_area; 
    }

    public function setId_foto($id_foto){ 
        $this->id_foto=$id_foto; 
    }

    public function setEstado_user($estado_user){ 
        $this->estado_user=$estado_user; 
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