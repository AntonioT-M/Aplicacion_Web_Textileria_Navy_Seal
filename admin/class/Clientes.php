<?php
require_once 'Conexion.php';

class Clientes{
    private $idClinte;
    private $nombreC;
    private $rSocial;
    private $tipo;

    private CONST TABLA = 'clientes';

    public function __construct($nombreC = null, $rSocial = null, $tipo = null, $idClinte = null){
        $this->idClinte = $idClinte;
        $this->nombreC = $nombreC;
        $this->rSocial = $rSocial;
        $this->tipo = $tipo;
    }

    public function getIdCliente(){
        return $this->idClinte;
    }

    public function getNombreC(){
        return $this->nombreC;
    }

    public function getRSocial(){
        return $this->rSocial;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setIdCliente($idClinte){
        $this->idClinte = $idClinte;
    }

    public function setNombreC($nombreC){
        $this->nombreC = $nombreC;
    }

    public function setRSocial($rSocial){
        $this->rSocial = $rSocial;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idClinte){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET nombreC = :nombreC, 
            rSocial = :rSocial, tipo = :tipo WHERE idCliente = :idCliente');
            $query->bindParam(':idCliente', $this->idClinte);
            $query->bindParam(':nombreC', $this->nombreC);
            $query->bindParam(':rSocial', $this->rSocial);
            $query->bindParam(':tipo', $this->tipo);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (nombreC, rSocial, tipo) 
            VALUES(:nombreC, :rSocial, :tipo)');
            $query->bindParam(':nombreC', $this->nombreC);
            $query->bindParam(':rSocial', $this->rSocial);
            $query->bindParam(':tipo', $this->tipo);
            if($query->execute()){
                $this->idClinte = $conexion->lastInsertId();
                return true;
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idCliente = :idCliente');
        $query->bindParam(':idCliente', $this->idClinte);
        if($query->execute()){
            return true;
        }else{
           return false; 
        }
        $conexion = null;
    }

    public static function searchById($idClinte){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT nombreC, rSocial, tipo FROM '.self::TABLA.' 
        WHERE idCliente = :idCliente');
        $query->bindParam('idCliente', $idClinte);
        $query->execute();
        $row = $query->fetch();
        $conexion = null;
        if($row){
            return new self($row['nombreC'], $row['rSocial'], $row['tipo'], $idClinte);
        }else{
            return false;
        }
    }

    public static function search($s, $c){
        $conexion = new Conexion();
        if($s != "" && $c != ""){
            $query = $conexion->prepare("SELECT idCliente, nombreC, rSocial, tipo FROM ".self::TABLA." 
            WHERE nombreC LIKE '%".$s."%' AND tipo = '".$c."' OR rSocial LIKE '%".$s."%' AND tipo = '".$c."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($s != ""){
            $query = $conexion->prepare("SELECT idCliente, nombreC, rSocial, tipo FROM ".self::TABLA." 
            WHERE nombreC LIKE '%".$s."%' OR rSocial LIKE '%".$s."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($c != ""){
            $query = $conexion->prepare("SELECT idCliente, nombreC, rSocial, tipo FROM ".self::TABLA." 
            WHERE tipo = '".$c."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
        $conexion = null;
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idCliente, nombreC, rSocial, tipo FROM '.self::TABLA);
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }
}

?>