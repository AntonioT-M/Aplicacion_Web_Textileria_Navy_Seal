<?php
require_once 'Conexion.php';

class Administradores{
    private $idAdministrador;
    private $nombreAdmin;
    private $apellidosAdmin;
    private $cargo;
    private $nickAdmin;
    private $passwordAdmin;
    private $privilegiosAdmin;

    private CONST TABLA = 'administradores';

    public function __construct($nombreAdmin = null, $apellidosAdmin = null, $cargo = null, $nickAdmin = null, 
    $passwordAdmin = null, $privilegiosAdmin = null, $idAdministrador = null){
        $this->idAdministrador = $idAdministrador;
        $this->nombreAdmin = $nombreAdmin;
        $this->apellidosAdmin = $apellidosAdmin;
        $this->cargo = $cargo;
        $this->nickAdmin = $nickAdmin;
        $this->passwordAdmin = $passwordAdmin;
        $this->privilegiosAdmin = $privilegiosAdmin;
    }

    public function getIdAdministrador(){
        return $this->idAdministrador;
    }

    public function getNombreAdmin(){
        return $this->nombreAdmin;
    }

    public function getApellidosAdmin(){
        return $this->apellidosAdmin;
    }

    public function getCargo(){
        return $this->cargo;
    }

    public function getNickAdmin(){
        return $this->nickAdmin;
    }

    public function getPasswordAdmin(){
        return $this->passwordAdmin;
    }

    public function getPrivilegiosAdmin(){
        return $this->privilegiosAdmin;
    }

    public function setIdAdminnistrador($idAdministrador){
        $this->idAdministrador = $idAdministrador;
    }

    public function setNombreAdmin($nombreAdmin){
        $this->nombreAdmin = $nombreAdmin;
    }

    public function setApellidosAdmin($apellidosAdmin){
        $this->apellidosAdmin = $apellidosAdmin;
    }

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    public function setNickAdmin($nickAdmin){
        $this->nickAdmin = $nickAdmin;
    }

    public function setPasswordAdmin($passwordAdmin){
        $this->passwordAdmin = $passwordAdmin;
    }

    public function setPrivilegiosAdmin($privilegiosAdmin){
        $this->privilegiosAdmin = $privilegiosAdmin;
    }

    public function save(){
        $conexion =  new Conexion();
        if($this->idAdministrador){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET nombreAdmin = :nombreAdmin, 
            apellidosAdmin = :apellidosAdmin, cargo = :cargo, nickAdmin = :nickAdmin, 
            passwordAdmin = :passwordAdmin, privilegiosAdmin = :privilegiosAdmin 
            WHERE idAdministrador = :idAdministrador');
            $query->bindParam(':idAdministrador', $this->idAdministrador);
            $query->bindParam(':nombreAdmin', $this->nombreAdmin);
            $query->bindParam(':apellidosAdmin', $this->apellidosAdmin);
            $query->bindParam(':cargo', $this->cargo);
            $query->bindParam(':nickAdmin', $this->nickAdmin);
            $query->bindParam(':passwordAdmin', $this->passwordAdmin);
            $query->bindParam(':privilegiosAdmin', $this->privilegiosAdmin);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (nombreAdmin, apellidosAdmin, 
            cargo, nickAdmin, passwordAdmin, privilegiosAdmin) VALUES(:nombreAdmin, :apellidosAdmin, 
            :cargo, :nickAdmin, :passwordAdmin, :privilegiosAdmin)');
            $query->bindParam(':nombreAdmin', $this->nombreAdmin);
            $query->bindParam(':apellidosAdmin', $this->apellidosAdmin);
            $query->bindParam(':cargo', $this->cargo);
            $query->bindParam(':nickAdmin', $this->nickAdmin);
            $query->bindParam(':passwordAdmin', $this->passwordAdmin);
            $query->bindParam(':privilegiosAdmin', $this->privilegiosAdmin);
            if($query->execute()){
                $this->idAdministrador = $conexion->lastInsertId();
                return true;
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idAdministrador = :idAdministrador');
        $query->bindParam(':idAdministrador', $this->idAdministrador);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
        $conexion = null;
    }

    public static function searchById($idAdministrador){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT nombreAdmin, apellidosAdmin, cargo, nickAdmin, 
        passwordAdmin, privilegiosAdmin FROM '.self::TABLA.' WHERE idAdministrador = :idAdministrador');
        $query->bindParam(':idAdministrador', $idAdministrador);
        $query->execute();
        $row = $query->fetch();
        $conexion = null;
        if($row){
            return new self($row['nombreAdmin'], 
            $row['apellidosAdmin'], $row['cargo'], $row['nickAdmin'], $row['passwordAdmin'], 
            $row['privilegiosAdmin'], $idAdministrador);
        }else{
            return false;
        }
    }

    public static function search($s, $c){
        $conexion = new Conexion();
        if($s != null && $c != null){
            $query = $conexion->prepare("SELECT idAdministrador, nombreAdmin, apellidosAdmin, 
            cargo, nickAdmin, passwordAdmin, privilegiosAdmin FROM ".self::TABLA." WHERE 
            concat(nombreAdmin,' ',apellidosAdmin) LIKE '%".$s."%' AND cargo = '".$c."' 
            OR nombreAdmin LIKE '%".$s."%' AND cargo = '".$c."' OR apellidosAdmin LIKE '%".$s."%' 
            AND cargo = '".$c."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($s != null){
            $query = $conexion->prepare("SELECT idAdministrador, nombreAdmin, apellidosAdmin, 
            cargo, nickAdmin, passwordAdmin, privilegiosAdmin FROM ".self::TABLA." WHERE 
            concat(nombreAdmin,' ',apellidosAdmin) LIKE '%".$s."%' OR nombreAdmin LIKE '%".$s."%' 
            OR apellidosAdmin LIKE '%".$s."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($c != null){
            $query = $conexion->prepare("SELECT idAdministrador, nombreAdmin, apellidosAdmin, 
            cargo, nickAdmin, passwordAdmin, privilegiosAdmin FROM ".self::TABLA." WHERE 
            cargo LIKE '%".$c."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
        $conexion = null;
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idAdministrador, nombreAdmin, apellidosAdmin, cargo, 
        nickAdmin, passwordAdmin, privilegiosAdmin FROM '.self::TABLA);
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }

    public function login(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT nombreAdmin, apellidosAdmin, cargo, nickAdmin, 
        privilegiosAdmin FROM '.self::TABLA.' WHERE nickAdmin = :nickAdmin AND passwordAdmin = :passwordAdmin');
        $query->bindParam(':nickAdmin', $this->nickAdmin);
        $query->bindParam(':passwordAdmin', $this->passwordAdmin);
        $query->execute();
        $conexion = null;
        $row = $query->fetch();
        if($row){
            $_SESSION['nombre'] = $row[0];
            $_SESSION['apellidos'] = $row[1];
            $_SESSION['nick'] = $row[2];
            $_SESSION['x'] = $row[3];
            $_SESSION['privilegios'] = $row[4];
            return true;
        }else{
            return false;
        }
    }
}

?>