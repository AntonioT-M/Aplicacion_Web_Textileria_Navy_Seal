<?php
require_once 'Conexion.php';

class Modelos{
    private $idModelo;
    private $imgModelo;
    private $modelo;
    private $talla;
    private $materiales;
    private $guiaHilo;
    private $sistemasN;
    private $codigo;

    private CONST TABLA = 'modelos';

    public function __construct($imgModelo = null, $modelo = null, 
    $talla = null, $materiales = null, $guiaHilo = null, $sistemasN = null, $codigo = null, 
    $idModelo = null){
        $this->idModelo = $idModelo;
        $this->imgModelo = $imgModelo;
        $this->modelo = $modelo;
        $this->talla = $talla;
        $this->materiales = $materiales;
        $this->guiaHilo = $guiaHilo;
        $this->sistemasN = $sistemasN;
        $this->codigo = $codigo;
    }

    public function getIdModelo(){
        return $this->idModelo;
    }

    public function getImgModelo(){
        return $this->imgModelo;
    }

    public function getModelo(){
        return $this->modelo;
    }

    public function getTalla(){
        return $this->talla;
    }

    public function getMateriales(){
        return $this->materiales;
    }

    public function getGuiaHilo(){
        return $this->guiaHilo;
    }

    public function getSistemasN(){
        return $this->sistemasN;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setIdModelo($idModelo){
        $this->idModelo = $idModelo;
    }

    public function setImgModelo($imgModelo){
        $this->imgModelo = $imgModelo;
    }

    public function setModelo($modelo){
        $this->modelo = $modelo;
    }

    public function setTalla($talla){
        $this->talla = $talla;
    }

    public function setMateriales($materiales){
        $this->materiales = $materiales;
    }

    public function setGuiaHilo($guiaHilo){
        $this->guiaHilo = $guiaHilo;
    }

    public function setSistemasN($sistemasN){
        $this->sistemasN = $sistemasN;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idModelo){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET imgModelo = :imgModelo, 
            modelo = :modelo, talla = :talla, materiales = :materiales, guiaHilo = :guiaHilo,
            sistemasN = :sistemasN, codigo = :codigo WHERE idModelo = :idModelo');
            $query->bindParam(':idModelo', $this->idModelo);
            $query->bindParam(':imgModelo', $this->imgModelo);
            $query->bindParam(':modelo', $this->modelo);
            $query->bindParam(':talla', $this->talla);
            $query->bindParam(':materiales', $this->materiales);
            $query->bindParam(':guiaHilo', $this->guiaHilo);
            $query->bindParam(':sistemasN', $this->sistemasN);
            $query->bindParam(':codigo', $this->codigo);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (imgModelo, modelo, talla, 
            materiales, guiaHilo, sistemasN, codigo) VALUES(:imgModelo, :modelo, :talla, 
            :materiales, :guiaHilo, :sistemasN, :codigo)');
            $query->bindParam(':imgModelo', $this->imgModelo);
            $query->bindParam(':modelo', $this->modelo);
            $query->bindParam(':talla', $this->talla);
            $query->bindParam(':materiales', $this->materiales);
            $query->bindParam(':guiaHilo', $this->guiaHilo);
            $query->bindParam(':sistemasN', $this->sistemasN);
            $query->bindParam(':codigo', $this->codigo);
            if($query->execute()){
                $this->idModelo = $conexion->lastInsertId();
                return true;
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idModelo = :idModelo');
        $query->bindParam(':idModelo', $this->idModelo);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
        $conexion = null;
    }

    public static function searchById($idModelo){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT imgModelo, modelo, talla, materiales, guiaHilo, 
        sistemasN, codigo FROM '.self::TABLA.' WHERE idModelo = :idModelo');
        $query->bindParam(':idModelo', $idModelo);
        $query->execute();
        $conexion = null;
        $row = $query->fetch();
        if($row){
            return new self($row['imgModelo'], $row['modelo'], $row['talla'], 
            $row['materiales'], $row['guiaHilo'], $row['sistemasN'], $row['codigo'], $idModelo);
        }else{
            return false;
        }
    }

    public static function search($s, $t){
        $conexion = new Conexion();
        if($s != null && $t != null){
            $query = $conexion->prepare("SELECT idModelo, imgModelo, modelo, talla, 
            materiales, guiaHilo, sistemasN, codigo FROM ".self::TABLA." WHERE modelo LIKE '%".$s."%' 
            AND talla ='".$t."' OR materiales LIKE '%".$s."%' AND talla ='".$t."' OR codigo LIKE '%".$s."%' 
            AND talla ='".$t."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($s != null){
            $query = $conexion->prepare("SELECT idModelo, imgModelo, modelo, talla, 
            materiales, guiaHilo, sistemasN, codigo FROM ".self::TABLA." WHERE modelo LIKE '%".$s."%' 
            OR materiales LIKE '%".$s."%'  OR codigo LIKE '%".$s."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }else if($t != null){
            $query = $conexion->prepare("SELECT idModelo, imgModelo, modelo, talla, 
            materiales, guiaHilo, sistemasN, codigo FROM ".self::TABLA." WHERE talla ='".$t."'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
        $conexion = null;
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idModelo, imgModelo, modelo, talla, materiales, 
        guiaHilo, sistemasN, codigo FROM '.self::TABLA);
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }

    public static function getAllOneButOrderByName(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT DISTINCT modelo FROM '.self::TABLA.' ORDER BY modelo DESC');
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }
}

?>