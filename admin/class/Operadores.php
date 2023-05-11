<?php
require_once 'Conexion.php';

class Operadores{
    private $idOperador;
    private $nombreOperador;
    private $apellidosOperador;
    private $turnoOperador;
    private $nickOperador;
    private $passwordOperador;
    private $privilegiosOperador;

    private CONST TABLA = 'operadores';

    public function __construct($nombreOperador = null, $apellidosOperador = null, $turnoOperador = null,
    $nickOperador = null, $passwordOperador = null, $privilegiosOperador = null, $idOperador = null){
        $this->idOperador = $idOperador;
        $this->nombreOperador = $nombreOperador;
        $this->apellidosOperador = $apellidosOperador;
        $this->turnoOperador = $turnoOperador;
        $this->nickOperador = $nickOperador;
        $this->passwordOperador = $passwordOperador;
        $this->privilegiosOperador = $privilegiosOperador;
    }

    public function getIdOperador(){
        return $this->idOperador;
    }

    public function getNombreOperador(){
        return $this->nombreOperador;
    }

    public function getApellidosOperador(){
        return $this->apellidosOperador;
    }

    public function getTurnoOperador(){
        return $this->turnoOperador;
    }

    public function getNickOperador(){
        return $this->nickOperador;
    }

    public function getPasswordOperador(){
        return $this->passwordOperador;
    }

    public function getPrivilegiosOperador(){
        return $this->privilegiosOperador;
    }

    public function setIdOperador($idOperador){
        $this->idOperador = $idOperador;
    }

    public function setNombreOperador($nombreOperador){
        $this->nombreOperador = $nombreOperador;
    }

    public function setApellidosOperador($apellidosOperador){
        $this->apellidosOperador = $apellidosOperador;
    }

    public function setTurnoOperador($turnoOperador){
        $this->turnoOperador = $turnoOperador;
    }

    public function setNickOperador($nickOperador){
        $this->nickOperador = $nickOperador;
    }

    public function setPasswordOperador($passwordOperador){
        $this->passwordOperador = $passwordOperador;
    }

    public function setPrivilegiosOperador($privilegiosOperador){
        $this->privilegiosOperador = $privilegiosOperador;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idOperador){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET nombreOperador = :nombreOperador, 
            apellidosOperador = :apellidosOperador, turnoOperador = :turnoOperador, nickOperador = :nickOperador,
            passwordOperador = :passwordOperador, privilegiosOperador = :privilegiosOperador 
            WHERE idOperador = :idOperador');
            $query->bindParam(':idOperador', $this->idOperador);
            $query->bindParam(':nombreOperador', $this->nombreOperador);
            $query->bindParam(':apellidosOperador', $this->apellidosOperador);
            $query->bindParam(':turnoOperador', $this->turnoOperador);
            $query->bindParam(':nickOperador', $this->nickOperador);
            $query->bindParam(':passwordOperador', $this->passwordOperador);
            $query->bindParam(':privilegiosOperador', $this->privilegiosOperador);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (nombreOperador, 
            apellidosOperador, turnoOperador, nicKOperador, passwordOperador, privilegiosOperador) 
            VALUES(:nombreOperador, :apellidosOperador, :turnoOperador, :nickOperador, :passwordOperador,
            :privilegiosOperador)');
            $query->bindParam(':nombreOperador', $this->nombreOperador);
            $query->bindParam(':apellidosOperador', $this->apellidosOperador);
            $query->bindParam(':turnoOperador', $this->turnoOperador);
            $query->bindParam(':nickOperador', $this->nickOperador);
            $query->bindParam(':passwordOperador', $this->passwordOperador);
            $query->bindParam(':privilegiosOperador', $this->privilegiosOperador);
            if($query->execute()){
                $this->idOperador = $conexion->lastInsertId();
                return true;
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idOperador = :idOperador');
        $query->bindParam(':idOperador', $this->idOperador);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
        $conexion = null;
    }

    public static function searchById($idOperador){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT nombreOperador, apellidosOperador, 
        turnoOperador, nickOperador, passwordOperador, privilegiosOperador FROM '.self::TABLA.' 
        WHERE idOperador = :idOperador');
        $query->bindParam(':idOperador', $idOperador);
        $query->execute();
        $conexion = null;
        $row = $query->fetch();
        if($row){
            return new self($row['nombreOperador'], 
            $row['apellidosOperador'], $row['turnoOperador'], $row['nickOperador'],
            $row['passwordOperador'], $row['privilegiosOperador'], $idOperador);
        }else{
            return false;
        }
    }

    public static function search($s, $t){
        $conexion = new Conexion();
        if($s != null && $t != null){
            $query = $conexion->prepare("SELECT idOperador, nombreOperador, apellidosOperador, 
            turnoOperador, nickOperador, passwordOperador, privilegiosOperador FROM ".self::TABLA." 
            WHERE concat(nombreOperador,' ',apellidosOperador) LIKE '%".$s."%' 
            AND turnoOperador = '".$t."' OR nombreOperador LIKE '%".$s."%' AND turnoOperador = '".$t."'
            OR apellidosOperador LIKE '%".$s."%' AND turnoOperador = '".$t."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($s != null){
            $query = $conexion->prepare("SELECT idOperador, nombreOperador, apellidosOperador, 
            turnoOperador, nickOperador, passwordOperador, privilegiosOperador FROM ".self::TABLA." 
            WHERE concat(nombreOperador,' ',apellidosOperador) LIKE '%".$s."%' 
            OR nombreOperador LIKE '%".$s."%' OR apellidosOperador LIKE '%".$s."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($t != null){
            $query = $conexion->prepare("SELECT idOperador, nombreOperador, apellidosOperador, 
            turnoOperador, nickOperador, passwordOperador, privilegiosOperador FROM ".self::TABLA." 
            WHERE turnoOperador = '".$t."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
        $conexion = null;
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idOperador, nombreOperador, apellidosOperador, 
        turnoOperador, nickOperador, passwordOperador, privilegiosOperador FROM '.self::TABLA);
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }

    public function login(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT nombreOperador, apellidosOperador, turnoOperador, nickOperador, 
        privilegiosOperador FROM '.self::TABLA.' WHERE nickOperador = :nickOperador AND passwordOperador = :passwordOperador');
        $query->bindParam(':nickOperador', $this->nickOperador);
        $query->bindParam(':passwordOperador', $this->passwordOperador);
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