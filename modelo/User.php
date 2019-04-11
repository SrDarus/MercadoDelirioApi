<?php 

    Class User
    {
        private $Correo;
        private $Password;
        private $Nombre;
        private $Edad;
        //private $Sexo;
        //private $FechaNacimiento;
        //private $Clave;
    
        public function __GET($k){
            return $this->$k;
        }
        public function __SET($k, $v){
            return $this->$k = $v; 
        }
    } 
?>