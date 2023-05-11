<?php
require_once 'Conexion.php';

class Maquinas{
    private $idMaquina;
    private $maquina;
    private $modelo;
    private $estadoM;
    private $sistemasT;

    private CONST TABLA = 'maquinas';

    public function __construct($maquina = null, $modelo = null,$estadoM = null, 
    $sistemasT = null, $idMaquina = null){
        $this->idMaquina = $idMaquina;
        $this->maquina = $maquina;
        $this->modelo = $modelo;
        $this->estadoM = $estadoM;
        $this->sistemasT = $sistemasT;
    }

    public function getIdMaquina(){
        return $this->idMaquina;
    }

    public function getMaquina(){
        return $this->maquina;
    }

    public function getModelo(){
        return $this->modelo;
    }

    public function getEstadoM(){
        return $this->estadoM;
    }

    public function getSistemasT(){
        return $this->sistemasT;
    }

    public function setIdMaquina($idMaquina){
        $this->idMaquina = $idMaquina;
    }

    public function setMaquina($maquina){
        $this->maquina = $maquina;
    }

    public function setModelo($modelo){
        $this->modelo = $modelo;
    }

    public function setEstadoM($estadoM){
        $this->estadoM = $estadoM;
    }

    public function setSistemasT($sistemasT){
        $this->sistemasT = $sistemasT;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idMaquina){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET maquina = :maquina, modelo = :modelo, 
            estadoM = :estadoM, sistemasT = :sistemasT WHERE idMaquina = :idMaquina');
            $query->bindParam(':idMaquina', $this->idMaquina);
            $query->bindParam(':maquina', $this->maquina);
            $query->bindParam(':modelo', $this->modelo);
            $query->bindParam(':estadoM', $this->estadoM);
            $query->bindParam(':sistemasT', $this->sistemasT);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (maquina, 
            modelo, estadoM, sistemasT) VALUES(:maquina, :modelo, :estadoM, :sistemasT)');
            $query->bindParam(':maquina', $this->maquina);
            $query->bindParam(':modelo', $this->modelo);
            $query->bindParam(':estadoM', $this->estadoM);
            $query->bindParam(':sistemasT', $this->sistemasT);
            if($query->execute()){
                $this->idMaquina = $conexion->lastInsertId();
                return true;
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idMaquina = :idMaquina');
        $query->bindParam(':idMaquina', $this->idMaquina);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
        $conexion = null;
    }

    public static function searchById($idMaquina){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT maquina, modelo, estadoM, sistemasT 
        FROM '.self::TABLA.' WHERE idMaquina = :idMaquina');
        $query->bindParam(':idMaquina', $idMaquina);
        $query->execute();
        $row = $query->fetch();
        $conexion = null;
        if($row){
            return new self($row['maquina'], $row['modelo'], $row['estadoM'], $row['sistemasT'], $idMaquina);
        }else{
            return false;
        }
    }

    public static function search($m, $e){
        $conexion = new Conexion();
        if($m != null && $e != null){
            $query = $conexion->prepare("SELECT idMaquina, maquina, modelo, estadoM, sistemasT 
            FROM ".self::TABLA." WHERE concat(maquina,' ',modelo) LIKE '%".$m."%' AND estadoM =".$e." 
            OR maquina LIKE '%".$m."%' AND estadoM = '".$e."' OR modelo LIKE '%".$m."%' AND estadoM = '".$e."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($m != null){
            $query = $conexion->prepare("SELECT idMaquina, maquina, modelo, estadoM, sistemasT 
            FROM ".self::TABLA." WHERE concat(maquina,' ',modelo) LIKE '%".$m."%' 
            OR maquina LIKE '%".$m."%' OR modelo LIKE '%".$m."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($e != null){
            $query = $conexion->prepare("SELECT idMaquina, maquina, modelo, estadoM, sistemasT 
            FROM ".self::TABLA." WHERE concat(maquina,' ',modelo) LIKE '%".$m."%' AND estadoM =".$e." 
            OR maquina LIKE '%".$m."%' AND estadoM = '".$e."' OR modelo LIKE '%".$m."%' AND estadoM = '".$e."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idMaquina, maquina, modelo, estadoM, sistemasT FROM '.self::TABLA);
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }
}

?>