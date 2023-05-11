<?php
class Conexion extends PDO{
    private $db_type = 'mysql';
    private $host = 'localhost';
    private $db_name = 'navy seal';
    private $user = 'root';
    private $pass = '';

    public function __construct(){
        try{
            parent::__construct($this->db_type.':host='.$this->host.';dbname='.$this->db_name, 
            $this->user, $this->pass);
        }catch(PDOException $e){
            echo 'No se puede conectar '.
            $e->getMessage();
            exit;
        }
    }
    /*public function __construct($file = 'conection_settings.ini'){
        if(!$settings = parse_ini_file($file, TRUE)){
            throw new exception('La base de datos no pudo abrirse desde '.$file.'.');
        }
        $dns = $settings['database']['driver'].':host='.$settings['database']['host'].((!empty($settings[
            'database']['port'])) ? (';port='.$settings['database']['port']):'').';dbname='.$settings[
                'database']['schema'];
        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }*/
}
$con = new Conexion();

?>