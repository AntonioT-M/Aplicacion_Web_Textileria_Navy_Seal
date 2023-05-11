<?php
require_once 'Conexion.php';

class Producido{
    private $idProducido;
    private $idProducto;
    private $idOperador;
    private $cantidadTP;
    private $fecha;

    private CONST TABLA = 'producido';

    public function __construct($idProducido = null, $idProducto = null, $idOperador = null, 
    $cantidadTP = null, $fecha = null){
        $this->idProducido = $idProducido;
        $this->idProducto = $idProducto;
        $this->idOperador = $idOperador;
        $this->cantidadTP = $cantidadTP;
        $this->fecha = $fecha;
    }

    public function getIdProducido(){
        return $this->idProducido;
    }

    public function getIdProducto(){
        return $this->idProducto;
    }

    public function getIdOperador(){
        return $this->idOperador;
    }

    public function getCantidadTP(){
        return $this->cantidadTP;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setIdProducido($idProducido){
        $this->idProducido = $idProducido;
    }

    public function setIdProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function setIdOperador($idOperador){
        $this->idOperador = $idOperador;
    }

    public function setCantidadTP($cantidadTP){
        $this->cantidadTP = $cantidadTP;
    }

    public function serFecha($fecha){
        $this->fecha = $fecha;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idProducido){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET idProducto = :idProducto, 
            idOperador = :idOperador, cantidadTP = :cantidadTP, fecha = :fecha 
            WHERE idProducido = :idProducido');
            $query->bindParam(':idProducido', $this->idProducido);
            $query->bindParam(':idProducto', $this->idProducto);
            $query->bindParam(':idOperador', $this->idOperador);
            $query->bindParam(':cantidadTP', $this->cantidadTP);
            $query->bindParam(':fecha', $this->fecha);
            $query->execute();
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (idProducido, idProducto, 
            idOperador, cantidadTP, fecha) VALUES(:idProducido, :idProducto, :idOperador, 
            :cantidadTP, :fecha)');
            $query->bindParam(':idProducto', $this->idProducto);
            $query->bindParam(':idOperador', $this->idOperador);
            $query->bindParam(':cantidadTP', $this->cantidadTP);
            $query->bindParam(':fecha', $this->fecha);
            $query->execute();
            $this->idProducido = $conexion->lastInsertId();
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idProducido = :idProducido');
        $query->bindParam(':idProducido', $this->idProducido);
        $query->execute();
        $conexion = null;
    }

    public function searchById($idProducido){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idProducto, idOperador, cantidadTP, fecha FROM 
        '.self::TABLA.' WHERE idProducido = :idProducido');
        $query->bindParam(':idProducido', $idProducido);
        $query->execute();
        $conexion = null;
        $row = $query->fetch();
        if($row){
            return new self($row['idProducto'], $row['idOperador'], 
            $row['cantidadTP'], $row['fecha'], $idProducido);
        }else{
            return false;
        }
    }

    public function search(){

    }

    public function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idProducido, idProducto, idOperador, cantidadTP, fecha FROM 
        '.self::TABLA);
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }
}
?>