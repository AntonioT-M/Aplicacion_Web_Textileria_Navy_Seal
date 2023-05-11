<?php
require_once 'Conexion.php';

class Materiales{
    private $idMaterial;
    private $material;
    private $torcion;
    private $calibre;
    private $cantidad;

    private CONST TABLA = 'materiales';

    public function __construct($material = null, $torcion = null, $calibre = null, 
    $cantidad = null, $idMaterial = null){
        $this->idMaterial = $idMaterial;
        $this->material = $material;
        $this->torcion = $torcion;
        $this->calibre  = $calibre;
        $this->cantidad = $cantidad;
    }

    public function getidMaterial(){
        return $this->idMaterial;
    }

    public function getMaterial(){
        return $this->material;
    }

    public function getTorcion(){
        return $this->torcion;
    }

    public function getCalibre(){
        return $this->calibre;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setIdMaterial($idMaterial){
        $this->idMaterial = $idMaterial;
    }

    public function setMateria($material){
        $this->material = $material;
    }

    public function setTorcion($torcion){
        $this->torcion = $torcion;
    }

    public function setCalibre($calibre){
        $this->calibre = $calibre;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function save(){
        $conexion = new Conexion();
        if($this->idMaterial){
            $query = $conexion->prepare('UPDATE '.self::TABLA.' SET material = :material, 
            torcion = :torcion, calibre = :calibre, cantidad = :cantidad WHERE idMaterial = :idMaterial');
            $query->bindParam(':idMaterial', $this->idMaterial);
            $query->bindParam(':material', $this->material);
            $query->bindParam(':torcion', $this->torcion);
            $query->bindParam(':calibre', $this->calibre);
            $query->bindParam(':cantidad', $this->cantidad);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $query = $conexion->prepare('INSERT INTO '.self::TABLA.' (material, torcion, calibre, cantidad)
            VALUES(:material, :torcion, :calibre, :cantidad)');
            $query->bindParam(':material', $this->material);
            $query->bindParam(':torcion', $this->torcion);
            $query->bindParam(':calibre', $this->calibre);
            $query->bindParam(':cantidad', $this->cantidad);
            if($query->execute()){
                $this->idMaterial = $conexion->lastInsertId();
                return true;
            }else{
                return false;
            }
        }
        $conexion = null;
    }

    public function delete(){
        $conexion = new Conexion();
        $query = $conexion->prepare('DELETE FROM '.self::TABLA.' WHERE idMaterial = :idMaterial');
        $query->bindParam(':idMaterial', $this->idMaterial);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
        $conexion = null;
    }

    public static function searchById($idMaterial){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT material, torcion, calibre, cantidad 
        FROM '.self::TABLA.' WHERE idMaterial = :idMaterial');
        $query->bindParam(':idMaterial', $idMaterial);
        $query->execute();
        $row = $query->fetch();
        $conexion = null;
        if($row){
            return new self($row['material'], $row['torcion'], $row['calibre'], $row['cantidad'], $idMaterial);
        }else{
            return false;
        }
    }

    public static function search($m){
        $conexion = new Conexion();
        if($m != null){
            $query = $conexion->prepare("SELECT idMaterial, material, torcion, calibre, cantidad 
            FROM ".self::TABLA." WHERE material LIKE '%".$m."%' OR torcion LIKE '%".$m."%' 
            OR calibre LIKE '%".$m."%'");
            $query->execute();
            $rows = $query->fetchAll();
            return $rows;
        }
    }

    public static function getAll(){
        $conexion = new Conexion();
        $query = $conexion->prepare('SELECT idMaterial, material, torcion, 
        calibre, cantidad FROM '.self::TABLA);
        $query->execute();
        $rows = $query->fetchAll();
        $conexion = null;
        return $rows;
    }

}

?>