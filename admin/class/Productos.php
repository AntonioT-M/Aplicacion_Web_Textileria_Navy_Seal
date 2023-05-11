<?php
require_once 'Conexion.php';

class Productos{
    private $idProducto;
    private $idPedido;
    private $idMaquina;
    private $idOperador;
    private $folio;
    private $fechas;
    private $lotes;
    private $piezas;
    private $acumulado;
    private $observaciones;
    private $TPP;
    private $TOPP;
    private $operadores;
    private $turnos;
    private $anchoH;
    private $largoH;

    private CONST TABLA = 'productos';

    public function __construct($idPedido = null, $idMaquina = null, 
    $idOperador = null, $folio = null, $fechas = null, $lotes = null, $piezas = null, 
    $acumulado = null, $observaciones = null, $TPP = null, $TOPP = null, $operadores = null, 
    $turnos = null, $anchoH = null, $largoH = null, $idProducto = null){
        $this->idProducto = $idProducto;
        $this->idPedido = $idPedido;
        $this->idMaquina = $idMaquina;
        $this->idOperador = $idOperador;
        $this->folio = $folio;
        $this->fechas = $fechas;
        $this->lotes = $lotes;
        $this->piezas = $piezas;
        $this->acumulado = $acumulado;
        $this->observaciones = $observaciones;
        $this->TPP = $TPP;
        $this->TOPP = $TOPP;
        $this->operadores = $operadores;
        $this->turnos = $turnos;
        $this->anchoH = $anchoH;
        $this->largoH = $largoH;
    }

    public function getIdProducto(){
        return $this->idProducto;
    }

    public function getIdPedido(){
        return $this->idPedido;
    }

    public function getIdMaquina(){
        return $this->idMaquina;
    }

    public function getIdOperador(){
        return $this->idOperador;
    }

    public function getFolio(){
        return $this->folio;
    }

    public function getFechas(){
        return $this->fechas;
    }

    public function getLotes(){
        return $this->lotes;
    }

    public function getPiezas(){
        return $this->piezas;
    }

    public function getAcumulado(){
        return $this->acumulado;
    }

    public function getObservaciones(){
        return $this->observaciones;
    }

    public function getTPP(){
        return $this->TPP;
    }

    public function getTOPP(){
        return $this->TOPP;
    }

    public function getOperadores(){
        return $this->operadores;
    }

    public function getTurnos(){
        return $this->turnos;
    }

    public function getAnchoH(){
        return $this->anchoH;
    }

    public function getLargoH(){
        return $this->largoH;
    }

    public function setIdProducto($idProducto){
        $this->idProducto = $idProducto;
    }

    public function setIdPedido($idPedido){
        $this->idPedido = $idPedido;
    }

    public function setIdMaquina($idMaquina){
        $this->idMaquina = $idMaquina;
    }

    public function setIdOperador($idOperador){
        $this->idOperador = $idOperador;
    }

    public function setFolio($folio){
        $this->folio = $folio;
    }

    public function setFechas($fechas){
        $this->fechas  = $fechas;
    }

    public function setLotes($lotes){
        $this->lotes = $lotes;
    }

    public function setPiezas($piezas){
        $this->piezas = $piezas;
    }

    public function setAcumulado($acumulado){
        $this->acumulado = $acumulado;
    }

    public function setObservaciones($observaciones){
        $this->observaciones = $observaciones;
    }

    public function setTPP($TPP){
        $this->TPP = $TPP;
    }

    public function setTOPP($TOPP){
        $this->TOPP = $TOPP;
    }

    public function setOperadores($operadores){
        $this->operadores = $operadores;
    }

    public function setTUrnos($turnos){
        $this->turnos = $turnos;
    }

    public function setAnchoH($anchoH){
        $this->anchoH = $anchoH;
    }

    public function setLargoH($largoH){
        $this->largoH = $largoH;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idProducto){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET idPedido = :idPedido, 
            idMaquina = :idMaquina, idOperador = :idOperador, folio = :folio, fechas = :fechas, 
            lotes = :lotes, piezas = :piezas, acumulado = :acumulado, observaciones = :observaciones,
            TPP = :TPP, TOPP = :TOPP, operadores = :operadores, turnos = :turnos, anchoH = :anchoH, 
            largoH = :largoH WHERE idProducto = :idProducto');
            $query->bindParam(':idProducto', $this->idProducto);
            $query->bindParam(':idPedido', $this->idPedido);
            $query->bindParam(':idMaquina', $this->idMaquina);
            $query->bindParam(':idOperador', $this->idOperador);
            $query->bindParam(':folio', $this->folio);
            $query->bindParam(':fechas', $this->fechas);
            $query->bindParam(':lotes', $this->lotes);
            $query->bindParam(':piezas', $this->piezas);
            $query->bindParam(':acumulado', $this->acumulado);
            $query->bindParam(':observaciones', $this->observaciones);
            $query->bindParam(':TPP', $this->TPP);
            $query->bindParam(':TOPP', $this->TOPP);
            $query->bindParam(':operadores', $this->operadores);
            $query->bindParam(':turnos', $this->turnos);
            $query->bindParam(':anchoH', $this->anchoH);
            $query->bindParam(':largoH', $this->largoH);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (idPedido, idMaquina, idOperador,
            folio, fechas, lotes, piezas, acumulado, observaciones, TPP, TOPP, operadores, turnos, anchoH,
            largoH) VALUES(:idPedido, :idMaquina, :idOperador, :folio, :fechas, :lotes, :piezas, :acumulado, 
            :observaciones, :TPP, :TOPP, :operadores, :turnos, :anchoH, :largoH)');
            $query->bindParam(':idPedido', $this->idPedido);
            $query->bindParam(':idMaquina', $this->idMaquina);
            $query->bindParam(':idOperador', $this->idOperador);
            $query->bindParam(':folio', $this->folio);
            $query->bindParam(':fechas', $this->fechas);
            $query->bindParam(':lotes', $this->lotes);
            $query->bindParam(':piezas', $this->piezas);
            $query->bindParam(':acumulado', $this->acumulado);
            $query->bindParam(':observaciones', $this->observaciones);
            $query->bindParam(':TPP', $this->TPP);
            $query->bindParam(':TOPP', $this->TOPP);
            $query->bindParam(':operadores', $this->operadores);
            $query->bindParam(':turnos', $this->turnos);
            $query->bindParam(':anchoH', $this->anchoH);
            $query->bindParam(':largoH', $this->largoH);
            if($query->execute()){
                $this->idProducto = $conexion->lastInsertId();
                return true;
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idProducto = :idProducto');
        $query->bindParam(':idProducto', $this->idProducto);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
        $conexion = null;
    }

    public static function searchById($idProducto){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idPedido, idMaquina, idOperador, folio, fechas, lotes, 
        piezas, acumulado, observaciones, TPP, TOPP, operadores, turnos, anchoH, largoH 
        FROM '.self::TABLA.' WHERE idProducto = :idProducto');
        $query->bindParam(':idProducto', $idProducto);
        $query->execute();
        $conexion = null;
        $row = $query->fetch();
        if($row){
            return new self($row['idPedido'], $row['idMaquina'], $row['idOperador'], 
            $row['folio'], $row['fechas'], $row['lotes'], $row['piezas'], $row['acumulado'], $row['observaciones'], 
            $row['TPP'], $row['TOPP'], $row['operadores'], $row['turnos'], $row['anchoH'], 
            $row['largoH'], $idProducto);
        }else{
            return false;
        }
    }

    public static function search($s, $e){
        $conexion = new Conexion();
        if($s != null && $e != null){
            $query = $conexion->prepare("SELECT idProducto, nombreC, modelos.modelo, imgModelo, talla, cantidad, estadoPedido, 
            maquina, nombreOperador, apellidosOperador, turnoOperador, folio, fechas, lotes, piezas, acumulado, 
            observaciones, TPP, TOPP, operadores, turnos, anchoH, largoH FROM 
            ".self::TABLA." JOIN pedidos ON productos.idPedido = pedidos.idPedido 
            JOIN maquinas ON productos.idMaquina = maquinas.idMaquina JOIN operadores ON 
            productos.idOperador = operadores.idOperador 
            JOIN clientes ON pedidos.idCliente = clientes.idCliente 
            JOIN modelos ON pedidos.idModelo = modelos.idModelo 
            WHERE concat(nombreOperador,' ',apellidosOperador) LIKE '%".$s."%' AND estadoPedido = '".$e."'
            OR nombreC LIKE '%".$s."%' AND estadoPedido = '".$e."' OR modelos.modelo LIKE '%".$s."%' AND estadoPedido = '".$e."'
            OR talla LIKE '%".$s."%' AND estadoPedido = '".$e."' OR maquina LIKE '%".$s."%' AND estadoPedido = '".$e."'
            OR folio LIKE '".$s."' AND estadoPedido = '".$e."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($s != null){
            $query = $conexion->prepare("SELECT idProducto, nombreC, modelos.modelo, imgModelo, talla, cantidad, estadoPedido, 
            maquina, nombreOperador, apellidosOperador, turnoOperador, folio, fechas, lotes, piezas, acumulado, 
            observaciones, TPP, TOPP, operadores, turnos, anchoH, largoH FROM 
            ".self::TABLA." JOIN pedidos ON productos.idPedido = pedidos.idPedido 
            JOIN maquinas ON productos.idMaquina = maquinas.idMaquina JOIN operadores ON 
            productos.idOperador = operadores.idOperador 
            JOIN clientes ON pedidos.idCliente = clientes.idCliente 
            JOIN modelos ON pedidos.idModelo = modelos.idModelo 
            WHERE concat(nombreOperador,' ',apellidosOperador) LIKE '%".$s."%' OR nombreOperador LIKE '%".$s."%'
            OR apellidosOperador LIKE '%".$s."%' OR nombreC LIKE '%".$s."%' OR modelos.modelo LIKE '%".$s."%' OR talla LIKE '%".$s."%' 
            OR maquina LIKE '%".$s."%' OR folio LIKE '%".$s."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($e != null){
            $query = $conexion->prepare("SELECT idProducto, nombreC, modelos.modelo, imgModelo, talla, cantidad, estadoPedido, 
            maquina, nombreOperador, apellidosOperador, turnoOperador, folio, fechas, lotes, piezas, acumulado, 
            observaciones, TPP, TOPP, operadores, turnos, anchoH, largoH FROM 
            ".self::TABLA." JOIN pedidos ON productos.idPedido = pedidos.idPedido 
            JOIN maquinas ON productos.idMaquina = maquinas.idMaquina JOIN operadores ON 
            productos.idOperador = operadores.idOperador 
            JOIN clientes ON pedidos.idCliente = clientes.idCliente 
            JOIN modelos ON pedidos.idModelo = modelos.idModelo 
            WHERE estadoPedido = '".$e."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
        $conexion = null;
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idProducto, nombreC, modelos.modelo, imgModelo, talla, cantidad, estadoPedido, 
        maquina, nombreOperador, apellidosOperador, turnoOperador, folio, fechas, lotes, piezas, acumulado, 
        observaciones, TPP, TOPP, operadores, turnos, anchoH, largoH FROM 
        '.self::TABLA.' JOIN pedidos ON productos.idPedido = pedidos.idPedido 
        JOIN maquinas ON productos.idMaquina = maquinas.idMaquina JOIN operadores ON 
        productos.idOperador = operadores.idOperador 
        JOIN clientes ON pedidos.idCliente = clientes.idCliente 
        JOIN modelos ON pedidos.idModelo = modelos.idModelo');
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }
}

?>