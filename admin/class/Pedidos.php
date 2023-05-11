<?php
require_once 'Conexion.php';

class Pedidos{
    private $idPedido;
    private $idModelo;
    private $idCliente;
    private $cantidad;
    private $anchoI;
    private $largoI;
    private $estatusA;
    private $estatusB;
    private $estadoPedido;

    private CONST TABLA = 'pedidos';

    public function __construct($cantidad = null, $anchoI = null, $largoI = null, 
    $estatusA = null, $estatusB = null, $estadoPedido = null, $idModelo = null, 
    $idCliente = null, $idPedido = null){
        $this->idPedido = $idPedido;
        $this->idModelo = $idModelo;
        $this->idCliente = $idCliente;
        $this->cantidad = $cantidad;
        $this->anchoI = $anchoI;
        $this->largoI = $largoI;
        $this->estatusA = $estatusA;
        $this->estatusB = $estatusB;
        $this->estadoPedido = $estadoPedido;
    }

    public function getIdPedido(){
        return $this->idPedido;
    }

    public function getIdModelo(){
        return $this->idModelo;
    }

    public function getIdCliente(){
        return $this->idCliente;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function getAnchoI(){
        return $this->anchoI;
    }

    public function getLargoI(){
        return $this->largoI;
    }

    public function getEstatusA(){
        return $this->estatusA;
    }

    public function getEstatusB(){
        return $this->estatusB;
    }

    public function getEstadoPedido(){
        return $this->estadoPedido;
    }

    public function setIdPedido($idPedido){
        $this->idPedido = $idPedido;
    }

    public function setIdModelo($idModelo){
        $this->idModelo = $idModelo;
    }

    public function setIdCliente($idCliente){
        $this->idCliente = $idCliente;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function setAnchoI($anchoI){
        $this->anchoI = $anchoI;
    }

    public function setLargoI($largoI){
        $this->largoI = $largoI;
    }

    public function setEstatusA($estatusA){
        $this->estatusA = $estatusA;
    }

    public function setEstatusB($estatusB){
        $this->estatusB = $estatusB;
    }

    public function setEstadoPedido($estadoPedido){
        $this->estadoPedido = $estadoPedido;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idPedido){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET idModelo = :idModelo, idCliente = :idCliente, 
            cantidad = :cantidad, anchoI = :anchoI, largoI = :largoI, estatusA = :estatusA, estatusB = :estatusB, 
            estadoPedido = :estadoPedido WHERE idPedido = :idPedido');
            $query->bindParam(':idPedido', $this->idPedido);
            $query->bindParam(':idModelo', $this->idModelo);
            $query->bindParam(':idCliente', $this->idCliente);
            $query->bindParam(':cantidad', $this->cantidad);
            $query->bindParam(':anchoI', $this->anchoI);
            $query->bindParam(':largoI', $this->largoI);
            $query->bindParam(':estatusA', $this->estatusA);
            $query->bindParam(':estatusB', $this->estatusB);
            $query->bindParam(':estadoPedido', $this->estadoPedido);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (idModelo, idCliente, cantidad, 
            anchoI, largoI, estatusA, estatusB, estadoPedido) VALUES(:idModelo, :idCliente, :cantidad,
            :anchoI, :largoI, :estatusA, :estatusB, :estadoPedido)');
            $query->bindParam(':idModelo', $this->idModelo);
            $query->bindParam(':idCliente', $this->idCliente);
            $query->bindParam(':cantidad', $this->cantidad);
            $query->bindParam(':anchoI', $this->anchoI);
            $query->bindParam(':largoI', $this->largoI);
            $query->bindParam(':estatusA', $this->estatusA);
            $query->bindParam(':estatusB', $this->estatusB);
            $query->bindParam(':estadoPedido', $this->estadoPedido);
            if($query->execute()){
                $this->idPedido = $conexion->lastInsertId();
                return true;   
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idPedido = :idPedido');
        $query->bindParam(':idPedido', $this->idPedido);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
        $conexion = null;
    }

    public static function searchByid($idPedido){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idModelo, idCliente, cantidad, anchoI, largoI, 
        estatusA, estatusB, estadoPedido FROM '.self::TABLA.' WHERE idPedido = :idPedido');
        $query->bindParam(':idPedido', $idPedido);
        $query->execute();
        $conexion = null;
        $row = $query->fetch();
        if($row){
            return new self($row['cantidad'], $row['anchoI'], $row['largoI'], $row['estatusA'], 
            $row['estatusB'], $row['estadoPedido'], $row['idModelo'], $row['idCliente'], $idPedido);
        }else{
            return false;
        }
    }

    public static function search($s, $e){
        $conexion = new Conexion();
        if($s != null && $e != null){
            $query = $conexion->prepare("SELECT idPedido, nombreC, modelo, talla, cantidad, 
            anchoI, largoI, estatusA, estatusB, estadoPedido FROM ".self::TABLA." JOIN 
            modelos ON pedidos.idModelo = modelos.idModelo JOIN clientes ON 
            pedidos.idCliente = clientes.idCliente WHERE nombreC LIKE '%".$s."%' AND estadoPedido = '".$e."'
            OR modelo LIKE '%".$s."%' AND estadoPedido = '".$e."' OR cantidad LIKE '%".$s."%' 
            AND estadoPedido = '".$e."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($s != null){
            $query = $conexion->prepare("SELECT idPedido, nombreC, modelo, talla, cantidad, 
            anchoI, largoI, estatusA, estatusB, estadoPedido FROM ".self::TABLA." JOIN 
            modelos ON pedidos.idModelo = modelos.idModelo JOIN clientes ON 
            pedidos.idCliente = clientes.idCliente WHERE nombreC LIKE '%".$s."%' OR modelo LIKE '%".$s."%' 
            OR cantidad LIKE '%".$s."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($e != null){
            $query = $conexion->prepare("SELECT idPedido, nombreC, modelo, talla, cantidad, 
            anchoI, largoI, estatusA, estatusB, estadoPedido FROM ".self::TABLA." JOIN 
            modelos ON pedidos.idModelo = modelos.idModelo JOIN clientes ON 
            pedidos.idCliente = clientes.idCliente WHERE estadoPedido = '".$e."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
        $conexion = null;
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idPedido, nombreC, rSocial, modelo, talla, cantidad, anchoI, largoI, estatusA, 
        estatusB, estadoPedido FROM '.self::TABLA.' JOIN modelos ON pedidos.idModelo = modelos.idModelo
        JOIN clientes ON pedidos.idCliente = clientes.idCliente');
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }
}

?>