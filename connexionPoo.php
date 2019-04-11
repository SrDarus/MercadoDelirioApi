<?php 

  require_once "config.php";
  class Conexion extends PDO
  { 
    private $tipo_de_base    = 'mysql';          /**< Indica el tipo de motor de datos */
    private $host            = HOST;      /**< Indica el host */
    private $nombre_de_base = DBNAME;            /**< Indica el nombre de la base de datos */
    private $usuario         = USER;           /**< Indica el nombre de usuario de la base de datos */
    private $contrasena      = PASS;       /**< Indica la contraseña de usuario de la base de datos */


    /**
      * @brief crea la conexión PDO.
     */  
    public function __CONSTRUCT() {
 
       try{
          parent::__CONSTRUCT($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this ->usuario, $this->contrasena);
 
       }catch(PDOException $e){
          echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
          exit;
       }
    } 

  }
  
 ?>